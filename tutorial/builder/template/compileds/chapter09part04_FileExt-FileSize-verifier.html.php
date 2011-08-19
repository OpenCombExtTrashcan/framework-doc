<div>
	<h1><span class="title"></span>文件类型校验器(FileExt),文件大小校验器(FileSize)</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/Verifier_p03.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	<p>下面介绍一下File控件可以使用的几个校验器.</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>咱们再给文件上传添加2个校验器.代码如下</p>
<pre class='code'>
<code class='php'>
if(!$uploadForlder = $this->application ()->fileSystem ()->findFolder ( '/data/widget' )){
	$uploadForlder = $this->application ()->fileSystem ()->createFolder ( '/data/widget');
}
$fileupload = new File ( 'fileupload', '文件上传', $uploadForlder );
$fileupload->addVerifier(FileSize::flyweight(array(200,200000)));
$fileupload->addVerifier(FileExt::flyweight(array(array('jpg','png','bmp'),true)));
$this->viewRegister->addWidget ( $fileupload );</code>
</pre>
	<p>第5行用的是FileSize校验器,这个和前面我们用过的Number校验器很象,前面的数字是文件大小的下限,后面的数字是上限,单位是字节(byte)</p>
	<p>第6行我们使用FileExt校验器,这个校验器很有意思.第一个参数是一个数组,里面是一些文件扩展名,后面是一个bool量,如果是true,前面所写的扩展名都是允许上传的.如果第2个参数是false,
	那么前面的数组里的扩展名就都变成不允许上传的了,很方便吧 ^_^</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>打开你的浏览器,访问user目录下的Register.php.用File控件提交各种文件来检测它的校验器是否象你想象的那样工作</p>
	</div>
	
	<blockquote class='warning'>
		由于文件上传有容易出现重大的安全隐患,所以我们建议你在使用任何文件上传功能的控件时都仔细设置他们的校验器,以保证服务器安全.
	</blockquote>
</div>
