<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>if标签</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你不想自己构建程序的目录,可以直接下载<a href='../code/template_p01.zip'>代码包</a><br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>首先构建目录结构.</p>
			<ul class='todo'>
				<li>进入framework同级的文件夹下,新建te文件夹,我们就在这个目录里面进行我们的实验</li>
				<li>新建te.php文件,这是本章程序的入口,它会加载Jecat框架,加载模板等等</li>
				<li>新建template文件夹</li>
				<li>在template文件夹里新建template.html文件</li>
			</ul>
		<p>都建立好后工程文件夹的结构看起来就像这样:</p>
		<pre class='code'>
			<code class='plain'>
				(工程目录)/
					framework/
					te/
						template/
							template.html
						te.php
			</code>
		</pre>
	</div>
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>然后我们向这些文件添加一些初始代码</p>
		<ul class='todo'>
		<li>
			打开te.php文件,添加如下代码:
			<pre class='code'>
				<code class='php'>
&lt;?php
use jc\ui\xhtml\UIFactory ;
use jc\system\ApplicationFactory;

// 初始化 jcat 框架
include __DIR__."/../framework/inc.entrance.php" ;

\$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

// 加载模板
UIFactory::singleton()->sourceFileManager()->addFolder( \$aApp->fileSystem ()->findFolder('/template/')) ;

// 创建一个 UI 对象
\$aUI = UIFactory::singleton()->create() ;

// 设置可以在模板文件里使用的变量
\$aUI->variables()->set('bTrue' , true) ;

// 渲染并向浏览器显示一个模板文件
\$aUI->display('template.html') ;
?></code>
			</pre>
			<p>第6行是在调用Jecat框架下的初始化文件,这样就完成了Jecat的加载,在这之后的代码就是在Jecat框架下运行了.</p>
			<p>第8行是在创建一个Applacation对象,这个对象是系统执行的"线索",整个系统按照它的调遣来完成页面请求的处理.</p>
			<p>第11行是在告诉系统我们设置的模板文件夹在哪里.</p>
			<p>第14行创建一个UI对象,我们给模板传值和显示模板全靠它.</p>
			<p>第18行我们向模板传递了一个变量bTrue,它的值是true,后面我们会告诉你如果使用他们</p>
			<p>最后一行是让UI对象显示模板</p>
		</li>
		<li>
			进入template文件夹,打开template.html文件,添加如下代码:
			<pre class='code'>
				<code class='html'>
&lt;if \$bTrue >
	&lt;p>if条件为true的情况&lt;/p>
&lt;/if></code>
			</pre>
			<p>这是一个if标签,它以html标签的姿态写在html文件中,它第一个匿名属性就是它的判断条件,我们把刚才在te.php文件中定义的bTrue变量作为它的判断条件.</p>
			<p>if标签是成对的,它包含的内容就是判断为true的时候执行的语句,可以是html或者其他任何代码.</p>
		</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/te/te.php 然后回车来访问你刚刚构建的页面</li>
			<li>看看页面是否输出了"if条件为true的情况",如果成功再试试把te.php页面中的把bTrue的值改成false再试一次.</li>
		</ul>
	</div>
	
	<h3 id='s4'>step 4.</h3>
	<div class='step'>
		<p class='perpose'>有if就有else,让我们看看else标签怎么用</p>
		<ul class='todo'>
			<li>修改template.html文件
				<pre class='code'>
				<code class='html'>
&lt;if \$bTrue >
	&lt;p>if条件为true的情况&lt;/p>
	&lt;else />
	&lt;p>if条件为false的情况&lt;/p>
&lt;/if></code>
				</pre>
				<p>注意else标签是单行标签,它必须在if的内部出现.</p>
				<p>把te.php文件中的把bTure的值改成false,然后刷新一下页面看看是不是只显示后面的那一行文本.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s5'>step 5.</h3>
	<div class='step'>
		<p class='perpose'>我猜你一定还想要elseif</p>
		<ul class='todo'>
			<li>修改template.html文件
				<pre class='code'>
				<code class='html'>
&lt;if \$bTrue >
	&lt;p>if条件为true的情况&lt;/p>
	&lt;else "\$bTrue == false"/>
	&lt;p>if条件为false的情况&lt;/p>
&lt;/if></code>
				</pre>
				<p>很简单,把完整的条件表达式写在else标签后面作为匿名属性就可以了.只是别忘记用双引号</p>
				<p>刷新一下页面看看是不是只显示后面的那一行文本.</p>
			</li>
		</ul>
	</div>
</div>
OUTPUT
) ;
?>
