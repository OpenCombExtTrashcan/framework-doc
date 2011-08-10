<link rel="stylesheet" type="text/css" href="css/ext-all.css" />
<script type="text/javascript" src="js/ext-base.js"></script>
<script type="text/javascript" src="js/ext-all.js"></script>
<script type="text/javascript" src="js/TreeFilter.js"></script>
<script type="text/javascript" src="js/PinyinFilter.js"></script>


<?php 
$aVariables->set('__subtemplate_'."renderPackageItem",function($aVariables,$aDevice){?>

{
<?php if(eval("if(!isset(\$__uivar_sPackageName)){ \$__uivar_sPackageName=&\$aVariables->getRef('sPackageName') ;};
return \$__uivar_sPackageName;")){ ?>
	id: '<?php echo eval("if(!isset(\$__uivar_sPackageFullName)){ \$__uivar_sPackageFullName=&\$aVariables->getRef('sPackageFullName') ;};
return str_replace('\\\\','::',\$__uivar_sPackageFullName);") ;?>' ,
	text: '<?php echo eval("if(!isset(\$__uivar_sPackageName)){ \$__uivar_sPackageName=&\$aVariables->getRef('sPackageName') ;};
return \$__uivar_sPackageName;") ;?>' ,
	href: '<?php echo eval("if(!isset(\$__uivar_sPackageFullName)){ \$__uivar_sPackageFullName=&\$aVariables->getRef('sPackageFullName') ;};
return str_replace('\\\\','/',\$__uivar_sPackageFullName);") ;?>/index.html' ,
<?php } ?>

	<?php if(!isset($__uivar_sChildNamespace)){ $__uivar_sChildNamespace=&$aVariables->getRef('sChildNamespace') ;};
if(!isset($__uivar_sPackageFullName)){ $__uivar_sPackageFullName=&$aVariables->getRef('sPackageFullName') ;};
$__uivar_sChildNamespace = $__uivar_sPackageFullName? ($__uivar_sPackageFullName.'\\'): ''; ;?>
	children: [
		<?php
				$__foreach_Arr_var8 = eval("if(!isset(\$__uivar_arrChildren)){ \$__uivar_arrChildren=&\$aVariables->getRef('arrChildren') ;};
return \$__uivar_arrChildren;");
				if(!empty($__foreach_Arr_var8)){ 
					$__foreach_idx_var11 = -1;
					foreach($__foreach_Arr_var8 as $__foreach_key_var10 => $__foreach_item_var9){
						$__foreach_idx_var11++;
						 $aVariables->set("sChildName",$__foreach_key_var10);  $aVariables->set("child",$__foreach_item_var9 );  $aVariables->set("nIdx",$__foreach_idx_var11 ); ?>
		
		<?php if(eval("if(!isset(\$__uivar_nIdx)){ \$__uivar_nIdx=&\$aVariables->getRef('nIdx') ;};
return \$__uivar_nIdx>0;")){ ?>,<?php } ?>
		
		<?php if(eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return is_array(\$__uivar_child);")){ ?>
			<?php 
$__subtemplate_aVariables = new \jc\util\HashTable() ; 
$__subtemplate_aVariables->set('__subtemplate_'."renderPackageItem",$aVariables->get('__subtemplate_'."renderPackageItem")) ; 
$__subtemplate_aVariables->set("arrChildren",eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return \$__uivar_child;")) ; 
$__subtemplate_aVariables->set("sPackageName",eval("if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildName;")) ; 
$__subtemplate_aVariables->set("sPackageFullName",eval("if(!isset(\$__uivar_sChildNamespace)){ \$__uivar_sChildNamespace=&\$aVariables->getRef('sChildNamespace') ;};
if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildNamespace.\$__uivar_sChildName;")) ; 
call_user_func_array($aVariables->get('__subtemplate_'."renderPackageItem"),array($__subtemplate_aVariables,$aDevice)) ;?>

		<?php
					}elseif( eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return \$__uivar_child instanceof \\jc\\doc\\classes\\builder\\ClassInfo;")){
					?>
		{
			id: '<?php echo eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return str_replace('\\\\','::',\$__uivar_child->getName());") ;?>' ,
			text: '<?php echo eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return \$__uivar_child->getShortName();") ;?>' ,
			href: '<?php echo eval("if(!isset(\$__uivar_child)){ \$__uivar_child=&\$aVariables->getRef('child') ;};
return str_replace('\\\\','/',\$__uivar_child->getName());") ;?>.html' ,
			leaf: true
		}
		<?php } ?>
		<?php 
					}
				}
			 		?>
	]
}
<?php })?>

<script type="text/javascript">
var docTree ;
Ext.onReady(function(){
	Ext.BLANK_IMAGE_URL = 'images/default/tree/s.gif';
	docTree = new Ext.tree.TreePanel({
		renderTo:'docTree',
		rootVisible:false,
		border:false,
		animate :false,
		autoScroll:false,
		tbar:new Ext.Toolbar(),
		root:new Ext.tree.AsyncTreeNode(<?php 
$__subtemplate_aVariables = new \jc\util\HashTable() ; 
$__subtemplate_aVariables->set('__subtemplate_'."renderPackageItem",$aVariables->get('__subtemplate_'."renderPackageItem")) ; 
$__subtemplate_aVariables->set("arrChildren",eval("if(!isset(\$__uivar_aBuilder)){ \$__uivar_aBuilder=&\$aVariables->getRef('aBuilder') ;};
return \$__uivar_aBuilder->classes();")) ; 
call_user_func_array($aVariables->get('__subtemplate_'."renderPackageItem"),array($__subtemplate_aVariables,$aDevice)) ;?>
)
	});
	
	var filterFiled = new Ext.form.TextField({
		emptyText:'Search index',
		enableKeyEvents: true,
		listeners:{
			render: function(f){
				this.filter = new QM.ux.TreeFilter(docTree,{
					clearAction : 'expand'
				});//初始化TreeFilter 
			},
			keyup: ,
				buffer: 350
			}
		}
	});
	
	//加载搜索条
	var tbar = docTree.getTopToolbar();
	tbar.add(filterFiled);
	tbar.doLayout();
	
	//选中当前网页内容对应的树结构
	var rootNode = docTree.getRootNode();
	rootNode.expandChildNodes(true);
	rootNode.collapseChildNodes(true);
	//!!! 未完,剩余代码在 class.template.html 和 package.template.html中
});
</script>

<div id='docTree'></div>

