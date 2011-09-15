<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>单一入口</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 确定你正确部署了本章教程第一节"准备工作"中的代码.<br />
	</blockquote>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<ul class='todo'>
			<li>在class/controller文件夹下的每个php文件都是一个controller类,他们的代码很简单,只是创建了一个view,
			这样我们访问到这个控制器的时候它会显示出内容来.至于创建view的方式我们会在后面的章节介绍.
			</li>
			<li>那么,如果让这些控制器拥有统一的入口呢?打开index.php文件,代码如下:
	<pre class='code'>
	<code class='php'>
&lt;?php
//初始化Jecat
\$aApp = require_once dirname ( __DIR__ ) . '/controller/inc.common.php';

//url简写
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerA" , 'cA');
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerB" , 'cB');
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerC" , 'cC');

//注册package
\$aApp->classLoader()->addPackage("ctest" , "/class" , null );

//自动实例化controller相应页面请求
\$aController = \$aApp->accessRouter()->createRequestController(\$aApp->request()) ;

//运行controller
\$aController->mainRun();
?></code>
</pre>
	<p>第3行加载Jecat框架,第11行把我们上面提到的几个控制器的命名空间加载到系统中,这样Jecat的自动加载系统就知道应该加载哪些文件了.
	addPackage的第一个参数是那些controller类所属的命名空间,第2个参数是第一个参数所说的命名空间下的文件都在存储在哪个路径下,
	第3个参数是编译后源码路径,这个暂时不用管,null就可以.</p>
	<p>14行根据用户那边发来的请求的url内容来判断应该用哪个controller提供服务,并把那个controller自动的实例化</p>
	<p>17行把14行实例化的controller"跑"起来.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>打开你的浏览器,使用 http://你的域名/controller/?c=ctest.controller.ControllerA 访问浏览器,你会看到我们实例代码中controllerA
		模板中所写的内容.</p>
		<ul class='todo'>
			<li>再把网址最后的"ControllerA"改成"ControllerB",就可以访问ControllerB控制器了.
				<p>你应该看到规律了,url参数c的值就是要访问的控制器的命名空间加上类名.</p>
				<p>不过这样的url稍微长了一些,让我们把url的规则改写一下.</p>
			</li>
			<li>在index.php中找到以下代码
				<pre class='code'>
	<code class='php'>
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerA" , 'cA');
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerB" , 'cB');
//\$aApp->accessRouter()->addController("ctest\\controller\\ControllerC" , 'cC');</code>
</pre>
	<p>把他们的注释去掉,这样你就可以用简写的方式:　http://你的域名/controller/?c=cA　来访问控制器了.</p>
			</li>
		</ul>
	</div>
</div>

OUTPUT
) ;
?>
