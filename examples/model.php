<?php
/*****************************************************************************
这个PHP文件演示了如何以JeCat推荐的做法，创建一个数据库模型(db model)：
首先为整个系统构建一套完整的数据表原型关系图，关系图中描述了所有的数据表，以及所有的表间关系
然后从关系图中取出一小段“片段”，使用“片段”来创建一个模型对象
这样就不用在需要使用数据库的时候，重复配置数据表信息了。
*****************************************************************************/
namespace jc\doc\examples ;

use jc\mvc\model\db\Model;
use jc\mvc\model\db\orm\ModelAssociationMap;


// 载入公共文件
$aApp = require __DIR__.'/common.php' ;


////////////////////////////////////////////////
// Example 1: 构建“关系图”

// 取得模型关系图的单件实例
$aAssocMap = ModelAssociationMap::singleton() ;

// 分别为每个数据表添加 ORM 配置
// -------------------------------
//   用户模型， users表
$aAssocMap->addOrm(
	array(
		'name' => 'user' ,
		'table' => 'users' ,
	
		'hasOne' => array(
			array(
				'prop' => 'info' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => 'userinfo'
			),
		) ,
		
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'friends' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'bfromk' => 'uid' ,
				'btok' => 'fuid' ,	
				'bridge' => 'userfriends' ,
				'model' => 'user',
			) ,
			array(
				'prop' => 'equbs' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'btok' => 'eid' ,	
				'bfromk' => 'eid' ,
				'bridge' => 'epubauthor' ,
				'model' => 'equb',
			),
		),
	)
) ;


//   用户信息模型， userinfo表
$aAssocMap->addOrm(
	array(
		'name' => 'userinfo' ,
		'keys' => 'uid' ,
		'table' => 'userinfo' ,
		'belongsTo' => array(
			array(
				'prop' => 'user' ,
				'fromk' => 'uid' ,
				'tok' => 'uid' ,
				'model' => 'user'
			),
		),
	)
);


//   电子书模型， epub表
$aAssocMap->addOrm(
	array(
		'name' => 'epub' ,
		'keys' => 'eid' ,
		'table' => 'epub' ,
		'belongsTo' => array(
			array(
				'prop' => 'category' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'category'
			),
		),
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'authors' ,
			
				'fromk' => 'eid' ,
				'btok' => 'eid' ,	
			
				'bfromk' => 'uid' ,
				'tok' => 'uid' ,
			
				'bridge' => 'epubauthor' ,
			
				'model' => 'user',
			) ,
		),
	)
);

//   电子书分类模型， epubcategories表
$aAssocMap->addOrm(
	array(
		'name' => 'category' ,
		'keys' => 'cid' ,
		'table' => 'epubcategories' ,
		'belongsTo' => array(
			array(
				'prop' => 'epub' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'epub'
			),
		),
	)
);



////////////////////////////////////////////////
// Example 2: 使用“关系图” 创建模型对象

// 从关系图中取出关系片段
$aAssocMap = ModelAssociationMap::singleton() ;
$aFragment = $aAssocMap->fragment('epub',
		array(
			'category' ,
			'authors'=>array(
				'friends'
			) ,
		)
) ;


//////////////////////////////////////////////////////////////////
// Example 3: 新建模型

$aEBook = new Model($aFragment) ;		// 用“片段”创建模型

$aEBook['epub_name'] ;
$aEBook->data('epub_name') ;
$aEBook->epub_name ;

$aEBook->epub_name = '架构之美' ;
$aEBook->epub_content = '本书围绕5个主题领域来组织本书的内容：概述、企业应用、系统、最终用户应用和编程语言。本书让最优秀的设计师和架构师来描述他们选择的软件架构，剥开架构的各层，展示他们如何让软件做到实现功能、可靠、易用、高效率、可维护、可移植和优雅。' ;
$aEBook->update_time = date('Y-m-d G:i:s') ;

//$aEBook->child('category')->setData('category_name','软件工程') ;
$aEBook['category.category_name'] = '软件工程' ;
$aEBook['category.update_time'] = date('Y-m-d G:i:s') ;

$aAuthor1 = $aEBook->child('authors')->createChild() ;
$aAuthor1->user_loginId = 'Till Adam' ;
$aAuthor1->user_register_time = time() ;
$aAuthor1->update_time = date('Y-m-d G:i:s') ;

$aUser = $aAuthor1->child('friends')->createChild() ;
$aUser->user_loginId = 'Alee' ;
$aUser->user_register_time = time() ;
$aUser->update_time = date('Y-m-d G:i:s') ;

if( !$aEBook->save() )
{
	echo "无法保存模型." ;
	exit() ;
}

//////////////////////////////////////////////////////////////////
// Example 4: 加载模型

$aEBook = new Model($aFragment) ;		// 用“片段”创建模型

if( !$aEBook->load('架构之美','epub_name') )
{
	echo "无法加载数据。" ;
	exit() ;
}

//////////////////////////////////////////////////////////////////
// Example 5: 修改/保存模型
$aEBook->setData('epub_name','架构之美(中译版)') ;

$aEBook["category.update_time"] = date('Y-m-d G:i:s') ;

$aAuthor = $aEBook->child('authors')->child(0) ;
$aAuthor->user_passwd = '111111' ;

if( !$aEBook->save() )
{
	echo "无法保存模型" ;
	exit() ;
}



//////////////////////////////////////////////////////////////////
// Example 6: 删除模型

if( !$aEBook->delete() )
{
	echo "无法删除模型" ;
	exit() ;
}


?>