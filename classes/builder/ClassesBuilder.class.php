<?php 
namespace jc\doc\classes\builder ;

use jc\lang\Exception;
use jc\ui\xhtml;
use jc\fs;

class ClassesBuilder
{
	public function __construct()
	{
		$this->aUI = xhtml\UIFactory::singleton()->create() ;
		$this->aUI->variables()->set('aBuilder',$this) ;
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
		$this->arrClassIndexies = array() ;
		
		// 加载所有类
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
			
			$arrPackage[$sClassName] = new ClassInfo(new \ReflectionClass($sFullClassName)) ;
			$this->arrClassIndexies[$sFullClassName] =& $arrPackage[$sClassName] ;
		}
	
		unset($this->arrClasses['jc']['doc']) ;
		
		// 建立所有类的继承关系	
		foreach($this->arrClassIndexies as $aClassInfo)
		{
			// parent class
			if( $aParentClassRef = $aClassInfo->getParentClass() and isset($this->arrClassIndexies[$aParentClassRef->getName()]) )
			{
				$this->arrClassIndexies[$aParentClassRef->getName()]->addSubClass( $aClassInfo ) ;
			}
			
			// implements interfaces
			foreach( $aClassInfo->getInterfaces() as $aInterfaceRef )
			{
				if( isset($this->arrClassIndexies[$aInterfaceRef->getName()]) )
				{
					$this->arrClassIndexies[$aInterfaceRef->getName()]->addSubClass( $aClassInfo ) ;
				}
			}
		}
	}
	
	public function build($sFolder,$sPackageName='',$arrChildren=null)
	{
		if(!$arrChildren)
		{
			$arrChildren = $this->arrClasses ;
		}
		
		foreach($arrChildren as $sName=>$child)
		{
			// package
			if( is_array($child) )
			{
				$sName = $sPackageName? ($sPackageName.'\\'.$sName): $sName ;
				
				$sPath = $sFolder.'/'.str_replace('\\', '//', $sName) ;
				if( !file_exists($sPath) )
				{
					mkdir( $sPath ) ;
				}
				
				$aFile = new fs\File( $sPath.'/index.html' ) ;
				$aStream = $aFile->openWriter() ;
				
				// variable: arrChildren
				$this->aUI->variables()->set('arrChildren',$child);
				
				// variable: sBaseUri
				$this->aUI->variables()->set('sBaseUri',str_repeat('../',substr_count($sName,'\\')+1)) ;
		
				// variable: sFullPackageName
				$this->aUI->variables()->set('sFullPackageName',$sName) ;	
				
				// variable: arrPackagePath
				$arrPackagePath = array() ;
				$sPath = '' ;
				foreach(explode('\\',$sName) as $sSubName)
				{
					$sPath.= ($sPath?'\\':'').$sSubName ;
					$arrPackagePath[$sPath] = $sSubName ;
				}
				$this->aUI->variables()->set('arrPackagePath',$arrPackagePath) ;
				$this->aUI->variables()->set('sThisUri',$sPath.'/index.html') ;
								
				try{
					$this->aUI->display('Package.template.html',null,$aStream) ;
				}
				catch(\ReflectionException $e)
				{
					throw new Exception("生成package %s的文档时遇到到了错误。",$sName,$e) ;
				}

				$aStream->close () ;
				
				echo "building package: ", $sName, "......................\r\n" ;
					
				// 递归
				$this->build($sFolder,$sName,$child) ;
			}
			
			// class
			else if( $child instanceof ClassInfo )
			{
				$this->buildClass($sFolder,$child) ;
			}
		}
	}

	private function buildClass($sFolder,ClassInfo $aClass)
	{
		echo "building class: ", $aClass->getName(), "...................." ;
		
		$aFile = new fs\File( $sFolder.'/'.str_replace('\\', '/', $aClass->getName()).'.html' ) ;
		$aStream = $aFile->openWriter() ;
		
		$this->aUI->variables()->set('aClass',$aClass) ;				
		$this->aUI->variables()->set('sBaseUri',str_repeat('../',substr_count($aClass->getNamespaceName(),'\\')+1)) ;
		$this->aUI->variables()->set('sThisUri',str_replace('\\', '/', $aClass->getName()).'.html') ;
		
		try{
			$this->aUI->display('Class.template.html',null,$aStream) ;
		}
		catch(\ReflectionException $e)
		{
			throw new Exception("生成class %s的文档时遇到到了错误。",$aClass->getName(),$e) ;
		}
		
		$aStream->close () ;
		
		echo "done\r\n" ;
	}
	
	public function classes()
	{
		return $this->arrClasses ;
	}
	
	static public function classUri($sClass)
	{
		return str_replace("\\", "/", $sClass).'.html' ;
	}
	
	static public function packageUri($sPackage)
	{
		return str_replace("\\", "/", $sPackage).'/index.html' ;
	}
	
	public function decomposePath($sPathInput)
	{
		$bReqClass = class_exists($sPathInput) ;
		
		$arrRet = array() ;
		$arrStack = explode('\\',$sPathInput) ;
		
		if($bReqClass)
		{
			$sClassName = array_pop($arrStack) ;
		}
		
		$sPath = '' ;
		while($sName=array_shift($arrStack))
		{
			$sPath.= ($sPath?'/':'').$sName ;
			$arrRet[$sPath.'/index.html'] = $sName ;
		}
		
		if($bReqClass)
		{
			$arrRet[$sPath.'/'.$sName.'.html'] = $sName ;
		}
		
		return $arrRet ;
	}
	
	static public function trimCommentDescription($sComment)
	{
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
	
	private $arrClasses = array() ;
	private $arrClassIndexies = array() ;
	
	/**
	 * @var jc\ui\UI
	 */
	private $aUI ;
}

?>