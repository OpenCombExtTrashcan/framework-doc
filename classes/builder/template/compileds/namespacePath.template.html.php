<?php
				$__foreach_Arr_var50 = eval("if(!isset(\$__uivar_aBuilder)){ \$__uivar_aBuilder=&\$aVariables->getRef('aBuilder') ;};
if(!isset(\$__uivar_sPath)){ \$__uivar_sPath=&\$aVariables->getRef('sPath') ;};
return \$__uivar_aBuilder->decomposePath(\$__uivar_sPath);");
				if(!empty($__foreach_Arr_var50)){ 
					$__foreach_idx_var53 = -1;
					foreach($__foreach_Arr_var50 as $__foreach_key_var52 => $__foreach_item_var51){
						$__foreach_idx_var53++;
						 $aVariables->set("sUri",$__foreach_key_var52);  $aVariables->set("sName",$__foreach_item_var51 ); ?><!-- 
	 --><a class="next" href="<?php echo eval("if(!isset(\$__uivar_sUri)){ \$__uivar_sUri=&\$aVariables->getRef('sUri') ;};
return \$__uivar_sUri;") ;?>"><?php echo eval("if(!isset(\$__uivar_sName)){ \$__uivar_sName=&\$aVariables->getRef('sName') ;};
return \$__uivar_sName;") ;?></a><!-- 
 --><?php 
					}
				}
			 		?>