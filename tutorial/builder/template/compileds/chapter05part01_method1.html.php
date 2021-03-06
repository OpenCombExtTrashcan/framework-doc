<?php

$aDevice->write(<<<OUTPUT
<div>
	<h1><span class="title"></span>使用表名创建数据库模型</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你没有本章之前的代码,可以直接下载<a href='../code/model_p01.zip'>代码包</a>,
		这样你只要把这个代码部署到Jecat的framework同级的目录下然后使用其中的sql文件倒数数据库就可以开始了<br />
	</blockquote>
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>首先我要新建一个图书分类。</p>
		<p>在 MyProject/model_example.php 末尾加入以下代码：</p>
				<pre class='code'>
			<code class='php'>
// 为 categories 表创建一个Modol 对象，参数是数据表的表名
\$aCategory = new Model('categories') ;

// 设置分类的名称
\$aCategory->setData('name','Soft Engine') ;

// 保存到数据库
if( \$aCategory->save() )
{
	Application::singleton()->response()->output("图书分类保存成功！") ;
}
else
{
	Application::singleton()->response()->output("图书分类保存失败！") ;
}</code>
				</pre>
			<p>第5行...</p>
				<pre class='code'>
			<code class='php'>
\$aCategory->setData('name','Soft Engine') ;</code></pre>
			<p>可以换成更简洁的书写方法：</p>
			<pre class='code'>
			<code class='php'>
\$aCategory->name = 'Soft Engine' ;</code></pre>
			<p>或者：</p>
			<pre class='code'>
			<code class='php'>
\$aCategory['name'] = 'Soft Engine' ;</code></pre>
			<p>name 是数据表  categories 中的一个字段，用这3种方式访问 name 字段 ，作用是完全相同的。</p>
	</div>
	
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p class='purpose'>接下来，在这个图书分类中新建一本图书。继续在 MyProject/model_example.php 中加入以下代码： </p>
		<pre class='code'>
				<code class='php'>
// 为 categories 表创建一个Modol 对象，参数是数据表的表名
\$aBook = new Model('books') ;

// 设置分类的名称
\$aBook->setData('category',\$aCategory->data('cid')) ;
\$aBook->setData('name','Beautiful Architecture') ;
\$aBook->setData('isbn','978-111-21126-6') ;
\$aBook->setData('price',69.00) ;

// 保存到数据库
if( \$aBook->save() )
{
	Application::singleton()->response()->output("图书保存成功！") ;
}
else
{
	Application::singleton()->response()->output("图书保存失败！") ;
}</code>
</pre>
		<p>新建图书的操作和新建图书分类的操作差不多，图书的 category 字段是一个指向  categories 表的 cid 字段的外键。 我将 \$aCategory 对象的 cid 字段值直接传递给了 \$aBook 对象的 category 字段。实际上，我根本没有为\$aCategory对象的cid字段设定过任何值，这么做没有问题吗？
没有问题，cid在数据表中是一个自增型字段，在 \$aCategory->save() 后，系统自动为 \$aCategory 设置了正确的 cid 字段值。</p>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p class='purpose'>在刚才的代码后面加上：</p>
	<pre class='code'>
	<code class='php'>
//获得刚刚添加的图书类型的ID
\$nCId = \$aCategory->cid ;

// 删除前面创建的 \$aCategory 和 \$aBook
unset(\$aCategory) ;
unset(\$aBook) ;

\$aCategory = new Model('categories') ;
\$aBook = new Model('books') ;

// 查找主键 cid 为\$nCId的 categories表中的记录
if( !\$aCategory->load(\$nCId) )
{
	Application::singleton()->response()->output("无法找到指定的图书分类") ;
}

// 查找 name 字段 为"Beautiful Architecture"的 books表中的记录
if( !\$aBook->load('Beautiful Architecture','name') )
{
	Application::singleton()->response()->output("无法找到指定的图书") ;
}

Application::singleton()->response()->output("category name: {\$aCategory->name}") ;
Application::singleton()->response()->output("book name: {\$aBook->name}") ;</code>
</pre>
	<p>Model::load() 方法负责从数据加载数据到Model对象。第一个参数是字段的值，第二个参数是字段名称，如果省略字段名称，则使用数据表的主键做为字段名称。可以同时提供多组字段值对：传入两个数组做为参数，分别包括了字段值 和对应的字段名称，它们之间是"AND"关系。
如果在数据表中找到符合字段值对条件的记录，则从记录中读取各个字段的数据，加载到Model对象内，并放回true; 否则什么也不做，返回flase。</p>
	</div>
	
	<h3 id='s4'>step 4.</h3>
	<div class='step'>
		<p class='purpose'>在接下来，我想要修改图书的书名和isbn，价格不需要修改（我不是故意的，这两本书刚好价格相同），这很简单，再刚才的代码后面，加上这一段：</p>
			<pre class='code'>
					<code class='php'>
//修改书的信息
\$aBook->name = "Design Patterns: Elements of Reusable Object-Oriented Software" ;
\$aBook->setData('isbn','978-111-28350') ;

// 将改动保存到数据库
if( \$aBook->save() )
{
	Application::singleton()->response()->output("图书信息修改成功！") ;
}
else
{
	Application::singleton()->response()->output("图书信息修改失败！") ;
}</code>
</pre>
	<p>需要注意的是，新建一项数据和修改后保存数据，都是通过 Model::save() 操作来完成的。Model类能够聪明地知道何时需要 insert 操作，何时需要 update 操作。</p>
	</div>
	
	
	<h3 id='s5'>step 5.</h3>
	<div class='step'>
		<p class='purpose'>删除一项数据之前，必须先通过 Model::load() 方法找到这项记录，并加载到Model对象中，然后调用 Model::delete() 方法，删除数据表中的数据。在刚才的代码中再加入下面这些代码：</p>
		
			<pre class='code'>
					<code class='php'>
// 从数据表中删除图书分类
if( \$aCategory->delete() )
{
	Application::singleton()->response()->output("图书分类删除成功！") ;
}
else
{
	Application::singleton()->response()->output("图书分类删除失败！") ;
}

// 从数据表中删除图书
if( \$aBook->delete() )
{	
	Application::singleton()->response()->output("图书信息删除成功！") ;
}
else
{
	Application::singleton()->response()->output("图书信息删除失败！") ;
}</code>
</pre>
	<blockquote class="prepare">
		Model::delete() 仅仅删除数据表中的数据，加载到Model对象中的数据并没有被清理，因此，在Model::delete() 之后，立刻 Model::save() 就会数据又原原本本地存回数据库。
	</blockquote>
	</div>
	<p>现在，数据库被清空了，我们创建了一个图书类别，和一本属于这个类别的图书，然后进行了若干操作，最后删除了这两项记录。一切又回到了起点。</p>
</div>

OUTPUT
) ;
?>
