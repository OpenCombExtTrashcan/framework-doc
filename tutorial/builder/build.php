<?php 

namespace jc\doc\classes\builder ;

use jc\io\OutputStream;

use jc\fs\FileSystem;
use jc\system\ApplicationFactory;
use jc\fs\imp\LocalFileSystem;
use jc\system\Application;
use jc\ui\xhtml\UIFactory;
use jc\fs\FSO ;

include_once __DIR__.'/../../../framework/inc.entrance.php' ;
$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

$aApp->classLoader()->addPackage(__NAMESPACE__,null,'/') ;
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/template/') ;

$arrChapters = array(
	'chapter01_hello-world.html' ,
	'chapter02_file-operation.html' ,
) ;

$aUI = UIFactory::singleton()->create() ;

foreach($arrChapters as $sChapterFilename)
{
	$aWriter = new OutputStream( fopen(__DIR__.'/../html/'.$sChapterFilename,'w') ) ;
	$aUI->display('frame.html',array('sBodyFile'=>$sChapterFilename),$aWriter) ;
	
	$aApp->response()->output("build html page: ../html/".$sChapterFilename) ;
}

?>