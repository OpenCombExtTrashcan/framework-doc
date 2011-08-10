﻿<p>
	准备： 
	<ul>
		<li>JeCat 托管在 github.com 上，所以你需要在你的电脑上安装 git 来取得 jecat php framework 的源代码。</li>
		<li>安装 PHP >= 5.3 (PHP从5.3开始支持命名空间和闭包，而 JeCat 使用了PHP的命名空间和闭包，所以要求PHP版本不低于5.3)</li>
	</ul>
</p>

<p>
	step 1. 首先在你的电脑上找个地方，新建一个目录"MyProject" 作为项目的根目录；然后在 MyProject 目录内新建文件 index.php 和目录 framework 。
</p>

<p>
	目录结构如下： <br />
	MyProject/<br />
	　　framework/<br />
	　　index.php
</p>

<p>
step 2. 从 github.com 取得 jecat php framework 的代码放入 MyProject/framework 目录内。
</p>

<p>在Ubuntu 以及他linux操作系统或 MacOS下，可以进入到 MyProject 目录然后执行命令：</p>
<div>git clone git://github.com/JeCat/jecat-php-framework-framework.git framework  </div>
<p>在windows下可以使用 TorterseGit 工具下载 JeCat 框架的代码。</p>


step 3. 打开 MyProject/index.php ，输入以下代码然后保存：
<code lang="php"><?php
ob_flush() ;
$var0 = new \jc\ui\xhtml\compiler\node\CodeColor() ;
\jc\io\StdOutputFilterMgr::singleton()->add(array($var0,'outputFilter')) ;
?>
<? ob_flush(); echo '<','?' ; ?>php
use jc\system\ApplicationFactory ;

// 加载 jecat php framework
include __DIR__.'/framework/inc.entrance.php' ;

// 用 Application工厂类的单件实例创建一个 Application 对象
$aApp = ApplicationFactory::singleton()->create(__DIR__) ; 

// 向 Application 对象的输出流输出"hello world" 
$aApp->response()->output('hello world~') ;  

<? ob_flush(); echo '?','>' ; ?>
<?php
ob_flush() ;
\jc\io\StdOutputFilterMgr::singleton()->remove( array($var0,'outputFilter') ) ;
$var0->output($aDevice) ;?></code>