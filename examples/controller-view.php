<?php
/*****************************************************************************
这个PHP文件演示了如何使用控制器(controller)和视图(view)。
例子实现了以下操作
1、定义了一个控制器类 MyController，为这个控制器类创建、添加了一个表单类型的视图(form view) MyController::$myView，然后为视图添加了一些视图窗体(widget)。
2、创建并执行 MyController 对象
3、MyController 对象在执行时显示视图；如果用户正在提交表单，为视图的窗体加载用户提交来的数据，并且校验这些数据。

*****************************************************************************/
namespace jc\doc\examples ;

use jc\mvc\controller\Controller;
use jc\message\Message;
use jc\verifier\Email;
use jc\verifier\Length;
use jc\mvc\view\widget\Text;
use jc\mvc\view\View;

class MyController extends Controller
{
	protected function init()
	{
		// 为控制器创建一个视图（一个控制器类可以拥有多个视图）
		$this->createView('myView','MyView.template.html',"jc\\mvc\\view\\FormView") ;
		
		// 为视图创建、添加窗体，并为窗体添加校验器
		$this->myView->addWidget( new Text("username","用户名") )					// 普通文本窗体
					->dataVerifiers()
						->add( Length::flyweight(6,40) ) 						// 添加校验器:长度限制在 6-40 的范围内
						->add( Email::singleton(), "用户名必须是email格式" ) ;		// 添加校验器:必须是 email 格式，并设置一段提示消息，替代框架默认的提示消息
						
		$this->myView->addWidget( new Text("password","密码",Text::PASSWORD) )	// 密码文本窗体
					->dataVerifiers()
						->add( Length::flyweight(6,40) ) ; 						// 添加校验器:长度限制在 6-40 的范围内
		
	}
	
	public function process()
	{
		// 用户正在提交 MyController::$myView 视图
		// MyController::$aParams 属性是执行控制器时 提供给控制器的参数。如果是由用户请求网页产生的控制器，这个属性包含了用户提交的 http Get/Post 数据
		if( $this->myView->isSubmit( $this->aParams ) )		 
		{
			
			// 加载 视图窗体的数据
			$this->myView->loadWidgets( $this->aParams ) ;
			
			// 校验 视图窗体的数据
			if( $this->myView->verifyData() )
			{
				// 生成一条消息发送到 视图 的消息队列
				// 控制器、视图，和视图窗体 都拥有自己的消息队列，它们都可以在视图的 UI模板 中分别显示出来
				$this->myView->messageQueue()->add(
					new Message( Message::success, "用户名密码输入正确，这只是一个例子，没有做什么实质性的事情 ... ..." )
				) ;
			}
			
		}
		
		
		// 渲染 MyController::$myView 视图
		$this->myView->render() ;
		
	}
}


// 创建一个 MyController 对象
$aController = new MyController() ;

// 执行 MyController对象， 从当前 Application 对象取得用户的http请求数据，作为 控制器执行参数 传递给 MyController对象
$aController->mainRun( $aApp->request() ) ;

?>