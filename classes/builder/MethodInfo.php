<?php 
namespace jc\doc\classes\builder ;

class MethodInfo
{
	public function __construct(\ReflectionMethod $aRefMethod)
	{
		$this->aRefMethod = $aRefMethod ;
	}
	
	
	/**
	 * @return \ReflectionMethod
	 */
	public function reflect()
	{
		return $this->aRefMethod ;
	}
	
	public function __call($sFunc,$arrArgvs=array())
	{
		return call_user_func_array(array($this->aRefMethod,$sFunc), $arrArgvs) ;
	}
	
	public function getReturnType()
	{
		$sComment = $this->getDocComment() ;
		
		if( preg_match( "|@return\\s+([^\\n]+)|i",$sComment,$arrRes ) )
		{
			return trim($arrRes[1]) ;
		}
		
		else 
		{
			return '' ;
		}
	}
	
	public function getCommentDescription()
	{
		$sComment = $this->getDocComment() ;
		if(!$sComment)
		{
			return '' ;
		}

		// 去头,去尾 （"/**","*/"）
		$sComment = preg_replace('|^\\s*/\\*\\*|', '', $sComment) ;
		$sComment = preg_replace('|\\*/\\s*$|', '', $sComment) ;
		
		// 统一换行符
		$sComment = str_replace("\r","\n",$sComment) ;
		
		$arrLines = explode("\n", $sComment) ;
		foreach($arrLines as $idx=>&$sLine)
		{
			$sLine = trim($sLine) ;
			if(!$sLine)
			{
				unset($arrLines[$idx]) ;
				continue ;
			}
			
			$sLine = preg_replace('|^\\s*\\*\\s*|', '', $sLine) ;
			
			if( preg_match('|^\\s*@\\w+|',$sLine) )
			{
				unset($arrLines[$idx]) ;
				continue ;
			}
		}
		
		return implode("\r\n",$arrLines) ;
	}
	
	public function getParameters()
	{
		$arrParameters = $this->aRefMethod->getParameters() ;
		foreach($arrParameters as &$aItem)
		{
			$aItem = new ParameterInfo($this,$aItem) ;
		}
		return $arrParameters ;
	}
	
	private $aRefMethod ;
	
}

?>