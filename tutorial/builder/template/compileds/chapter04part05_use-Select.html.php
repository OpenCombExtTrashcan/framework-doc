<?php

$aDevice->write(<<<OUTPUT
<div class='page'>
	<h1><span class="title"></span>使用Select和SelectList类</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/MVC_p04.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>下面是Select和SelectList类的实例代码</p>
		<ul class='todo'>
			<li>在init函数的末尾处添加下面的代码
				<pre class='code'>
				<code class='php'>
\$selectprovince = new Select ( 'selectprovince', '选择省' );
\$selectprovince->addOption ( '请选择...', null , true );
\$selectprovince->addOption ( '辽宁', 'liaoning', false );
\$selectprovince->addOption ( '北京', 'beijing', false );
\$this->viewRegister->addWidget ( \$selectprovince );

\$selectcity = new SelectList ( 'selectcity', '选择城市', 5, true );
\$selectcity->addOptionByArray ( array (
										array ('沈阳', 'shenyang', false ),
										array ('大连', 'dalian', false ), 
										array ('锦州', 'jinzhou', true ) 
										));
\$this->viewRegister->addWidget ( \$selectcity );</code>
				</pre>
				<p>前5行是Select类,第2行到第4行是添加option选项,addOption函数的参数是:option显示的文本,option的值,是否默认选中.显然,第2行添加的option就是默认选中的.</p>
				<p>第7行开始是SelectList类,它和Select的区别是"看起来象个列表",是的,在html中他们的标签都是&lt;select>,后者只是比前者多了size属性和multiple属性,但是他们看起来几乎是完全不同的控件,所以我们把他们分成2个类来处理.
				Select类的参数很简单,SelectList类多了2个参数,第3个参数"5"是指select有多少个option是可见的,默认是4个,后面的"true"代表这个SelectList是多选的.
				第8行开始是给这个SelectList添加option,这里用的是addOptionByAarry方法,其实Select类也可以用这种方式添加option,你可以根据喜好来决定使用哪种.注意我们给SelectList对象设定第3个option是默认选中的</p>
				<blockquote class="prepare">
					你可以在上面2个对象中添加更多的option来体验他们的写法.你甚至可以试试把其中多个option的默认选中参数都设成true,看看结果如何
				</blockquote>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>然后我们去模板添加对应的标签</p>
		<ul class='todo'>
			<li>在模板文件Register.html的form标签的底部添加下面的代码
				<pre class='code'>
					<code class='html'>
&lt;label for='selectprovince'>选择省&lt;/label>&lt;widget id="selectprovince"/>&lt;br />
&lt;label for='selectcity'>选择城市&lt;/label>&lt;widget id="selectcity"/>&lt;br /></code>
				</pre>
				<p></p>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>写一些代码来输出Select和SelectList标签的值</p>
		<ul class='todo'>
			<li>修改一下process函数中的代码,以便我们提交表单后能看到表单的内容
			<pre class='code'>
					<code class='php'>
public function process() {
	if (\$this->viewRegister->isSubmit ( \$this->aParams )) {
		\$this->viewRegister->loadWidgets ( \$this->aParams );
		\$this->response()->output(\$this->aParams->get('username')) ;
		\$this->response()->output(var_export(\$this->aParams->get('passwordGroup'), TRUE)) ;
		\$this->response()->output(\$this->aParams->get('email')) ;
		\$this->response()->output(\$this->aParams->get('ademail')) ;
		\$this->response()->output(\$this->aParams->get('selectprovince')) ;
		\$this->response()->output(var_export(\$this->aParams->get('selectcity'),true)) ;
	}
}</code>
			</pre>
			</li>
		</ul>
	</div>
	
	<h3 id='s4'>step 4.</h3>
	<div class='step'>
		<p class='purpose'>现在来检验你的代码</p>
		<ul class='todo'>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你的页面</li>
			<li>在username等控件中填入一些内容,随意选中select的几个option,点击"提交表单"的按钮,看看输出的值是否和你输入的一样.反复修改Select和SelectList控件的选项状态确保他们的选中状态完全在你的掌控中</li>
		</ul>
	</div>
</div>
OUTPUT
) ;
?>
