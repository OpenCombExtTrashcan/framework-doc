<?php 
namespace jc\doc\classes\builder ;

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


$aClassesReflecter = new ClassesBuilder() ;

$aClassesReflecter->load(FileSystem::formatPath(__DIR__.'/../../../framework/src/lib.php')) ;

$aClassesReflecter->build(__DIR__.'/../html') ;


?>
