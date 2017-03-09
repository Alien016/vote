<?php
//从数据库取出表，然后表对应的问题显示出来
//提交表单到另一个页面，修改表对应的值，显示投票比例
//连接数据库
$servername = "localhost";
$username = "root";
$password = "582413929";
$mysql_database = 'vote';
$conn = new mysqli(
		$servername, /* The host to connect to 连接MySQL地址 */
		$username,   /* The user to connect as 连接MySQL用户名 */
		$password, /* The password to use 连接MySQL密码 */
		$mysql_database);
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
}
else{
	$sql_select_tbName="select distinct tbName,question,ansCount from tbs";
	$result=$conn->query($sql_select_tbName);
	$rowNum=mysqli_num_rows($result);//获取表的个数
	echo $rowNum;
	$tb_arr=array();//存放表名的数组	
	$questions=array();//存放问题的数组
	$ansCounts=array();//存放每个问题对应的选项个数的数组
	while($row = $result->fetch_assoc()){//循环取结果集的每行数据
		array_push($tb_arr,$row['tbName']);	
		array_push($questions,$row['question'])	;
		array_push($ansCounts, $row['ansCount']);
	}
	
	
	//生成取表名对应的表的内容的sql语句
	$sqls=array();//sql语句集合
	$tb_contents=array();//每条sql语句对应的结果集
	for($i=0;$i<$rowNum;$i++){
		$sql="select * from ".$tb_arr[$i];
		$tb_contents[$i]=$conn->query($sql)->fetch_assoc();
		array_push($sqls, $sql);
	}	
}
?>



<!DOCTYPE html>
<html>

<head>
<?php include("head1.php") ?>
<title>调查页面</title>
</head>
<body>
<?php include("nav.php") ?>
<div class="container" style="background:url(/system/register.jpg);height:768px; width:1366px">
<br /><br />
	<div class="row">	
		<div class="col-md-4 col-md-offset-4" style="color:black;">
		
		<form class="form-signin" action="result.php" method="post">
			<h3 class="form-signin-heading" >欢迎您参与以下问题的调查！</h3><br />
			<?php for($k=0;$k<$rowNum;$k++){?>	
			<h4 class="form-signin-heading" ><?php $tk=$k+1; echo "问题".$tk.":".$questions[$k];?></h4>	
			<?php 
			$ansCount=$ansCounts[$k];
			for($i=0;$i<$ansCount;$i++){
            ?>							
			<label class="radio-inline">
			  <input type="radio" name="<?php echo "question".$tk;?>" id="<?php echo "question".$tk;?>" value="<?php echo "count".$i;?>"><?php echo $tb_contents[$k]['item'.$i];?>
			</label>
			<?php }}?>	
			
			<?php 
			//给结果页面传送必要的数据
// 			session_start();
			$_SESSION['rowNum']=$rowNum;
			$_SESSION['tb_arr']=$tb_arr;
			$_SESSION['ansCounts']=$ansCounts;

			?>
			
			<div class="form-group" style="text-align: center;">	
			<br/>										
				<input class=" btn btn-primary btn_grey" type="submit" value="提交"  />						
			</div>	
																			
		</form>
		</div>
		
	</div>
</div>

</body>

</html>