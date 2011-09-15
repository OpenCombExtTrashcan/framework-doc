<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>在控制器中创建视图(view)和模型(model)</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 确定你正确部署了本章教程第一节"准备工作"中的代码.<br />
	</blockquote>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<ul class='todo'>
			<li>在数据库中新建controler数据库,将下面的内容导入数据库
			<pre class='code'>
			<code class='sql'>

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `authors` (
  `uid` int(10) NOT NULL,
  `bid` int(8) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`bid`),
  UNIQUE KEY `bid` (`bid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `books` (
  `bid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `category` int(6) NOT NULL,
  `press` int(10) NOT NULL,
  `price` float NOT NULL,
  `isbn` varchar(40) NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `books` (`bid`, `name`, `category`, `press`, `price`, `isbn`) VALUES
(1, 'Beautiful A', 1, 1, 169, '978-111-21126-6'),
(2, 'Design Patterns: Elements of Reusable Object-Oriented Software', 1, 1, 69, '978-111-28350');

CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `categories` (`cid`, `name`) VALUES
(1, 'Soft Engine'),
(2, 'Search Engine'),
(3, 'Database');

CREATE TABLE IF NOT EXISTS `presses` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `home` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `presses` (`pid`, `name`, `home`, `email`, `country`) VALUES
(1, 'Apress', 'English', 'XXX@email.com', 'English'),
(2, 'O''REILLY', '', '', '');

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  `group` int(4) NOT NULL,
  `lastLoginTime` int(10) DEFAULT NULL,
  `createTime` int(10) DEFAULT NULL,
  `updateTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
			</code>
			</pre>
			</li>
			<li>然后在inc.common.php中return语句以前添加下面的代码.用来建立刚刚我们导入的那些表的ORM关系.
	<pre class='code'>
	<code class='php'>
//链接数据库
DB::singleton()->setDriver( new PDODriver("mysql:host=localhost;dbname=controller",'root','123456') ) ;

//数据库关系
\$aPam = PrototypeAssociationMap::singleton() ;

// 定义 categories 数据表原型
\$aPam->addOrm(
	array(
		'name' => 'category' ,			// 数据表原型名称
		'table' => 'categories' ,		// 数据表名称
		
		// 定义这个数据表所拥有的 hasMany 关联
		'hasMany' => array(
			array(
				'prop' => 'books' ,		// book 对象在 category 对象内的属性名称
				'fromk' => 'cid',
				'tok' => 'category' ,	// 关键另一端的字段
				
				// 被关联的数据表原型
				'prototype' => 'book' ,	// books 表的原型名称
			) ,
		) ,
	)
) ;

// 定义 books 数据表原型
\$aPam->addOrm(
	array(
		'name' => 'book' ,				// 数据表原型名称
		'table' => 'books' ,			// 数据表名称
	
		// 定义这个数据表所拥有的 hasMany 关联
		'belongsTo' => array(
			array(
				'prop' => 'press' ,
				'fromk' => 'press' ,	// 外键的字段名
				'tok' => 'pid' ,	// 关键另一端的字段
				// 被关联的表
				'prototype' => 'press' ,// 为 presses 表定义的原型名称
			) ,
		) ,
		
		// 定义这个数据表所拥有的 hasMany 关联
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'authors' ,
				'fromk' => 'bid' ,
				'bridge' => 'authors' ,		// “桥接表”
				'btok' => 'bid' ,				// 桥接表上的外键（可省略）
				'bfromk' => 'uid' ,			// 桥接表上的连接另一端的外键（可省略）
				'tok' => 'uid' ,
				// 被关联的表
				'prototype' => 'user' ,
			),
		) ,
	)
) ;

// 定义 presses 数据表原型
\$aPam->addOrm(
	array(
		'name' => 'press' ,			// 数据表原型名称
		'table' => 'presses' ,		// 数据表名称
	)
) ;

// 定义 categories 数据表原型
\$aPam->addOrm(
	array(
		'name' => 'user' ,			// 数据表原型名称
		'table' => 'users' ,		// 数据表名称
	)
) ;</code>
</pre>
	<p>注意第2行的数据库链接信息要改成自己的.</p>
	<p>在页面顶部的namespace后面添加2个use语句</p>
	<pre class='code'>
	<code class='php'>
use jc\db\DB;
use jc\db\driver\PDODriver;</code>
</pre>
	<p>这样我们就有了数据库内容和数据库表关关系的描述(ORM),在下面我们构建网页的时候要用这些来构建模型.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>下面我们给一个控制器添加数据模型</p>
		<ul class='todo'>
			<li>打开ControllerA.php,把init函数修改成下面这个样子.
			<pre class='code'>
	<code class='php'>
protected function init() {
	//让controller实例化一个带有表单的视图 , 名字是viewA, 使用的模板是viewA.html
	\$this->createView( "A" , "viewA.html" );
	
	//让controller通过book数据表原型创建数据模型
	\$this->createModel( 'book' , array() , true);
	\$this->viewA->setModel(\$this->modelBook);
	
	//无条件的读取所有book模型中的数据
	\$this->modelBook->load();
	
	//把数据模型中的数据整理成数组
	\$arrBooks = array();
	foreach (\$this->modelBook->childIterator() as \$key => \$aBook){
		\$arrBooks[] = \$aBook;
	}
	
	//把整理好的数组发送给模板用于遍历
	\$this->viewA->variables()->set('arrBooks',\$arrBooks) ;
}</code>
</pre>
	<p>第3行的createView函数创建了一个视图,视图的名字是"A",你在实际工作中应该给它起一个更有描述性的名字.
	controller会自动给它前面加上一个"view"来标记他们,我们之后调用它的时候就使用"viewA"这个名字.</p>
	<p>第6行的createModel函数创建了一个模型,我们把模型的名字设置为"book",controller也会自动给它改名,原来的名字首字母大写,前面再加上一个"model" , 完整的名字就是"modelBook"了,
	函数的第2个参数是关联哪些数据原型,我们只需要book一个原型,所以我们传进一个空的数组,第3个参数为true的意思是我们需要的是一个组合模型,
	就是一个模型里面包含好多子模型,每个子模型就是一条数据.</p>
			</li>
			<li>打开viewA.html,把这个模板的内容用下面的代码替换.
				<pre class='code'>
	<code class='html'>
&lt;div>
	&lt;ul>
		&lt;foreach for='\$arrBooks' item='book'>
			&lt;li>&#123=\$book['name']}&lt;/li>
		&lt;/foreach>
	&lt;/ul>
&lt;/div></code>
</pre>
	<p>第3行的foreach语句把ControllerA.php发送来的数组遍历.循环中就为所欲为了.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>用浏览器打开: http://你的域名/controller/?c=cA ,来检验刚刚添加的代码.
		控制器的任务就是组织所有的资源,这是MVC最重要的部分,你应该熟练掌握,建议你用ControllerB.php来写一个自己的控制器,创建自己的视图和模型,
		然后把视图的内容用自己的方式遍历到页面上.</p>
	</div>
	<blockquote class='prepare'>
		如果你需要在视图中使用表单,那么创建表单的时候要使用createFormView(),而不是createView()
	</blockquote>
</div>
OUTPUT
) ;
?>
