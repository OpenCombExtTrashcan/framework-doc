

<div class="method-detail-item" style="<?php if(!isset($__uivar_aMethodRef)){ $__uivar_aMethodRef=&$aVariables->getRef('aMethodRef') ;};
if($__uivar_aMethodRef->isAbstract()){; ;?>font-style:oblique;<?php }; ;?>">
	<a name="method-<?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?>"></a>	
	<!-- 函数原型 -->
	<div class="method-prototype">
	
		<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isAbstract();")){ ?>
			abstract
		<?php } ?>
		
		<!-- 函数可见性 -->
		<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isPublic();")){ ?>
			<span title="公共方法(public)"> public </span>
		<?php
					}elseif( eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isProtected();")){
					?>
			<span title="保护方法(protected)"> protected </span>
		<?php
					}elseif( eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isPrivate();")){
					?>
			<span title="私有方法(private)"> private </span>
		<?php } ?>
		
		<!-- 静态 -->
		<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isStatic();")){ ?>
			static
		<?php } ?>
	
		<!-- 最终 -->
		<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->isFinal();")){ ?>
			final
		<?php } ?>
		
		<!-- 按引用返回 -->
		<?php if(eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->returnsReference();")){ ?>
			<span title="按引用返回"> & </span>
		<?php } ?>
		
		<!-- 函数返回值 -->
		<?php echo eval("if(!isset(\$__uivar_sReturnType)){ \$__uivar_sReturnType=&\$aVariables->getRef('sReturnType') ;};
if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_sReturnType=\$__uivar_aMethodRef->getReturnType();") ;?>
		
		<!-- function name -->
		<strong><?php echo eval("if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_aMethodRef->getName();") ;?></strong>
		
		<!-- arg list -->
		(
		<?php
				$__foreach_Arr_var54 = eval("if(!isset(\$__uivar_arrParamsList)){ \$__uivar_arrParamsList=&\$aVariables->getRef('arrParamsList') ;};
if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_arrParamsList=\$__uivar_aMethodRef->getParameters();");
				if(!empty($__foreach_Arr_var54)){ 
					$__foreach_idx_var57 = -1;
					foreach($__foreach_Arr_var54 as $__foreach_key_var56 => $__foreach_item_var55){
						$__foreach_idx_var57++;
						 $aVariables->set("aRefMetdParam",$__foreach_item_var55 );  $aVariables->set("nParamIdx",$__foreach_idx_var57 ); ?>
			<?php if(eval("if(!isset(\$__uivar_nParamIdx)){ \$__uivar_nParamIdx=&\$aVariables->getRef('nParamIdx') ;};
return \$__uivar_nParamIdx>0;")){ ?>,<?php } ?>
			
			<?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->type(false);") ;?>
			
			<!-- 按引用传递 -->
			<?php if(eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->isPassedByReference();")){ ?>
				<span title="按引用传递"> & </span>
			<?php } ?>
			
			
			$<?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->getName();") ;?>
			
			<?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->getDefaultValue(true);") ;?>
			
		<?php 
					}
				}
			 		?>
		 )
		 
 	</div>
 	
 	
	<!-- 参数说明 -->
	<?php if(eval("if(!isset(\$__uivar_arrParamsList)){ \$__uivar_arrParamsList=&\$aVariables->getRef('arrParamsList') ;};
return count(\$__uivar_arrParamsList);")){ ?>
	<span class="cssm">参数说明：</span>
	<ul class="method-parameter-description-list">
	
		<?php
				$__foreach_Arr_var58 = eval("if(!isset(\$__uivar_arrParamsList)){ \$__uivar_arrParamsList=&\$aVariables->getRef('arrParamsList') ;};
return \$__uivar_arrParamsList;");
				if(!empty($__foreach_Arr_var58)){ 
					$__foreach_idx_var61 = -1;
					foreach($__foreach_Arr_var58 as $__foreach_key_var60 => $__foreach_item_var59){
						$__foreach_idx_var61++;
						 $aVariables->set("aRefMetdParam",$__foreach_item_var59 ); ?>
		<li class="method-parameter-description-item">
			
			<div class="parameter-prototype">
							
				<strong>$<?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->getName();") ;?></strong>
				
				<?php if(eval("if(!isset(\$__uivar_sDefaultValue)){ \$__uivar_sDefaultValue=&\$aVariables->getRef('sDefaultValue') ;};
if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_sDefaultValue=\$__uivar_aRefMetdParam->getDefaultValue(false);")){ ?>
					= <?php echo eval("if(!isset(\$__uivar_sDefaultValue)){ \$__uivar_sDefaultValue=&\$aVariables->getRef('sDefaultValue') ;};
return \$__uivar_sDefaultValue;") ;?>
				<?php } ?>
				

				
				<div>
					<span class="fwbd">类型：</span><?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->type(true);") ;?>
				</div>
				
				<div>
					<?php if(eval("if(!isset(\$__uivar_sDefaultValue)){ \$__uivar_sDefaultValue=&\$aVariables->getRef('sDefaultValue') ;};
return \$__uivar_sDefaultValue;")){ ?>
						<span class="fwbd">默认值：</span><?php echo eval("if(!isset(\$__uivar_sDefaultValue)){ \$__uivar_sDefaultValue=&\$aVariables->getRef('sDefaultValue') ;};
return \$__uivar_sDefaultValue;") ;?>
					<?php } ?>
					(<?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->allowsNull()?\"允许\":\"不允许\";") ;?>NULL)
				</div>
			
			</div>
			
			<div class="parameter-description">
				<pre><span class="fwbd">说明：</span><?php echo eval("if(!isset(\$__uivar_aRefMetdParam)){ \$__uivar_aRefMetdParam=&\$aVariables->getRef('aRefMetdParam') ;};
return \$__uivar_aRefMetdParam->getCommentDescription();") ;?></pre>
			</div>
			
		</li>
		<?php 
					}
				}
			 		?>
		
	</ul>
	<?php } ?>
	
	<!-- 返回值类型 -->
	<div class="method-return-type">
		<span class="fwbd">返回值类型：</span>
		<?php if(eval("if(!isset(\$__uivar_sReturnType)){ \$__uivar_sReturnType=&\$aVariables->getRef('sReturnType') ;};
return \$__uivar_sReturnType;")){ ?>
			<?php echo eval("if(!isset(\$__uivar_sReturnType)){ \$__uivar_sReturnType=&\$aVariables->getRef('sReturnType') ;};
return \$__uivar_sReturnType;") ;?>
		<?php
					}else{
					?>
			mixed
		<?php } ?>
	</div>
	
	<!-- 函数说明 -->
	<?php if(eval("if(!isset(\$__uivar_sDescription)){ \$__uivar_sDescription=&\$aVariables->getRef('sDescription') ;};
if(!isset(\$__uivar_aMethodRef)){ \$__uivar_aMethodRef=&\$aVariables->getRef('aMethodRef') ;};
return \$__uivar_sDescription=\$__uivar_aMethodRef->getCommentDescription();")){ ?>
	<div class="method-description">
		<span class="fwbd">函数说明：</span><?php echo eval("if(!isset(\$__uivar_sDescription)){ \$__uivar_sDescription=&\$aVariables->getRef('sDescription') ;};
return \$__uivar_sDescription;") ;?>
	</div>
	<?php } ?>
 	
</div>

