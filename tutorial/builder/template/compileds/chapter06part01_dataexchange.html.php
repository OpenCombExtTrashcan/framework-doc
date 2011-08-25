<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>数据交换</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
	</blockquote>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<ul class='todo'>
			<li>准备工作:首先你要已经部署好Jecat,然后下载<a href='../code/dataexchange.zip'>实例代码</a>,解压到Jecat的framwork目录同级.部署好以后目录结构如下:
	<pre class='code'>
	<code class='plain'>
(根目录)\
	framework\
	de\
		de.php
		inc.common.php
		template\
			de.html
</code>
</pre>
	<p>de目录是我们的程序目录,里面的inc.common.php文件会加载Jecat的主程序,之后我们的程序就在Jecat代码的基础上运行了.de.php文件是本节程序的入口,我们一会就要用浏览器访问它来查看程序运行结果.
	template目录是模板文件目录,de.html就是de.php文件对应的模板</p>
			</li>
			<li>压缩包中还有一个sql文件,把它导入到你名为dataexchange的数据库中</li>
		</ul>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>让我们看看如果使用Jecat的数据交换.</p>
		<ul class='todo'>
			<li>打开de.php文件
<pre class='code'>
	<code class='php'>
&lt;?php
use jc\mvc\view\FormView;
use jc\mvc\view\View;
use jc\mvc\model\db\Model;
use jc\mvc\view\widget\Text;
use jc\mvc\view\widget\Select;
use jc\mvc\view\DataExchanger;
use jc\auth\IdManager;
use jc\db\DB;
use jc\util\DataSrc;

//初始化Jecat
\$aApp = require_once dirname ( __DIR__ ) . '/de/inc.common.php';

//创建一个View对象,用来显示页面内容
\$aView = new FormView( 'de' ,'de.html');

/**************        加载数据模型        **************/

//读取数据
\$aBook = Model::fromFragment('book',array('press' ) );
//这里只是实验,我们直接读取其中一条记录
\$aBook->load(1);
//把数据库模型和视图关联
\$aView->setModel(\$aBook);

//加载图书分类模型
\$aCat = Model::fromFragment('category' ,array(), true);
\$aCat->load();

\$aPress = new Model('presses',true);
\$aPress->load();

/**************        加载视图控件        **************/

//书名控件
\$aBookName = new Text( 'bookName','书名','',Text::single );
\$aView->addWidget(\$aBookName , 'name');

//图书分类控件,已经其中的option
\$arrCatOptions = array(array('请选择分类...', 0 , false));
foreach( \$aCat->childIterator() as \$aSingleCat)
{
	\$arrAOption = array(\$aSingleCat->name,\$aSingleCat->cid,false);
	array_push(\$arrCatOptions, \$arrAOption);
}
\$aBookCat = new Select ( 'bookCat', '分类' );
\$aBookCat->addOptionByArray(\$arrCatOptions);
\$aBookCat->setValue(\$aBook->category);
\$aView->addWidget(\$aBookCat , 'category');

\$arrPressOptions = array(array('请选择分类...', 0 , false));
foreach( \$aPress->childIterator() as \$aSinglePress)
{
	\$arrAOption = array(\$aSinglePress->name,\$aSinglePress->pid,false);
	array_push(\$arrPressOptions, \$arrAOption);
}
\$aBookPress = new Select ( 'bookPress', '出版社' );
\$aBookPress->addOptionByArray(\$arrPressOptions);
\$aBookPress->setValue(\$aBook->press);
\$aView->addWidget(\$aBookPress , 'press');

\$aBookPrice = new Text( 'bookPrice','价格','',Text::single );
\$aView->addWidget(\$aBookPrice , 'price');

/**************        处理页面请求        **************/

//获取post ,get 等方式传来的信息
\$aPar = \$aApp->request();
//判断是否是页面提交请求
if( \$aView->isSubmit( \$aPar ) ){
	\$aView->loadWidgets ( \$aPar );
	
	\$aOutputStream = \$aView->outputStream();
	
	//看看模型中的数据发生了什么变化
	\$aOutputStream->write( '数据交换,模型到控件方向' . '&lt;br />') ;
	\$aOutputStream->write( '&lt;hr />' ) ;
	\$aOutputStream->write( '交换前 :' . '&lt;br />') ;
	\$aOutputStream->write('name列的值为: ' . \$aBook->data('name')  . '&lt;br />') ;
	\$aOutputStream->write('category列的值为: ' . \$aBook->data('category')  . '&lt;br />') ;
	\$aOutputStream->write('press列的值为: ' . \$aBook->data('press')  . '&lt;br />') ;
	\$aOutputStream->write('price列的值为: ' . \$aBook->data('price')  . '&lt;br />') ;
	\$aOutputStream->write('isbn列的值为: ' . \$aBook->data('isbn')  . '&lt;br />') ;
	
	//数据交换,把控件中的数据交给模型
	\$aView->exchangeData ( DataExchanger::WIDGET_TO_MODEL );
	
	\$aOutputStream->write( '交换后 :'  . '&lt;br />') ;
	\$aOutputStream->write('name列的值为: ' . \$aBook->data('name')  . '&lt;br />') ;
	\$aOutputStream->write('category列的值为: ' . \$aBook->data('category')  . '&lt;br />') ;
	\$aOutputStream->write('press列的值为: ' . \$aBook->data('press')  . '&lt;br />') ;
	\$aOutputStream->write('price列的值为: ' . \$aBook->data('price')  . '&lt;br />') ;
	\$aOutputStream->write('isbn列的值为: ' . \$aBook->data('isbn')  . '&lt;br />') ;
	\$aOutputStream->write( '&lt;hr />' ) ;
	//将模型中的数据保存到数据库
	if(\$aBook->save()){
		\$aApp->response()->output('图书信息保存成功') ;
	}else{
		\$aApp->response()->output('图书信息保存失败') ;
	}
	
}else{
	\$aOutputStream = \$aView->outputStream();
	
	\$aOutputStream->write( '数据交换,模型到控件方向' . '&lt;br />') ;
	\$aOutputStream->write( '&lt;hr />' ) ; 
	\$aOutputStream->write( '交换前 :'  . '&lt;br />') ;
	\$aOutputStream->write('name列的值为: ' . \$aBook->data('name')  . '&lt;br />') ;
	\$aOutputStream->write('category列的值为: ' . \$aBook->data('category')  . '&lt;br />') ;
	\$aOutputStream->write('press列的值为: ' . \$aBook->data('press')  . '&lt;br />') ;
	\$aOutputStream->write('price列的值为: ' . \$aBook->data('price')  . '&lt;br />') ;
	\$aOutputStream->write('isbn列的值为: ' . \$aBook->data('isbn')  . '&lt;br />') ;
	
	\$aView->exchangeData ( DataExchanger::MODEL_TO_WIDGET );
	
	\$aOutputStream->write( '交换后 :'  . '&lt;br />') ;
	\$aOutputStream->write('name列的值为: ' . \$aBook->data('name')  . '&lt;br />') ;
	\$aOutputStream->write('category列的值为: ' . \$aBook->data('category')  . '&lt;br />') ;
	\$aOutputStream->write('press列的值为: ' . \$aBook->data('press')  . '&lt;br />') ;
	\$aOutputStream->write('price列的值为: ' . \$aBook->data('price')  . '&lt;br />') ;
	\$aOutputStream->write('isbn列的值为: ' . \$aBook->data('isbn')  . '&lt;br />') ;
	\$aOutputStream->write( '&lt;hr />' ) ;
}

\$aView->show();
?></code>
</pre>
		<p>18行开始是加载数据模型,我们的数据库中有一个book表,里面记录了几本书的数据,本节的页面就是要编辑其中的数据.</p>
		<p>34行开始为页面布置几个控件,用来构建编辑表单</p>
		<p>66行开始是我们本节的重点,我们在这里处理页面请求,本页的代码处理2种请求,一个是显示数据库数据的请求,一个是用户提交了编辑后保存数据的请求.
		71行的isSubmit函数判断请求是不是页面提交请求,如果是就进入保存数据的处理,如果不是就只是显示页面.</p>
		<p>87行和115行都是在使用视图的exchangeData方法,这个方法就是我们数据交换的主角.数据交换有2个方向,一个是控件到数据模型,另外一个是数据模型到控件,顾名思义,前者是把控件的数据更新到数据模型中
		后者是把数据模型中的数据更新到页面的控件中,这个函数的参数就是在告诉函数应该进行哪个方向的处理.</p>
		<p>无论是什么请求,我们都实例化一个OutputStream对象用来输出数据模型中的内容,可以看到后面用了多次\$aOutputStream的write函数来输出一些讯息,他们是帮助你了解数据交换前后都发生了什么.</p>
			</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>确保你没有忘记把压缩包中的sql文件导入到数据库,然后用浏览器访问de.php页面,你会看到一段提示数据信息和一个表单,修改表单中的数据并提交,然后看看提示信息的变化.
		在回头看看exchangeData方法调用的位置,那么Jecat中数据交换的流程就一目了然了.</p>
	</div>
</div>

OUTPUT
) ;
?>
