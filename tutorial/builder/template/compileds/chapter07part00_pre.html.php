<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>准备工作</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
	</blockquote>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<ul class='todo'>
			<li>准备工作:首先你要已经部署好Jecat,然后下载<a href='../code/controller_p01.zip'>实例代码</a>,解压到Jecat的framwork目录同级.部署好以后目录结构如下:
	<pre class='code'>
	<code class='plain'>
(根目录)\
	framework\
	controller\
		index.php
		inc.common.php
		class\
			controller\
				ControllerA.php
				ControllerB.php
				ControllerC.php
		template\
			viewA.html
			viewB.html
			viewC.html
</code>
</pre>
	<p>最上层的controller目录是我们的程序目录,里面的inc.common.php文件会加载Jecat的主程序,之后我们的程序就在Jecat代码的基础上运行了.index.php文件是本节程序的入口,我们一会就要用浏览器访问它来查看程序运行结果.
	template目录是模板文件目录.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>验证刚刚部署的程序,用浏览器访问 http://你的域名/controller/?c=ctest.controller.ControllerA ,你应该会看到一个列表.
		接着看下一节.</p>
	</div>
</div>

OUTPUT
) ;
?>
