<?php 
namespace jc\doc\classes\builder ;

use jc\system\Application;
use jc\ui\xhtml;
use jc\fs;
use jc\fs\FSO ;

include_once __DIR__.'/../../../framework/inc.entrance.php' ;
$aApp = Application::singleton(true) ;

$aApp->classLoader()->addPackage(__DIR__,__NAMESPACE__) ;
xhtml\Factory::singleton()->sourceFileManager()->addFolder(__DIR__.'/template/') ;


$aClassesReflecter = new ClassesBuilder() ;

$aClassesReflecter->load(FSO::formatPath(__DIR__.'/../../../framework/src/lib.php')) ;

$aClassesReflecter->build(__DIR__.'/../html') ;


?>