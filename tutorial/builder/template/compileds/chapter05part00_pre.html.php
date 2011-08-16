<div>
	<h1>准备工作</h1>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>在mySQL中创建一个数据库 jc-example ，然后往 jc-example库 导入下列SQL。</p>
		<pre class='code'>
			<code class='sql'>
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `jc-example`
--
-- --------------------------------------------------------
--
-- 表的结构 `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `uid` int(10) NOT NULL,
  `bid` int(8) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`bid`),
  UNIQUE KEY `bid` (`bid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- 表的结构 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bid` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `category` int(6) NOT NULL,
  `price` float NOT NULL,
  `isbn` varchar(40) NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------
--
-- 表的结构 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `presses`
--
CREATE TABLE IF NOT EXISTS `presses` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `home` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  `group` int(4) NOT NULL,
  `lastLoginTime` int(10) DEFAULT NULL,
  `createTime` int(10) DEFAULT NULL,
  `updateTime` int(10) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;</code>
				</pre>
				<p>现在你的 jc-example 数据库里一共有5个数据表：
books 存放图书数据
users 存放用户数据
authors 这是一个中间表，连接 books 表和 users表：一个作者可能有多本著作，一本书也可以有多个作者。
categories 图书的分类表
friendships 用户和用户之间的好友关系表</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>在 MyProject/inc.common.php 文件中加入代码：</p>
		<pre class='code'>
				<code class='php'>
use jc\db\DB;
use jc\db\driver\PDODriver;

// 连接到数据库
DB::singleton()->setDriver( new PDODriver("mysql:host=&lt;your database server>;dbname=&lt;your database name>",'&lt;your db user>','&lt;you db password>',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")) ) ;
</code>
</pre>
		<p>记得代码中的 &lt;you database ...> 改成你真实运行环境中的配置 :)</p>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>新建文件 MyProject/model_example.php ,在文件中输入代码：</p>
			<pre class='code'>
					<code class='php'>
&lt;?php
use jc\mvc\model\db\Model ;

require 'inc.common.php' ;
<? ob_flush(); echo '?','>' ; ?></code>
</pre>
	</div>
	<p>
	完成这3个步骤以后，准备工作就已经结束了。接下来的教程中我会用 JeCat 的模型来完成以下的数据库操作
	</p>
	
</div>