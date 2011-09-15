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
UIFactory::singleton()->sourceFileManager()->addFolder( $aApp->fileSystem ()->findFolder('/template/') ) ;

$arrChapters = array(
	'chapter01_hello-world.html' ,
	'chapter02_file-operation.html' ,
	'chapter03.html',
	'chapter03part01_if.html',
	'chapter03part02_loop.html',
	'chapter03part03_foreach.html',
	'chapter03part04_macro.html',
	'chapter03part05_finish.html',
	'chapter04.html',
	'chapter04part00_pre.html',
	'chapter04part01_use-Text.html',
	'chapter04part02_process.html',
	'chapter04part03_use-Group.html',
	'chapter04part04_use-CheckBtn.html',
	'chapter04part05_use-Select.html',
	'chapter04part06_use-File.html',
	'chapter04part07_style-for-widget.html',
	'chapter04part08_finish.html',
	'chapter05.html',
	'chapter05part00_pre.html',
	'chapter05part01_method1.html',
	'chapter05part02_method2.html',
	'chapter05part03_method3.html',
	'chapter06.html',
	'chapter06part01_dataexchange.html',
	'chapter07.html',
	'chapter07part00_pre.html',
	'chapter07part01_singleIndex.html',
	'chapter07part02_createView-createModel.html',
	'chapter09.html',
	'chapter09part00_pre.html',
	'chapter09part01_NotEmpty-verifier.html',
	'chapter09part02_Length-verifier.html',
	'chapter09part03_Number-Email-Same-verifier.html',
	'chapter09part04_FileExt-FileSize-verifier.html',
) ;

$aUI = UIFactory::singleton()->create() ;

foreach($arrChapters as $sChapterFilename)
{
	$aWriter = new OutputStream( fopen(__DIR__.'/../html/'.$sChapterFilename,'w') ) ;
	$aUI->display('frame.html',array('sBodyFile'=>$sChapterFilename),$aWriter) ;
	
	$aApp->response()->output("build html page: ../html/".$sChapterFilename) ;
}

?>
