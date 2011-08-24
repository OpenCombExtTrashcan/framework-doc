<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>定义关系图创建数据库模型</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/model_p02.zip'>代码包</a>,
		这样你只要把这个代码部署到Jecat的framework同级的目录下然后使用其中的sql文件倒数数据库就可以开始了<br />
	</blockquote>
	<p>上一节的代码从软件工程的质量标准来看，有一处很不理想的瑕疵：每次创建Model对象时，都需要临时定义一个ORM配置，可是涉及到相同的数据表时，那些ORM信息就会被反复定义。这违背了“Dont repeat your self”原则。</p>
	<p>JeCat框架推荐一种更理想的方式来维护ORM配置：将所有的数据表及其关联都集中定义在一个地方，这些定义就形成了一张表与表之间的关系图。创建Model对象时，就只需要从完整的“关系图”中截取一个所需的“片段”即可。
	</p>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p>我们需要向项目引入 PrototypeAssociationMap 类，这个类负责统一维护一个完整的数据表关系网。在 MyProject/model_example.php 把代码替换成下面这些代码：</p>
			<pre class='code'>
			<code class='php'>
&lt;?php
use jc\db\DB;
use jc\mvc\model\db\Model ;
use jc\system\Application;
use jc\mvc\model\db\orm\PrototypeAssociationMap ;

require 'inc.common.php' ;

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
) ;



// 使用 book原型，及其 authors 和 press 关联
\$aBook = Model::fromFragment('book',array('authors','press')) ;

// 使用 category原型，及其 books关联，并且递归使用book中的 authors 和 press 关联
\$aCategory = Model::fromFragment('category',array( 'books' => array('authors','press') ) ) ;
?></code>
</pre>
		<p>向PrototypeAssociationMap 类的单件实例中一次性添加整个系统所需要的数据表原型定义，然后就可以通过83行和86行演示的方式，从中取出片段，并根据这些关系片段来创建Model对象。</p>
		<p>读者应该自己在这段实例代码后面增加一些曾删改查的语句来测试代码的准确性,同时进一步了解Jecat的ORM系统的使用方法.</p>
	</div>
	<blockquote class="prepare">
		向PrototypeAssociationMap 对象 add orm配置时，关联的 'prototype' 元素不再需要提供另一个数据表原型的完整定义，只要提供数据表原型的名称即可。
	</blockquote>
</div>

OUTPUT
) ;
?>
