<?php 
namespace jc\doc\classes\builder ;

use jc\ui\xhtml;

use jc\fs;

class ClassesBuilder
{
	public function __construct()
	{
		$this->aUI = xhtml\Factory::singleton()->create() ;
	}
	
	public function load($sEntrance)
	{
		foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sEntrance)) as $sPath)
		{
			if(preg_match('/.svn/',$sPath))
			{
				continue ;
			}
			if(preg_match('/.php$/i',$sPath))
			{
				// echo "loading class: ", $sPath, "\r\n" ;			
				include_once $sPath ;
			}
		}
	
		$this->arrClasses = array() ;
		
		foreach(array_merge(get_declared_classes(),get_declared_interfaces()) as $sFullClassName)
		{
			if(!preg_match("|^jc\\\\|",$sFullClassName))
			{
				continue ;
			}
			
			$arrNamespaces = explode('\\',$sFullClassName) ;
			$sClassName = array_pop($arrNamespaces) ;
			
			$arrPackage =& $this->arrClasses ;
			while($sPackageName=array_shift($arrNamespaces))
			{
				if(!isset($arrPackage[$sPackageName]))
				{
					$arrPackage[$sPackageName] = array() ;
				}
				
				$arrPackage =& $arrPackage[$sPackageName] ;
			}
			
			$arrPackage[$sClassName] = new \ReflectionClass($sFullClassName) ;
		}
	
		unset($this->arrClasses['jc']['doc']) ;
	}
	
	public function build($sFolder,$arrPackage=null)
	{
		if(!$arrPackage)
		{
			$arrPackage = $this->arrClasses['jc'] ;
		}
		
		foreach($arrPackage as $sName=>$child)
		{
			// package
			if( is_array($child) )
			{
				if( !file_exists($sFolder.'/'.$sName) )
				{
					mkdir( $sFolder.'/'.$sName ) ;
					echo "build package: ", $sName, "\r\n" ;
				}
				
				// 递归
				$this->build($sFolder.'/'.$sName,$child) ;
			}
			
			// class
			else if( $child instanceof \ReflectionClass )
			{
				$aFile = new fs\File( $sFolder.'/'.$sName.'.html' ) ;
				$aStream = $aFile->openWriter() ;
				
				$this->aUI->display('Class.template.html',null,$aStream) ;
				
				$aStream->close () ;
				
				echo "build class: ", $child->getName(), "\r\n" ;
			}
		}
	}
	
	private $arrClasses = array() ;
	
	private $aUI ;
}

?>