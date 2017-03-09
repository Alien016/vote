<?php 
//准备数据阶段
//接收管理员设置的问题信息，然后存入表名，生成表；最后返回调查问题设置成功。
$tbno=$_POST['tbno'];  //调查编号：
$question=$_POST['question'];//问题:
$ansCount=$_POST['ansCount'];//选项个数：
$tbName="tb".$tbno;//表名：


$arr=array();//存放选项内容的数组[苹果，香蕉，梨子，...]
for ($i=1;$i<=$ansCount;$i++){
	$item="item".$i;
	$itemval=$_POST[$item];
	array_push($arr, $itemval);
}

$arr_col=array();//存放列名，也就是选项的名字[item0,count0,item1,count1,...]
for ($i=0;$i<$ansCount;$i++){
	$item="item".$i;
	array_push($arr_col, $item);
}

?>
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
	echo 'success<br/>';

	
	//生成建表的sql语句
	$col="";
	for($i=0;$i<$ansCount;$i++){
		if($i!=$ansCount-1){
			$col.=$arr_col[$i]." varchar(20),count".$i." int(11),";
		}
		else{
			$col.=$arr_col[$i]." varchar(20),count".$i." int(11)";
		}
	}
	$sql="create table ".$tbName."( question varchar(255),".$col." )";
	$conn->query($sql);
		
	
	//初始化表格，插入一条记录
	$temp="";
	for($i=0;$i<$ansCount;$i++){
		if($i!=$ansCount-1){
			$temp.="'".$arr[$i]."',0,";
		}
		else{
			$temp.="'".$arr[$i]."',0";
		}
	}
	$sql_insert="insert into ".$tbName." values('".$question."',".$temp.")";	
	$conn->query($sql_insert);
	
	//将表名、表的问题、选项个数记录下来
	$sql_tbs="insert into tbs(tbName,question,ansCount) values('".$tbName."','".$question."','".$ansCount."')";
	$conn->query($sql_tbs);
			
}
?>
<!DOCTYPE html>
<html>

<head>
<?php include("head1.php") ?>
<title>调查设置的结果</title>
</head>
<body>
<?php include("nav.php") ?>
<div class="container" style="background:url(/system/register.jpg);height:768px; width:1366px">
<br /><br /><br /><br /><br /><br />
	<div class="row">	
		<div class="col-md-4 col-md-offset-4" style="color:black;">
		
		<form class="form-signin"  method="post">
			<h3 class="form-signin-heading" >设置成功！您刚刚设置的调查问题如下所示：</h3><br />	
			<h4 class="form-signin-heading" ><?php echo $question;?></h4>	
			<?php for($i=0;$i<$ansCount;$i++){?>							
			<label class="radio-inline">
			  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"><?php echo $arr[$i];?>
			</label>
			<?php }?>																	
		</form>
		</div>
		
	</div>
</div>

</body>

</html>