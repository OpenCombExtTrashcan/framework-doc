<div>
	<h1><span class="title"></span>字符长度校验器(Length)</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/Verifier_p01.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	<p>下面让我们体验更多的校验器</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>咱们再给username控件加一个长度限制校验器,长度校验器类的名字是Length,别忘记在本页代码的顶部加上相应的use语句</p>
<pre class='code'>
<code class='php'>
$username = new Text ( 'username', '用户名', '', TEXT::single );
$username->addVerifier(NotEmpty::singleton() , '用户名不能为空')->add(Length::flyweight(array(4,10)));
$this->viewRegister->addWidget ( $username );</code>
</pre>
	<p>第2行是在以前的代码基础上又追加了一个长度校验器,在语句的后面你可以加入更多的add方法追加更多的校验器</p>
	<p>Length的参数比较特殊,它需要一个整数区间来表示限制的范围,我们用一个数组来表示这个区间,把这个数组作为第一个参数传递给Length的flyweight方法...
	等等,为什么不是我们在NotEmpty类上用的singleton方法呢?NotEmpty很简单,它不需要参数,所以可以用单件模式,而Length就不同,它是有参数的,不能用同一个对象来解决每种参数不同的情况,
	所以我们这里用享元模式,比如说,你在系统中用了3次Length对象,其中2次参数是一致的,那么这2次用的是同一个对象,而第3次用的是另外一个对象.这样即做到了节省内存,又做到了同一个类能够应付不同情况.
	所以,没有参数的NotEmpty我们就使用单件模式,而有参数的Length我们就使用它的享元模式,其他的校验器也都是这个原则.
	</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>打开你的浏览器,访问user目录下的Register.php.不填写用户名,或者填写字符过多的用户名或者字符过少的用户名再提交表单,
		你会看到不同校验器提供的不同提示信息.很神奇吧,想想如果是你自己来处理这些验证条件会是怎么样的情形,Jecat的校验器不止节省了你的编写代码的时间,还节省了你大量的测试和纠错时间.</p>
	</div>
	
</div>
