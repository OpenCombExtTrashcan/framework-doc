<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>数字校验器(Number),邮箱地址校验器(Email),相等校验器(Same)</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/Verifier_p02.zip'>代码包</a>,这样你只要把这个代码部署到Jecat的framework同级的目录下就可以开始了<br />
	</blockquote>
	<p>下面让我们体验数字校验器和邮箱地址校验器</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>咱们再给注册页面的几个控件添加一些校验器.代码如下</p>
<pre class='code'>
<code class='php'>
\$username = new Text ( 'username', '用户名', '', TEXT::single );
\$username->addVerifier(NotEmpty::singleton() , '用户名不能为空')->add(Length::flyweight(array(4,10)));
\$this->viewRegister->addWidget ( \$username );

\$password1 = new Text ( 'password1', '确认密码1', '', Text::password );
\$this->viewRegister->addWidget ( \$password1 )->dataVerifiers ()->add ( Number::flyweight (array( true ) ) );

\$password2 = new Text ( 'password2', '确认密码2', '', Text::password );
\$this->viewRegister->addWidget ( \$password2 )->dataVerifiers ()->add ( Number::flyweight (array( true ) ) );

\$group = new Group ( 'passwordGroup', '密码核对' );
\$group->addWidget ( \$password1 );
\$group->addWidget ( \$password2 );
\$this->viewRegister->addWidget ( \$group )->dataVerifiers ()->add ( Same::singleton() );

\$email = new Text ( 'email', '邮件' );
\$this->viewRegister->addWidget ( \$email )->dataVerifiers ()->add ( Email::singleton() );</code>
</pre>
	<p>第4行开始我们使用另外一种方式添加校验器,效果与前面的username的添加校验器的方式是一样的,之所以使用了不同的方式只是为了让你能够选择符合你习惯的方式来编程.
	比如我们可以把下面的代码:</p>
	<pre class='code'>
	<code class='php'>
\$password1 = new Text ( 'password1', '确认密码1', '', Text::password );
\$password1->addVerifier(NotEmpty::singleton() , '密码不能为空');
\$this->viewRegister->addWidget ( \$password1 );</code>
	</pre>
	<p>改成下面这样:</p>
	<pre class='code'>
	<code class='php'>
\$this->viewRegister->addWidget ( new Text ( 'password1', '确认密码1', '', Text::password ) )->dataVerifiers ()->add ( NotEmpty::singleton() , '密码不能为空' );</code>
	</pre>
	<p>上面2种方式效果是一样的,选择自己喜欢的就可以了.</p>
	<p>第6行我们使用Number校验器,它限定控件只能输入数值类型,参数是bool型,如果是true就只允许整数型,如果是false就只允许小数</p>
	<p>第14行我们给Group对象添加一个Same校验器,Group把2个password控件组合起来,而Same校验器的功能是正是校验多个控件的值是否一致.Same校验器没有参数,所以使用单件模式.</p>
	<p>最后一行的邮箱地址自然而然的使用了Email校验器.</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>打开你的浏览器,访问user目录下的Register.php.你可以使用各种乱七八糟的输入来折腾这个注册表单,然后让它是怎么用各种理由拒绝你的 ^_^</p>
	</div>
</div>

OUTPUT
) ;
?>
