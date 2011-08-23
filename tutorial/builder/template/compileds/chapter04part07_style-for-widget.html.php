<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>给widget添加样式和属性</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/MVC_p06.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	
	<p>控件类的使用改变了html页面中标签的书写方式,如果要对模板进行美化工作,我们应该怎么作呢?</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>以username控件为例,我们对它的模板进行修改,让它支持style属性和class属性</p>
			<ul class='todo'>
				<li>进入user文件夹,编辑Register.php文件,找到init函数
					<pre class='code'>
						<code class='html'>
&lt;widget id='username' /></code>
					</pre>
				</li>
				
			</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>你已经完成了添加控件的步骤,现在来检验你的代码</p>
		<ul class='todo'>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你的页面</li>
			<li>你的页面应该有一个id为username的输入框和一个名为"提交表单"的按钮,说明你成功的使用了Jecat提供的控件类.但是这个表单还不能提交,下一节就告诉你如何处理这个表单提交的内容</li>
		</ul>
	</div>
</div>
OUTPUT
) ;
?>
