<!DOCTYPE html>
<html>

<head>
<?php  include("head1.php") ?>
<?php 
// $theme=$_POST['theme'];
// $question=$_POST['question'];
// $ansCount=$_POST['ansCount'];
// echo $theme,'<br/>',$question,$ansCount;
// if($ansCount){
// 	echo "";
// }
?>
<title>设置调查问题</title>
</head>

<body>
<?php include("nav.php") ?>
	<div class="container" style="background:url(/system/purple.jpg)  no-repeat;height:768px; width:1366px; margin: 0; padding: 0;">
<br /><br /><br /><br /><br />
		<div class="row">	
			<div class="col-md-4  col-md-offset-4">
				<form class="form" name="form2" action="step3.php" method="post">					
					<h2 class="form-signin-heading" style="text-align: center;">设置调查问题</h2><br />					
<?php 
$tbno=$_POST['tbno'];
$question=$_POST['question'];
$ansCount=$_POST['ansCount'];
// echo $tbno,'<br/>',$question,$ansCount;
?>
				<?php 
				   for ($item=1;$item<=$ansCount;$item++){?>
						<div class="form-group">
							<label >第<?php echo $item?>个选项:</label>
							<input class="form-control" type="text" name="item<?php echo $item?>" />
						</div>
					<?php }?>  

					<input type="hidden" name="tbno" id="tbno" value="<?php echo $tbno?>"/>
					<input type="hidden" name="question" id="question" value="<?php echo $question?>"/>
					<input type="hidden" name="ansCount" id="ansCount" value="<?php echo $ansCount?>"/>
					<div class="form-group" style="text-align: center;">	
						<input class=" btn btn-primary btn_grey" type="reset" value="清除"  />					
						<input class=" btn btn-primary btn_grey" type="submit" value="完成"  />						
					</div>																			 				  	
				 </form>
			</div>
		</div>
	</div>
</body>


</html>


