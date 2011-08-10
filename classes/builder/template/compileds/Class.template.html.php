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
	<title> class: <?php echo eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getName();") ;?>  -- JeCat PHP Framework Classes  </title> 
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
</head> 

<body>

	<div id="classes_index">
		<?php 
$__include_aVariables = $aVariables ; 
$this->display("index.template.html",$__include_aVariables,$aDevice) ; ?>
		<script type='text/javascript'>
		Ext.onReady(function(){
			var curNodeId = '<?php echo eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return str_replace('\\\\','::',\$__uivar_aClass->getName());") ;?>' ;
			var curNode = docTree.getNodeById(curNodeId);
			var nodePath = curNode.getPath();
			docTree.expandPath(nodePath);
			curNode.select();
		});
		</script>
	</div>
	
	<div id="main-area">
	
		<!-- title --><div class="normalfloat">
		<h3> 
			<?php 
$__include_aVariables = new \jc\util\HashTable() ; 
$__include_aVariables->set("sPath",eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getNamespaceName();")) ; 
$__include_aVariables->set("aBuilder",eval("if(!isset(\$__uivar_aBuilder)){ \$__uivar_aBuilder=&\$aVariables->getRef('aBuilder') ;};
return \$__uivar_aBuilder;")) ; 
$this->display("namespacePath.template.html",$__include_aVariables,$aDevice) ; ?><!--
			--><?php echo eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getShortName();") ;?>
		</h3>
		
		<!-- 回溯继承关系 -->
		<?php if(eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aParentClass=\$__uivar_aClass->getParentClass();")){ ?>
		<div id="extend-trace-div">
			继承路径：
			<ul id="extend-trace-ul" class="dotted">
			<?php do{ ?>
				<li>
					<a href="<?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return str_replace('\\\\','/',\$__uivar_aParentClass->getName());") ;?>.html" title="<?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass->getName();") ;?></a>
				</li>
			<?php }while(eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass=\$__uivar_aParentClass->getParentClass();"));?>
			</ul>
		</div>
		<?php } ?>
		
		<!-- 实现接口 -->
		<?php if(eval("if(!isset(\$__uivar_arrInterfaceRefs)){ \$__uivar_arrInterfaceRefs=&\$aVariables->getRef('arrInterfaceRefs') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_arrInterfaceRefs=\$__uivar_aClass->getInterfaces();")){ ?>
		<div id="implements-interfaces">
			实现接口: 
			<?php
				$__foreach_Arr_var13 = eval("if(!isset(\$__uivar_arrInterfaceRefs)){ \$__uivar_arrInterfaceRefs=&\$aVariables->getRef('arrInterfaceRefs') ;};
return \$__uivar_arrInterfaceRefs;");
				if(!empty($__foreach_Arr_var13)){ 
					$__foreach_idx_var16 = -1;
					foreach($__foreach_Arr_var13 as $__foreach_key_var15 => $__foreach_item_var14){
						$__foreach_idx_var16++;
						 $aVariables->set("aInterfaceRef",$__foreach_item_var14 ); ?>
				<a href="<?php echo eval("if(!isset(\$__uivar_aInterfaceRef)){ \$__uivar_aInterfaceRef=&\$aVariables->getRef('aInterfaceRef') ;};
return str_replace('\\\\','/',\$__uivar_aInterfaceRef->getName());") ;?>.html" title="<?php echo eval("if(!isset(\$__uivar_aInterfaceRef)){ \$__uivar_aInterfaceRef=&\$aVariables->getRef('aInterfaceRef') ;};
return \$__uivar_aInterfaceRef->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aInterfaceRef)){ \$__uivar_aInterfaceRef=&\$aVariables->getRef('aInterfaceRef') ;};
return \$__uivar_aInterfaceRef->getShortName();") ;?></a>;
			<?php 
					}
				}
			 		?>
		</div>
		<?php } ?>

		<!-- 派生子类，或实现类（当前类为一个接口时） -->
		<?php if(eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->subClassCount();")){ ?>
		<div id="derivative-subclasses">
			<?php if(eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->isInterface();")){ ?>
			实现此接口的类：
			<?php
					}else{
					?>
			派生子类:
			<?php } ?>
			
			<?php
				$__foreach_Arr_var17 = eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->subClassIterator();");
				if(!empty($__foreach_Arr_var17)){ 
					$__foreach_idx_var20 = -1;
					foreach($__foreach_Arr_var17 as $__foreach_key_var19 => $__foreach_item_var18){
						$__foreach_idx_var20++;
						 $aVariables->set("aSubClass",$__foreach_item_var18 ); ?>
				<a href="<?php echo eval("if(!isset(\$__uivar_aSubClass)){ \$__uivar_aSubClass=&\$aVariables->getRef('aSubClass') ;};
return str_replace('\\\\','/',\$__uivar_aSubClass->getName());") ;?>.html" title="<?php echo eval("if(!isset(\$__uivar_aSubClass)){ \$__uivar_aSubClass=&\$aVariables->getRef('aSubClass') ;};
return \$__uivar_aSubClass->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aSubClass)){ \$__uivar_aSubClass=&\$aVariables->getRef('aSubClass') ;};
return \$__uivar_aSubClass->getShortName();") ;?></a>;
			<?php 
					}
				}
			 		?>
		</div>
		<?php } ?>
		
		
		<!-- methods list -->
		<?php if(eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_arrRefMethods=\$__uivar_aClass->getMethods(\\ReflectionMethod::IS_PUBLIC,\$__uivar_aClass);")){ ?>
			<h5 class="ggff"><span class="title"></span>公共方法:</h5>
			<div class="normalfloat">
				<ul class="method-list">
				<?php
				$__foreach_Arr_var21 = eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
return \$__uivar_arrRefMethods;");
				if(!empty($__foreach_Arr_var21)){ 
					$__foreach_idx_var24 = -1;
					foreach($__foreach_Arr_var21 as $__foreach_key_var23 => $__foreach_item_var22){
						$__foreach_idx_var24++;
						 $aVariables->set("aMethodRef",$__foreach_item_var22 ); ?>
					<li class="method-list-item"><a href="<?php echo eval("if(!isset(\$__uivar_sThisUri)){ \$__uivar_sThisUri=&\$aVariables->getRef('sThisUri') ;};
return \$__uivar_sThisUri;") ;?>#method-<?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>()</a></li>
				<?php
						} 
					}else{
					{
					?>
					无
				<?php 
					}
				}
			 		?>
				</ul>
			</div>
		<?php } ?>
			
		<?php if(eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_arrRefMethods=\$__uivar_aClass->getMethods(\\ReflectionMethod::IS_PROTECTED,\$__uivar_aClass);")){ ?>
			<h5 class="ggff"><span class="title"></span>受保护方法:</h5>
			<div class="normalfloat">
				<ul class="method-list">
				<?php
				$__foreach_Arr_var25 = eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
return \$__uivar_arrRefMethods;");
				if(!empty($__foreach_Arr_var25)){ 
					$__foreach_idx_var28 = -1;
					foreach($__foreach_Arr_var25 as $__foreach_key_var27 => $__foreach_item_var26){
						$__foreach_idx_var28++;
						 $aVariables->set("aMethodRef",$__foreach_item_var26 ); ?>
					<li class="method-list-item"><a href="<?php echo eval("if(!isset(\$__uivar_sThisUri)){ \$__uivar_sThisUri=&\$aVariables->getRef('sThisUri') ;};
return \$__uivar_sThisUri;") ;?>#method-<?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>()</a></li>
				<?php
						} 
					}else{
					{
					?>
					无
				<?php 
					}
				}
			 		?>
				</ul>
			</div>
		<?php } ?>
			
		<?php if(eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_arrRefMethods=\$__uivar_aClass->getMethods(\\ReflectionMethod::IS_PRIVATE,\$__uivar_aClass);")){ ?>
			<h5 class="ggff"><span class="title"></span>私有方法:</h5>
			<div class="normalfloat">
				<ul class="method-list">
				<?php
				$__foreach_Arr_var29 = eval("if(!isset(\$__uivar_arrRefMethods)){ \$__uivar_arrRefMethods=&\$aVariables->getRef('arrRefMethods') ;};
return \$__uivar_arrRefMethods;");
				if(!empty($__foreach_Arr_var29)){ 
					$__foreach_idx_var32 = -1;
					foreach($__foreach_Arr_var29 as $__foreach_key_var31 => $__foreach_item_var30){
						$__foreach_idx_var32++;
						 $aVariables->set("aMethodRef",$__foreach_item_var30 ); ?>
					<li class="method-list-item"><a href="<?php echo eval("if(!isset(\$__uivar_sThisUri)){ \$__uivar_sThisUri=&\$aVariables->getRef('sThisUri') ;};
return \$__uivar_sThisUri;") ;?>#method-<?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>()</a></li>
				<?php
						} 
					}else{
					{
					?>
					无
				<?php 
					}
				}
			 		?>
				</ul>
			</div>
		<?php } ?>
		
		<!-- 继承到的方法 -->
		<?php if(eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aParentClass=\$__uivar_aClass->getParentClass();")){ ?>
		<div>
			
			<?php do{ ?>
				<h5 class="ggff"><span class="title"></span>从 <a href="<?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return str_replace('\\\\','/',\$__uivar_aParentClass->getName());") ;?>.html" title="<?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass->getName();") ;?></a> 继承的方法：</h5>
				<div class="normalfloat">
					<ul class="method-list">
	
						<?php
				$__foreach_Arr_var34 = eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass->getMethods(null,\$__uivar_aParentClass);");
				if(!empty($__foreach_Arr_var34)){ 
					$__foreach_idx_var37 = -1;
					foreach($__foreach_Arr_var34 as $__foreach_key_var36 => $__foreach_item_var35){
						$__foreach_idx_var37++;
						 $aVariables->set("aMethodRef",$__foreach_item_var35 ); ?>
							<li style="<?php if(!isset($__uivar_aMethodRef)){ $__uivar_aMethodRef=&$aVariables->getRef('aMethodRef') ;};
if($__uivar_aMethodRef->isAbstract()){; ;?>font-style:oblique;<?php }; ;?>">
							
								<!-- 函数可见性 -->
								<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isPublic();")){ ?>
									<span title="公共方法(public)"> + </span>
								<?php
					}elseif( eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isProtected();")){
					?>
									<span title="保护方法(protected)"> # </span>
								<?php
					}elseif( eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isPrivate();")){
					?>
									<span title="私有方法(private)"> - </span>
								<?php } ?>
								
							
								<!-- 最终 -->
								<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isFinal();")){ ?>
									final
								<?php } ?>
								
								<!-- 静态 -->
								<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isStatic();")){ ?>
									static
								<?php } ?>
								
								<a href="<?php echo eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return str_replace('\\\\','/',\$__uivar_aParentClass->getName());") ;?>.html#method-<?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>"><?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>()</a>
							</li>
						<?php 
					}
				}
			 		?>
						
					</ul>
				</div>
			<?php }while(eval("if(!isset(\$__uivar_aParentClass)){ \$__uivar_aParentClass=&\$aVariables->getRef('aParentClass') ;};
return \$__uivar_aParentClass=\$__uivar_aParentClass->getParentClass();"));?>
			
		</div>
		<?php } ?>
		
		
		<!-- 类常量 -->
		<?php if(eval("if(!isset(\$__uivar_arrConst)){ \$__uivar_arrConst=&\$aVariables->getRef('arrConst') ;};
if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_arrConst=\$__uivar_aClass->getConstants();")){ ?>
			<div class="normalfloat"><div>类常量：</div>
			<ul>
			<?php
				$__foreach_Arr_var38 = eval("if(!isset(\$__uivar_arrConst)){ \$__uivar_arrConst=&\$aVariables->getRef('arrConst') ;};
return \$__uivar_arrConst;");
				if(!empty($__foreach_Arr_var38)){ 
					$__foreach_idx_var41 = -1;
					foreach($__foreach_Arr_var38 as $__foreach_key_var40 => $__foreach_item_var39){
						$__foreach_idx_var41++;
						 $aVariables->set("sConstName",$__foreach_item_var39 ); ?>
				<li>
					const <?php echo eval("if(!isset(\$__uivar_sConstName)){ \$__uivar_sConstName=&\$aVariables->getRef('sConstName') ;};
return \$__uivar_sConstName;") ;?>
				</li>
			<?php 
					}
				}
			 		?>
			</ul>
			</div>
		<?php } ?>
		
		
		
		<!-- 类属性 -->
		<div class="normalfloat">	
		<div>类属性：	</div>
		<ul class="dotted">
		<?php
				$__foreach_Arr_var42 = eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getProperties();");
				if(!empty($__foreach_Arr_var42)){ 
					$__foreach_idx_var45 = -1;
					foreach($__foreach_Arr_var42 as $__foreach_key_var44 => $__foreach_item_var43){
						$__foreach_idx_var45++;
						 $aVariables->set("aRefProp",$__foreach_item_var43 ); ?>
			<li>
						
				<!-- 函数可见性 -->
				<?php if(eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->isPublic();")){ ?>
					<span title="公共方法(public)"> public </span>
				<?php
					}elseif( eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->isProtected();")){
					?>
					<span title="保护方法(protected)"> protected </span>
				<?php
					}elseif( eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->isPrivate();")){
					?>
					<span title="私有方法(private)"> private </span>
				<?php } ?>
				
				<!-- 静态方法 -->
				<?php if(eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->isStatic();")){ ?>
					static
				<?php } ?>
				
				<!-- 类型 -->
				<?php echo eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aClass->getPropertyType(\$__uivar_aRefProp->getName());") ;?>
				
				<!-- 属性名称 -->
				$<?php echo eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->getName();") ;?>
				
				<!-- 默认值 -->
				<?php if(eval("if(!isset(\$__uivar_aRefProp)){ \$__uivar_aRefProp=&\$aVariables->getRef('aRefProp') ;};
return \$__uivar_aRefProp->isDefault();")){ ?>
				<?php } ?>
			</li>
		<?php 
					}
				}
			 		?>
		</ul>
		</div>
		
		
		<pre><?php echo eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getCommentDescription();") ;?></pre>
		</div>
		
		<div class="normalfloat methodlist">
			<?php
				$__foreach_Arr_var46 = eval("if(!isset(\$__uivar_aClass)){ \$__uivar_aClass=&\$aVariables->getRef('aClass') ;};
return \$__uivar_aClass->getMethods(null,\$__uivar_aClass);");
				if(!empty($__foreach_Arr_var46)){ 
					$__foreach_idx_var49 = -1;
					foreach($__foreach_Arr_var46 as $__foreach_key_var48 => $__foreach_item_var47){
						$__foreach_idx_var49++;
						 $aVariables->set("aMethodRef",$__foreach_item_var47 ); ?>
				<?php 
$__include_aVariables = new \jc\util\HashTable() ; 
$__include_aVariables->set("aMethodRef",eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef;")) ; 
$this->display("methodPrototype.template.html",$__include_aVariables,$aDevice) ; ?>
			<?php 
					}
				}
			 		?>
		</div>
		
		<div class="clear"></div>
	</div>

</body>

</html>