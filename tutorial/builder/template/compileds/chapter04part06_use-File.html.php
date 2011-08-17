<div class='page'>
	<h1><span class="title"></span>使用File类</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/MVC_p05.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>下面是File类的php代码</p>
		<ul class='todo'>
			<li>在init函数的末尾处添加下面的代码
				<pre class='code'>
				<code class='php'>
$uploadForlder = $this->application ()->fileSystem ()->findFolder ( '/data/widget' );
$fileupload = new File ( 'fileupload', '文件上传', $uploadForlder );
$this->viewRegister->addWidget ( $fileupload );</code>
				</pre>
				<p>第1行代码找到user目录下的一个名为widget的文件夹对象,它的路径是: user/data/widget ,这个文件夹就是我们要用来存储文件用的文件夹.
				当然,你可以自己建立自己的文件夹,建立好文件夹以后改一下第1行代码末尾的findFolder函数的参数就可以了.</p>
				<p>第2行把建立好的forder对象作为第3个参数传递给FIle类的构造函数这样File控件对象就知道应该把文件放在哪里了</p>
				<blockquote class="prepare">
					如果你想更准确的定位存储文件的路径,你可以查阅Jecat文档文件系统相关章节
				</blockquote>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>去模板添加对应的标签</p>
		<ul class='todo'>
			<li>在模板文件Register.html的form标签的底部添加下面的代码
				<pre class='code'>
					<code class='html'>
&lt;label for='fileupdate'>上传照片&lt;/label>&lt;widget id="fileupload"/>&lt;br /></code>
				</pre>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>现在后台只是知道存放文件的物理路径,却不知道如何产生一个url地址来让用户的浏览器显示图片或者给出下载地址</p>
		<ul class='todo'>
			<li>编辑user文件夹下的inc.common.php文件,让它看起来像是这样
				<pre class='code'>
					<code class='php'>
// UI
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;

// 文件访问路径
$aApp->fileSystem()->findFolder('/')->setHttpUrl(
	dirname($aApp->request()->url())
) ;

// 会话
$aSession = new OriginalSession() ;
$aSession->start() ;
Session::setSingleton($aSession) ;</code>
				</pre>
				<p>第4行到8行就是你要加入的代码,它的作用是帮助后台了解计算文件url的方法.如果你不是很清楚它是什么作用,尽管添加上就可以了.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s4'>step 4.</h3>
	<div class='step'>
		<p class='purpose'>检验你的代码</p>
		<ul class='todo'>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你的页面</li>
			<li>在username等控件中填入一些内容,在文件上传控件中放入一个文件,点击"提交表单"的按钮,如果上传控件下方出现了一个文件链接,点击它,如果你上传的是图片,那么你应该可以看到那张图片了,如果是其他文件,那么你应该会得到一个下载提示对话框</li>
		</ul>
	</div>
</div>