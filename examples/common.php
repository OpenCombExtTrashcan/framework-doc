<?php 
namespace jc\doc\examples ;

use jc\lang\Factory as UIFactory ;
use jc\system\Application ;
use jc\db\DB ;
use jc\db\PDODriver ;

// 加载并初始化框架
require __DIR__."/../../framework/inc.entrance.php" ;

// 创建项目实例
$aApp = Application::singleton(true) ;

// 数据库设定
DB::singleton()->setDriver( new PDODriver("mysql:host=127.0.0.1;dbname=www",'root','1') ) ;

// 设置 ui 模板目录
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;

return $aApp ;
?>