<?php 
namespace jc\doc\classes\builder ;

class ClassInfo
{
	public function __construct(\ReflectionClass $aRefClass)
	{
		$arrDefaultProperties = $aRefClass->getDefaultProperties() ;
		$this->aRefClass = $aRefClass ;

		
	}
	
	public function packagePath()
	{
		$arrNames = explode('\\', $this->aRefClass->getName()) ;
		array_pop($arrNames) ;
		
		$sNamespace = '' ;
		$arrPackages = array() ;
		foreach($arrNames as $sName)
		{
			$sNamespace.= ($sNamespace?'\\':'').$sName ;
			$arrPackages[$sNamespace] = $sName ;
		}
		
		return $arrPackages ;
	}
	
	/**
	 * @return \ReflectionClass
	 */
	public function reflect()
	{
		return $this->aRefClass ;
	}
	
	public function __call($sFunc,$arrArgvs=array())
	{
		return call_user_func_array(array($this->aRefClass,$sFunc), $arrArgvs) ;
	}
	
	public function addSubClass(self $aClass)
	{
		$this->arrSubClasses[] = $aClass ;
	}
	
	public function subClassCount()
	{
		return count($this->arrSubClasses) ;
	}
	
	public function subClassIterator()
	{
		return new \ArrayIterator($this->arrSubClasses) ;
	}
	
	public function getParentClass()
	{
		$aParentClassRef = $this->aRefClass->getParentClass() ;
		return $aParentClassRef? new self( $aParentClassRef ): $aParentClassRef ;
	}
	
	public function getMethods($nFlags,$class=null)
	{
		$arrMethods = $nFlags? $this->aRefClass->getMethods($nFlags): $this->aRefClass->getMethods() ;
	
		if($class)
		{
			if( $class instanceof self )
			{
				$class = $class->getName() ;
			}
		}
		
		foreach($arrMethods as $idx=>$aMethodRef)
		{
			if( $class and $aMethodRef->getDeclaringClass()->getName()!=$class)
			{
				unset($arrMethods[$idx]) ;
			}
			else 
			{
				$arrMethods[$idx] = new MethodInfo($aMethodRef) ;
			}
		}

		return $arrMethods ;
	}

	public function getCommentDescription()
	{
		$sComment = $this->getDocComment() ;
		if(!$sComment)
		{
			return '' ;
		}
		return ClassesBuilder::trimCommentDescription($sComment) ;
	}
	
	public function getPropertyType($sName)
	{
		$sDocComment = $this->getProperty($sName)->getDocComment() ;
		if( preg_match( "|\\n\\s+@var\\s+([^\\n]+)|i",$sDocComment,$arrRes ) )
		{
			return trim($arrRes[1]) ;
		}
		
		return ParameterInfo::detemineTypeByName($sName) ;
	}
		
	
	private $aRefClass ;
	
	private $arrSubClasses = array() ;
	
	private $axx ;
}

?>