<div>
	<h1><span class="title"></span>使用校验器</h1>
	<p>本节告诉你如何来给控件对象添加非空验证器</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>先是给控制器加入验证步骤</p>
<pre class='code'>
<code class='php'>
if (! $this->viewRegister->verifyWidgets ()) {
	$aMsgQueue = $this->messageQueue ();
	return;
}
</code>
</pre>
			<p>加好以后整个process函数代码如下</p>
<pre class='code'>
<code class='php'>
public function process() {
	if ($this->viewRegister->isSubmit ( $this->aParams )) {
		$this->viewRegister->loadWidgets ( $this->aParams );
		if (! $this->viewRegister->verifyWidgets ()) {  //让视图对控件进行验证
			$aMsgQueue = $this->messageQueue ();  //如果验证失败,发布失败消息,这里默认发送给控制器的消息队列
			return;       //如果验证失败,停止业务处理
		}
		$this->response()->output ( $this->aParams->get ( 'username' ) );
		$this->response()->output ( var_export ( $this->viewRegister->widget ( 'passwordGroup' )->value () ,true) );
		$this->response()->output($this->aParams->get('email')) ;
		$this->response()->output($this->aParams->get('ademail')) ;
		$this->response()->output($this->aParams->get('selectprovince')) ;
		$this->response()->output(var_export($this->aParams->get('selectcity'),true)) ;
	}
}
</code>
</pre>
	<p>加入这段代码以后我们对控件增加校验器才会起作用</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>找到username控件,给它加入非空校验器</p>
		<ul class='purpose'>
			<li>在init函数的顶部找到下面的代码
<pre class='code'>
<code class='php'>
$username = new Text ( 'username', '用户名', '', TEXT::single );
$this->viewRegister->addWidget ( $username );</code>
</pre>
				<p>这段代码实例化了一个Text对象,我们用来接受用户名输入</p>
			</li>
			<li>
<pre class='code'>
<code class='php'>
$username = new Text ( 'username', '用户名', '', TEXT::single );
$username->addVerifier(NotEmpty::singleton() , '用户名不能为空');
$this->viewRegister->addWidget ( $username );</code>
</pre>
			<p>第2行的addVerifier就是给控件添加校验器的方法,它的第1个参数是校验器对象,这里我们使用了单件模式,就是说全系统中这个类只有一个对象.
			对于NotEmpty这样单纯的作用的类来说,这样作再适合不过了.Jecat中单件模式的使用方法是 类名::singleton() </p>
			<p>addVerifier方法的第2个参数是验证失败是的提示信息,校验器都有自己默认的信息,这里是给程序员自己定制这些提示信息的机会,如果你在这里填写了一个消息字符串,那么它会覆盖校验器自带的.</p>
			<p>非空校验器的类名是NotEmpty,用以前不要忘记在页面顶部加上对应的use语句,校验器的命名空间是:jc\verifier\,也就是说use语句应该这么写:</p>
<pre class='code'>
<code class='php'>
use jc\verifier\NotEmpty;</code>
</pre>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>打开你的浏览器,访问user目录下的Register.php.不填写用户名,直接提交表单,你会看到你刚才填写的验证失败提示信息.一条语句就搞定了非空验证,不用你写判断,也不用你操心提示信息的代码.是不是很简单呢? ^_^</p>
	</div>
	
	<blockquote class='prepure'>
		如果你想更细致的修改提示信息的位置和内容,可以参考教程或者手册的"消息队列"相关章节
	</blockquote>
</div>
