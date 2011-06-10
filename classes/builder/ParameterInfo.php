<?php 
namespace jc\doc\classes\builder ;

class ParameterInfo
{
	public function __construct(MethodInfo $aFunctionInfo, \ReflectionParameter $aRefParameter)
	{
		$this->aRefParameter = $aRefParameter ;
		$this->aFunctionInfo = $aFunctionInfo ;
	}
	
	/**
	 * @return \ReflectionParameter
	 */
	public function reflect()
	{
		return $this->aRefParameter ;
	}
	
	public function __call($sFunc,$arrArgvs=array())
	{
		return call_user_func_array(array($this->aRefParameter,$sFunc), $arrArgvs) ;
	}
	
	public function getDefaultValue($sFull=false)
	{
		if(!$this->isDefaultValueAvailable())
		{
			return '' ;
		}
		
		try{
			$defaultVal = $this->aRefParameter->getDefaultValue() ;
		}catch(\ReflectionException $e)
		{
			return '' ;
		}
		
		if( is_string($defaultVal) )
		{
			$defaultVal = '"'.addslashes($defaultVal).'"' ;
		}
		else if($defaultVal===null)
		{
			$defaultVal = 'null' ;
		}
		else if($defaultVal===false)
		{
			$defaultVal = 'false' ;
		}
		else 
		{
			$defaultVal = var_export($defaultVal,true) ;
		}
		
		return ($sFull?'= ':'').$defaultVal ;
	}
	
	public function type($bFullClass=true)
	{
		if( $aTypeClass = $this->getClass() )
		{
			$sPath = str_replace('\\', '/', $aTypeClass->getName()).'.html' ;
			return "<a href='{$sPath}' title='".$aTypeClass->getName()."'>"
						. ($bFullClass?$aTypeClass->getName():$aTypeClass->getShortName())
						. "</a>" ;
		}
		
		else if( $this->isArray() )
		{
			return 'array' ;
		}
		
		else if( preg_match('/^([snfba]|arr)[A-Z\\d]/',$this->getName(),$arrRes) )
		{
			switch($arrRes[1])
			{
				case 's':
					return 'string' ;
				case 'b':
					return 'bool' ;
				case 'f':
					return 'float' ;
				case 'd':
					return 'double' ;
				case 'a':
					return 'object' ;
				case 'arr':
					return 'array' ;
			}
		}
		
		return 'mixed' ;
	}
	
	public function getCommentDescription()
	{
		$sFunctionComment = $this->aFunctionInfo->getDocComment() ;
		$sName = $this->getName() ;
		
		if( preg_match( "|@param\\t+([^\\t]+\\t+)?\\$?{$sName}\\t+([^\\t]+)|i",$sFunctionComment,$arrRes ) )
		{
			return trim($arrRes[2]) ;
		}
		else
		{
			return '' ;
		}
	}
	
	private $aRefParameter ;
	
	private $aFunctionInfo ;
	
}

?>