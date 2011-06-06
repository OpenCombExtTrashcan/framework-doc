<?php 
namespace jc\doc\classes\builder ;

class ClassInfo
{
	public function __construct(\ReflectionClass $aRefClass)
	{
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
	
	private $aRefClass ;
	
	private $arrSubClasses = array() ;
}

?>