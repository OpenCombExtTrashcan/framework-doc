<div class='page'>
	<h1>使用Group类</h1>
	<blockquote>
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/MVC_p02.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>你已经学会如何创建控件对象了,这次我们介绍一个特殊的控件对象.</p>
			<ul class='todo'>
			<li>创建2个Text对象,放在username对象的后面,请参考下面的代码
				<pre class='code'>
					<code class='php'>
protected function init() {
	$this->createFormView( "Register" );
	
	$username = new Text ( 'username', '用户名', '', TEXT::single );
	$this->viewRegister->addWidget ( $username );
			
	$password1 = new Text ( 'password1', '确认密码1', '', Text::password );
	$this->viewRegister->addWidget ( $password1 );
	
	$password2 = new Text ( 'password2', '确认密码2', '', Text::password );
	$this->viewRegister->addWidget ( $password2 );
	
	$group = new Group ( 'passwordGroup', '密码核对' );
	$group->addWidget ( $password1 );
	$group->addWidget ( $password2 );
	$this->viewRegister->addWidget ( $group );
}</code>
				</pre>
				<p>从第7行开始是新创建的2个Text控件,注意他们的type参数都是password,而不是single,同样的,他们也被viewRegister管理</p>
				<p>第12行开始是一个新的控件叫做Group,它的作用是把很多控件对象添加到一个组中,让他们用起来就像是一个对象一样,它的参数比Text简单多了,相信你一看就知道他们的含义了</p>
			</li>
			<li>时刻不要忘记,每次你使用了一个类,检查一下他们是否已经声明.去看看代码头部那几行use语句是否包含了下面的代码,没有的话别忘记加上.
				<pre class='code'>
					<code class='php'>
use jc\mvc\view\widget\Group;</code>
				</pre>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>然后我们去模板添加对应的标签</p>
		<ul class='todo'>
			<li>添加控件的标签,然后模板看起来应该是这样:
				<pre class='code'>
					<code class='html'>
&lt;msgqueue for="$theView" />
&lt;form id="theform" method='post'>
	&lt;label for="username">用户名:&lt;/label>&lt;widget id='username'/>
	&lt;label for='password1'>密码&lt;/label>&lt;widget id="password1"/>&lt;br />
	&lt;label for='password2'>确认密码&lt;/label>&lt;widget id="password2"/>&lt;br />
	&lt;input type='submit' value='提交表单'/>
&lt;/form></code>
				</pre>
				<p>你应该发现了,我们没有添加Group的模板.其实我们用Group类的目的只是组合2个Text控件,而它本身没有必要显示什么样式,我们只要把2个Text对象的标签写上就好了</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>是Group展示身手的时候了</p>
		<ul class='todo'>
			<li>修改一下process函数中的代码
			<pre class='code'>
					<code class='php'>
public function process() {
	if ($this->viewRegister->isSubmit ( $this->aParams )) {
		$this->viewRegister->loadWidgets ( $this->aParams );
		$this->response()->output($this->aParams->get('username')) ;
		$this->response()->output(var_export($this->viewRegister->widget ( 'passwordGroup')->value() ,true)) ;
	}
}</code>
			</pre>
			<p>注意第5行,它把Group对象的值打印了出来,值是一个数组,数组包含了2个Text对象的值,这就是Group的好处.想想看,由于Group的这种特性,一行语句操作很多个控件对象就变得很简单了,而且对这些控件对象值的操作也可以在一个数组处理中完成</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s4'>step 4.</h3>
	<div class='step'>
		<p class='purpose'>现在来检验你的代码</p>
		<ul class='todo'>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你的页面</li>
			<li>在username文本框和2个password文本框中随意输入一些文字,注意password类型是不是隐藏了密码,点击"提交表单"的按钮,看看输出的值是否和你输入的一样.</li>
		</ul>
	</div>
</div>