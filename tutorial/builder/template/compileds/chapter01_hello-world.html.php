<?php

$aDevice->write(<<<OUTPUT
﻿<div id="wikipage">
<h1><span class="title"></span>"hello world"（创建JeCat项目）</h1>
<blockquote class="prepare">
	准备:<br />
	* JeCat 托管在 github.com 上，所以你需要在你的电脑上安装 git 来取得 jecat php framework 的源代码。<br />
	* 安装 PHP >= 5.3 (PHP从5.3开始支持命名空间和闭包，而 JeCat 使用了PHP的命名空间和闭包，所以要求PHP版本不低于5.3)<br />
</blockquote>
<br />
<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>首先在你的电脑上找个地方，新建一个目录"MyProject" 作为项目的根目录；然后在
MyProject 目录内新建文件 index.php 和目录 framework 。</p>
<p>目录结构如下：</p>
<pre class='code'>
<code class='plain'>
MyProject/
	framework/
	index.php
</code>
</pre>
</div>
<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>从 github.com 取得 jecat php framework 的代码放入
MyProject/framework 目录内。
</p>
<p>在Ubuntu 以及他linux操作系统或 MacOS下，可以进入到 MyProject 目录然后执行命令：</p>
<pre class='code'>
<code class='plain'>git clone git://github.com/JeCat/jecat-php-framework-framework.git framework</code>
</pre>
<p>在windows下可以使用 TorterseGit 工具下载 JeCat 框架的代码。</p>
</div>
<h3 id='s3'>step 3.</h3>
	<div class='step'>
	<p> 打开 MyProject/index.php ，输入以下代码然后保存：</p>
<pre class='code'>
<code class='php'>
&lt;?php
use jc\system\ApplicationFactory ;

// 加载 jecat php framework
include __DIR__.'/framework/inc.entrance.php' ;

// 用 Application工厂类的单件实例创建一个 Application 对象
\$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

// 向 Application 对象的输出流输出"hello world"
\$aApp->response()->output('hello world~') ;
?>
</code>
</pre>
</div>
<h3 id='s4'>step 4.</h3>
	<div class='step'>
<p>如果你使用ubuntu（或其他发行版本的linux），可以打开终端窗口，进入!MyProject目录，然后执行下面的命令。如果使用windwos作为开发环境，可以简单跳到下一个步骤.</p>
<pre class='code'>
<code class='php'>
php5 index.php
</code>
</pre>
<p>这时你会看到：</p>
<pre class='code'>
<code class='php'>
hello world~
</code>
</pre>
</div>
<h3 id='s5'>step 5.</h3>
	<div class='step'><p>JeCat PHP Framework
支持命令行模型，但是开发人员选择PHP是为了实现Web应用，所以我们当然不能只是在命令行中执行并打印一行"hello world～"。</p>
<p>接下来请配置好你的 http server，将http server 的 document root 设定到MyProject
目录，然后在浏览器中访问你的 MyProject/index.php .</p>
<p>你同样会看到网页中显示了一行：hello world~ .</p>
<h3>说明</h3>
<ol>
	<li>我们首先在在 index.php 中加载了 MyProject/framework/inc.entrance.php
	文件，这是 JeCat PHP Framework 的入口，当 inc.entrance.php 文件执行返回后，JeCat
	框架完成了初始化。 
	<pre class='code'>
		<code class='php'>
include __DIR__.'/framework/inc.entrance.php';</code>
	</pre>
	</li>
	<li>通过 ApplicationFactory::singleton() 返回了 ApplicationFactory
	类的单件实例， ApplicationFactory 是 Application类的工厂类。然后 通过
	ApplicationFactory::create() 方法创建了一个 Application 对象 。</li>
	<li>Application
	对象代表了整个应用系统，该对象维护全系统的关键资源，包括：输入(请求)/输出(响应)、类加载、请求路由、本地化支持等。</li>
	<li>Application::response() 返回一个 Response
	对象，可以通过它响应浏览器的请求，或向命令行终端输出数据。<br />
	Response:: output() 方法负责输出一些内容，当系统在命令行模式下执行时，它将内容输出到进程的标准输出管道；当系统在http
	server中运行，负责响应来自浏览器的一次请求时，该方法将内容输出给远程浏览器。 <br />
	在日后的教程中，你会发现用一个流对象来代替echo运算符，会有非常强大的好处 ^_^</li>
</ol>
<blockquote class="prepare">单件模式
几乎所有的JeCat框架中的类，都继承自 jc\lang\Object。所有的jc\lang\Object派生类，都可以通过各自的 singleton() 方法取得一个单件实例：任何时候该方法都返回同一个对象。
这对于需要实现单件模式的类非常方便。
</blockquote>
</div>

</div>

OUTPUT
) ;
?>
