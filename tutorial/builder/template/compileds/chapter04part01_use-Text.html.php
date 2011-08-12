<div class='page'>
	<h1>构建注册页面前的准备工作</h1>
	<blockquote>
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/MVC_start.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>首先创建一个Text控件对象</p>
			<ul class='todo'>
				<li>进入user文件夹,编辑Register.php文件,找到init函数
					<pre class='code'>
						<code class='php'>
...
class RegisterController extends Controller {
	protected function init() {
	$this->createFormView ( "register", "register.template.html", 'jc\\mvc\\view\\FormView' );
	
}
...
						</code>
					</pre>
					<p>第2行,创建名为RegisterController的控制器,它的父类是Controller,这样保证它拥有一个Controller类型应该有的所有特性</p>
					<p>第3行,这个函数相当于RegisterController的构造函数的一部分,也就是说在"new"这个RegisterController的时候init会跟着运行.我们一般在这里创建控件对象</p>
					<p>第4行,使用控制器的createFormView函数创建一个view,第一个参数是view的名字,控制器拿到名字后会把这个名字的首字母大写,
					前面再加上"view"来把它变成控制器的参数,完成的参数就像这样"viewRegister".在这个控制器后面的代码中你可以用这样的代码来取得这个view</p>
					<pre class='code'>
						<code class='php'>
$this->viewRegister 
						</code>
					</pre>
					<p>第二个参数是view的模板,我们在上一节建立的template文件夹就是这类模板文件存放的位置.第三个参数是创建view的类型,这里用的是一个FormView对象,因为这个view拥有form行为</p>
				</li>
				<li>下面我们创建一个控件对象.把以下代码写入上面代码第5行的位置
					<pre class='code'>
						<code class='php'>
$username = new Text ( 'username', '用户名', '', TEXT::single );
$this->viewRegister->addWidget ( $username ); 
						</code>
					</pre>
					<p>第1行,建立了一个Text控件对象,第1个参数是控件的id,这个id也会体现在最终编译后的html页面上,作为标签的id出现,类似这样&lt;input id='username'/>.
					同时它也是MVC系统识别控件的方式,也就是说如果这里的id参数是"username",那么在这个页面的控制器、视图、模型中这个控件都叫"username",你可以在step2中看到视图模板中是如何使用id来指代控制器中创建的对象的
					第2个参数是这个控件的作用说明,主要用于页面提示,比如页面验证失败,那么用户会得到类似"用户名必须填写"这类错误,这句话中"用户名"就是这个参数的内容.
					第3个参数是控件的初始值.第4个参数是Text控件的类型,Text默认提供single,textarea,password,hidden类型,分别代表单行文本框,多行文本框,密码,隐藏文本框.
					还有一些不常用的参数,你可以通过查阅文档得知</p>
					<p>第2行,把Text对象添加到视图中,相当于把这个控件对象交给指定的view来管理</p>
					<blockquote>
						你可能已经发现了,在Jecat框架中,设计者试图把事物以他们的功能进行归类,这样类的功能更抽象.就像我们把多种具有文本输入功能的html标签归纳为一个Text对象这样的做法在Jecat框架中很普遍,我们的目的是让你在使用Jecat的时候不被那些他们的细节打扰
					</blockquote>
				</li>
			</ul>
	</div>
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p>光是创建控件对象不足以让它显示在页面上,我们还需要修改模板文件来让模板引擎知道应该把这个控件显示在页面的什么位置上.</p>
		<ul>
			<li>打开template文件夹,找到register.template.html文件并打开,文件的内容如下:
				<pre class='code'>
					<code class='html'>
&lt;msgqueue for="$theView" />
&lt;form id="theform" method='post'>

	&lt;input type='submit' value='提交表单'/>
&lt;/form>
					</code>
				</pre>
			</li>
			<li>把widget标签添加到第3行,之后的代码内容如下:
				<pre class='code'>
					<code class='html'>
&lt;msgqueue for="$theView" />
&lt;form id="theform" method='post'>
	<widget id='username' />
	&lt;input type='submit' value='提交表单'/>
&lt;/form>
					</code>
				</pre>
				<p>widget标签是Jecat的模板标签,它代表widget在页面中的位置.其中的id属性是必须填写的,指定这个widget标签代表控制器中哪个控件对象</p>
				<p>最好再添加一个label来让用户知道这个输入框是什么意思</p>
				<pre class='code'>
					<code class='html'>
&lt;msgqueue for="$theView" />
&lt;form id="theform" method='post'>
	&lt;label for="username">用户名:&lt;/label>&lt;widget id='username'/>
	&lt;input type='submit' value='提交表单'/>
&lt;/form>
					</code>
				</pre>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你刚刚构建的页面</li>
			<li>看看Register.php的输出内容,如果你一个名为"提交表单"的按钮,你就可以开始下一节了.如果报错,你很可能看到了Jecat的异常提示,不要灰心,看看Jecat提供的强大异常处理功能是如何帮你解决问题的.仔细读一下错误提示,找到问题并解决它!</li>
		</ul>
	</div>
</div>