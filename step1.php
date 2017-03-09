<!DOCTYPE html>
<html>

<head>
<?php include("head1.php") ?>
<title>设置调查问题</title>
</head>

<body>
<?php include("nav.php") ?>
	<div class="container" style="background:url(/system/purple.jpg)  no-repeat;height:768px; width:1366px; margin: 0; padding: 0;">
			
		<br /><br /><br /><br /><br />
		<div class="row">	
			<div class="col-md-4  col-md-offset-4" >
			<img style="position:absolute;left:0px;top:0px;width:100%;height:100%;z-Index:-1; border:1px solid blue" src="/system/purple.jpg" />
				<form class="form" name="form1" action="step2.php" method="post">
					<h2 class="form-signin-heading" style="text-align: center;">设置调查问题</h2><br />
					<div class="form-group">
						<label >调查编号：</label>
						<input class="form-control" type="text" name="tbno" id="tbno" placeholder="调查编号" value="12"/>
				  	</div>
				  	<div class="form-group">
						<label >问题：</label>
						<input class="form-control" type="text" name="question" id="question" placeholder="问题" value="你最喜欢吃什么水果？"/>
				  	</div>
				  	<div class="form-group">
						<label >问题的选项个数：</label>
						<input class="form-control" type="text" name="ansCount" id="ansCount" placeholder="选项个数" value="2"/>
				  	</div>
					<div class="form-group" style="text-align: center;">
													
						<input class=" btn btn-primary btn_grey" type="button" value="下一步" onclick="checkForm()" />											
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
		function checkForm(){
			if(document.form1.tbno.value==""){
				alert("调查主题不能为空");
				document.form1.tbno.focus();
			}
			else if(document.form1.question.value==""){
				alert("问题不能为空");
				document.form1.question.focus();
			}
			else if(document.form1.ansCount.value==""||document.form1.ansCount.value>6||document.form1.ansCount.value<1){
				alert("问题的选项个数不能为空,而且值域为[1,6]");
				document.form1.ansCount.focus();
			}
			else{
				form1.submit();
			}				
		}
</script>
</html>