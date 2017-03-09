<?php
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
	//查询调查结果，计算百分比然后显示出来
	$totals=array();
	$results=array();
	for($j=0;$j<$rowNum;$j++){

		$sql2="select * from ".$tb_arr[$j];//类似于select count0,count1,count2 from tb12
		$results[$j]=$conn->query($sql2)->fetch_assoc();//取出后放入result，可用$results[i]['count0']来获取item0的值
	
		//计算每个问题对应的投票人数，放入一个数组
		$sum=0;
		for($m=0;$m<$ansCounts[$j];$m++){
			$sum=$sum+$results[$j]['count'.$m];
		}
		array_push($totals, $sum);
	}
}
	
	?>
	
	
<!DOCTYPE html>
<html>
<head>
<?php include("head1.php") ?>
<title> 调查结果显示</title>
</head>
<body>
<?php include("nav.php") ?>
<div class="container" style="background:url(/system/register.jpg);height:768px; width:1366px">
<br /><br /><br /><br /><br /><br />
	<div class="row">	
		<div class="col-md-8 col-md-offset-2" style="color:black;">
		
		<form class="form-signin" >
			<h3 class="form-signin-heading" >问卷报告：</h3>	
		<?php 
		
		for($n=0;$n<$rowNum;$n++){?>
		<br/>		
			<label class="radio-inline">
			 <h4 class="form-signin-heading" >问题<?php $tn=$n+1; echo $tn;?>：</h4>
			</label> 
			<?php for($a=0;$a<$ansCounts[$n];$a++){?>							
			<label class="radio-inline">			 
			 <input type="radio" ><b><?php echo $results[$n]['count'.$a];?></b>人选<?php echo $results[$n]['item'.$a];?>
			</label>	
			<?php
			}
		}
			?>
			

														
		</form>
		</div>
	</div>
</div>

</body>

</html>	
	