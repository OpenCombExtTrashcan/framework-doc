<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="author" content="jc\doc\builder" /> 
	<meta name="keywords" content="" /> 
	<meta name="description" content="" /> 
	<base href="<?php echo eval("if(!isset(\$__uivar_sBaseUri)){ \$__uivar_sBaseUri=&\$aVariables->getRef('sBaseUri') ;};
return \$__uivar_sBaseUri;") ;?>" />
	<title> package: <?php echo eval("if(!isset(\$__uivar_sFullPackageName)){ \$__uivar_sFullPackageName=&\$aVariables->getRef('sFullPackageName') ;};
return \$__uivar_sFullPackageName;") ;?>  -- JeCat PHP Framework Classes  </title> 
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head> 


<body>

<div id="classes_index">
	<?php 
$__include_aVariables = $aVariables ; 
$this->display("index.template.html",$__include_aVariables,$aDevice) ; ?>
	<script type='text/javascript'>
	Ext.onReady(function(){
		var curNodeId = '<?php echo eval("if(!isset(\$__uivar_sFullPackageName)){ \$__uivar_sFullPackageName=&\$aVariables->getRef('sFullPackageName') ;};
return str_replace('\\\\','::',\$__uivar_sFullPackageName);") ;?>' ;
		var curNode = docTree.getNodeById(curNodeId);
		var nodePath = curNode.getPath();
		docTree.expandPath(nodePath);
		curNode.select();
	});
	</script>
</div>

<div id="main-area">
	<h4>
		<?php
				$__foreach_Arr_var0 = eval("if(!isset(\$__uivar_arrPackagePath)){ \$__uivar_arrPackagePath=&\$aVariables->getRef('arrPackagePath') ;};
return \$__uivar_arrPackagePath;");
				if(!empty($__foreach_Arr_var0)){ 
					$__foreach_idx_var3 = -1;
					foreach($__foreach_Arr_var0 as $__foreach_key_var2 => $__foreach_item_var1){
						$__foreach_idx_var3++;
						 $aVariables->set("sPackagePath",$__foreach_key_var2);  $aVariables->set("sPackageName",$__foreach_item_var1 ); ?><!--
		--><a class="next" href="<?php echo eval("if(!isset(\$__uivar_sPackagePath)){ \$__uivar_sPackagePath=&\$aVariables->getRef('sPackagePath') ;};
return \$__uivar_sPackagePath;") ;?>/index.html"><?php echo eval("if(!isset(\$__uivar_sPackageName)){ \$__uivar_sPackageName=&\$aVariables->getRef('sPackageName') ;};
return \$__uivar_sPackageName;") ;?></a><!--
		--><?php 
					}
				}
			 		?><!--
		-->
	</h4>

	<!-- packages -->
	<?php
				$__foreach_Arr_var4 = eval("if(!isset(\$__uivar_arrChildren)){ \$__uivar_arrChildren=&\$aVariables->getRef('arrChildren') ;};
return \$__uivar_arrChildren;");
				if(!empty($__foreach_Arr_var4)){ 
					$__foreach_idx_var7 = -1;
					foreach($__foreach_Arr_var4 as $__foreach_key_var6 => $__foreach_item_var5){
						$__foreach_idx_var7++;
						 $aVariables->set("sChildName",$__foreach_key_var6);  $aVariables->set("packageChild",$__foreach_item_var5 ); ?>
	<div>
		<?php if(eval("if(!isset(\$__uivar_packageChild)){ \$__uivar_packageChild=&\$aVariables->getRef('packageChild') ;};
return is_array(\$__uivar_packageChild);")){ ?>
			package:
			<a href="<?php echo eval("if(!isset(\$__uivar_sFullPackageName)){ \$__uivar_sFullPackageName=&\$aVariables->getRef('sFullPackageName') ;};
return str_replace('\\\\','/',\$__uivar_sFullPackageName);") ;?>/<?php echo eval("if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildName;") ;?>/index.html"><?php echo eval("if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildName;") ;?></a>
		<?php
					}elseif( eval("if(!isset(\$__uivar_packageChild)){ \$__uivar_packageChild=&\$aVariables->getRef('packageChild') ;};
return \$__uivar_packageChild instanceof \\jc\\doc\\classes\\builder\\ClassInfo;")){
					?>
			class:
			<a href="<?php echo eval("if(!isset(\$__uivar_sFullPackageName)){ \$__uivar_sFullPackageName=&\$aVariables->getRef('sFullPackageName') ;};
return str_replace('\\\\','/',\$__uivar_sFullPackageName);") ;?>/<?php echo eval("if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildName;") ;?>.html"><?php echo eval("if(!isset(\$__uivar_sChildName)){ \$__uivar_sChildName=&\$aVariables->getRef('sChildName') ;};
return \$__uivar_sChildName;") ;?></a>
		<?php } ?>
		
		
		
	</div>
	<?php 
					}
				}
			 		?>
	
	
</div>

</body>

</html>