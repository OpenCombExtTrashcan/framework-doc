<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>loop标签</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你不想自己构建程序的目录,可以直接下载<a href='../code/template_p01.zip'>代码包</a><br />
	</blockquote>
	<p>loop其实就是for语句,它循环执行内部代码一定的次数,本节就介绍如何使用它</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>我们要用loop标签显示一个列表</p>
		<ul class='todo'>
		<li>
			进入template文件夹,打开template.html文件,添加如下代码:
			<pre class='code'>
				<code class='html'>
&lt;ul>
&lt;loop end='10'>
	&lt;li>一个空的li标签&lt;/li>
&lt;/loop>
&lt;/ul></code>
			</pre>
			<p>最外层是个ul标签,里面的loop标签会让最内层的li标签重复出现10次</p>
			<p>你可能已经猜到了,loop标签的end属性的值就是它循环的次数,loop标签默认从0开始,循环的条件是循环次数小于10,那么从0到9正好执行了10次.</p>
		</li>
		<li>如果你把代码改成下面这样,运行的结果也是一样的
		<pre class='code'>
				<code class='html'>
&lt;ul>
&lt;loop start='0' end='10' step='1'>
	&lt;li>一个空的li标签&lt;/li>
&lt;/loop>
&lt;/ul></code>
			</pre>
			<p>start属性是指循环开始的数字,step是每次循环给这个数字增加的跨度.</p>
		</li>
		<li>有的时候你需要知道循环到了第几次.我们提供了var属性
		<pre class='code'>
				<code class='html'>
&lt;ul>
&lt;loop start='0' end='10' step='1' var='index'>
	&lt;li>
OUTPUT
) ;
echo eval("if(!isset(\$__uivar_index)){ \$__uivar_index=&\$aVariables->getRef('index') ;};
return \$__uivar_index;") ;
$aDevice->write(<<<OUTPUT
&lt;/li>
&lt;/loop>
&lt;/ul></code>
			</pre>
			<p>var属性允许你指定一个变量名,用来储存循环的计数.</p>
			<p>第3行把循环计数输出出来,
OUTPUT
) ;
echo eval("return ;") ;
$aDevice->write(<<<OUTPUT
是Jecat的宏语法,后面的章节我们会讲到他们的用法.</p>
		</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/te/te.php 然后回车来访问你刚刚构建的页面</li>
			<li>不断的尝试修改loop中各个属性的值然后运行他们,记住他们的作用.</li>
		</ul>
	</div>
	<blockquote class='prepare'>
		Jecat还提供了do标签和while标签来提供PHP中do while 和while do 语法类似的功能,和loop类似他们都是循环语句.他们的用法和loop标签类似,你可以通过Jecat手册来了解他们的用法.
	</blockquote>
</div>
OUTPUT
) ;
?>
