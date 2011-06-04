<?php 
namespace jc\doc\classes\builder ;

class ClassInfo
{
	public function __construct(\ReflectionClass $aRefClass)
	{
		$this->aRefClass = $aRefClass ;
	}
	
	/**
	 * @return \ReflectionClass
	 */
	public function reflect()
	{
		return $this->aRefClass ;
	}
	
	private $aRefClass ;
}

?>