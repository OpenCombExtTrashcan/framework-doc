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
// 构建“关系图”

// 取得模型关系图的单件实例
$aAssocMap = ModelAssociationMap::singleton() ;

// 分别为每个数据表添加 ORM 配置
$aAssocMap->addOrm(
	array(
		'table' => 'user' ,
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


$aAssocMap->addOrm(
	array(
		'name' => 'epub' ,
		'keys' => 'eid' ,
		'table' => 'epub' ,
		'hasOne' => array(
			array(
				'prop' => 'category' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'epubcategories'
			),
		),
		'hasAndBelongsToMany' => array(
			array(
				'prop' => 'authors' ,
				'fromk' => 'eid' ,
				'tok' => 'eid' ,
				'bfromk' => 'uid' ,
				'btok' => 'uid' ,	
				'bridge' => 'epubauthor' ,
				'model' => 'user',
			) ,
		),
	)
);

$aAssocMap->addOrm(
	array(
		'name' => 'epubcategory' ,
		'keys' => 'cid' ,
		'table' => 'epubcategories' ,
		'belongsTo' => array(
			array(
				'prop' => 'epubs' ,
				'fromk' => 'cid' ,
				'tok' => 'cid' ,
				'model' => 'epub'
			),
		),
	)
);
////////////////////////////////////////////////
// 使用“关系图” 创建模型对象

// 从关系图中取出关系片段
$aFragment = $aAssocMap->fragment('epub',
		array(
			'categories' ,
			'author'=>array(
				'friends'
			) ,
		)
) ;

// 用“片段”创建模型
$aModel = new Model($aFragment) ;

// 查询数据
$aModel->load( 521 ) ;

// 输出模型中的数据
print $aModel->username ;


?>