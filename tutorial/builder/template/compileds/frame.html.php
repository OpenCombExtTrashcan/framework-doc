<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>

<body>

<div class="wrapper">

<div class="index">
<ol>
<li><a href="chapter01_hello-world.html">&quot;hello world&quot;（创建JeCat项目）</a></li>
<li><a href="chapter02_file-operation.html"> 文件操作</a></li>
<li><a href="chapter02_use-ui-engine.html"> 使用HTML模板</a></li>
<li> MVC模式：使用模型（model）</li>
<li> MVC模式：使用视图（view）</li>
<li><a href='chapter04.html'>MVC模式：控件类</a> 
	<ul>
		<li><a href='chapter04part00_pre.html'>准备工作</a></li>
		<li><a href='chapter04part01_use-Text.html'>使用Text类</a></li>
		<li><a href='chapter04part02_process.html'>获取表单提交数据</a></li>
		<li><a href='chapter04part03_use-Group.html'>使用Group类</a></li>
		<li><a href='chapter04part04_use-CheckBtn.html'>使用CheckBtn类</a></li>
		<li><a href='chapter04part05_use-Select.html'>使用Select和SelectList类</a></li>
		<li><a href='chapter04part06_use-RadioGroup.html'>使用RadioGroup类</a></li>
		<li><a href='chapter04part07_use-File.html'>使用File类</a></li>
	</ul>
</li>
<li> MVC模式：数据交换</li>
<li> MVC模式：使用控制器（controller）</li>
<li> MVC模式：控制器和视图的组合/重用</li>
<li> 数据校验</li>
<li> 消息队列</li>
</ol> 
</div>

<div class="bodyText">
<?php 
$__include_aVariables = $aVariables ; 
$this->display(eval("if(!isset(\$__uivar_sBodyFile)){ \$__uivar_sBodyFile=&\$aVariables->getRef('sBodyFile') ;};
return \$__uivar_sBodyFile;"),$__include_aVariables,$aDevice) ; ?>
</div>

</div>
<script src='scripts/jquery-1.6.2.min.js' type='text/javascript'></script>
<script src='scripts/jquery.beautyOfCode-min.js' type='text/javascript'></script>
<script type="text/javascript">
$(function(){
	$.beautyOfCode.init({
		brushes: ['Xml', 'JScript', 'CSharp', 'Plain', 'Php'],
		baseUrl: 'http://'+location.hostname+'/doc/tutorial/html/',
		ready: function() {
			$.beautyOfCode.beautifyAll();
		}
	});
});
</script>
</body>
</html>