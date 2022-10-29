<?php
	require_once("SP.php");
	require_once("jDate.php");
	require_once("db/Connect.php");
	$uploadFail="";
	$uploadSucc="";
	if(!isset($_POST['submit']))
	{
		header("Location: index.php");
		exit;
	}
	
	$uAddress="";
	$name=$_POST['fullname'];
	$studentID=$_POST['studentID'];
	$code=$_POST['code'];
	
	$para="?err=1";
	$c=0;
	if($name == "")
	{
		$para .= "&n=1";
		$c=1;
	}
	else
	{
		$para .= "&fullname=".$name;
	}
	if($studentID == "")
	{
		$para .= "&s=1";
		$c=1;
	}
	else
	{
		$para .= "&studentID=".$studentID;
	}
	if($code == "H_M_")
	{
		$para .= "&c=1";
		$c=1;
	}
	else
	{
		$para .= "&code=".$code;
	}
	if($c==1)
	{
		header("Location: index.php".$para);
		exit;
		
	}
	$cName = $_POST['courseName'];
	
	 if(CheckValid() ==1){
		
		
		$r=UploadEx($cName,$code,$studentID,$name);
		if($r==1)
		{
			$uploadSucc="تمرین با موفقیت ثبت شد.شما باید عکس تمرین را در زیر مشاهده کنید در غیر اینصورت مجددا تمرین را ثبت فرمایید";
			$uploadSucc.="<br /><br /><center><img src='$uAddress' style='border:1px solid black;' width=500 height=500 /></center>";
			
		}
		else
		{
			$uploadSucc="مشکلی در آپلود فایل وجود داشته است";
		}
	 }
	 else
	 {
		 $uploadSucc="متاسفانه زمان ارسال این تمرین به پایان رسیده است";
	 }
?>


<?php

	function CheckValid() //1 if valid 0 if not
	{
		$c=$_POST['code'];
		$ret=-1;
		$cs=explode("_",$c);
		if(count($cs)>=5)
		{
			$date = new jDateTime(true, true, 'Asia/Tehran');
			$y=GetYear($c);
			$m=GetMonth($c);
			$d=GetDay($c);
			
			$currentDate= $date->date("Y-m-d", false, false);
			$cd = GetDay2($currentDate);
			$cm = GetMonth2($currentDate);
			$cy = GetYear2($currentDate);

			$goal = $date->mktime(23,59,59,$m,$d,$y,true);
			$goal = $goal + (3600*24*7);
			$current=$date->mktime(0,0,0,$cm,$cd,$cy,true);
			
			if($goal-$current > 0)
				$ret=1;
			else
				$ret=0;
		}
		else
		{
			$ret=0;
		}
		
		return $ret;
		
	}	
	function CreateDir($courseName,$code,$studentID,$name)
	{
		$main = "files/upload";
		$cName=$main."/".$courseName;
		if(!file_exists($cName))
			mkdir($cName);
		$std=$cName."/".$studentID;
		if(!file_exists($std))
			mkdir($std);
		$cd=$std."/".$code;
		if(!file_exists($cd))
			mkdir($cd);
		
	}
	function UploadEx($cName,$code,$studentID,$name)
	{
		$uploaded=0;
		$allowedExt=array("jpg","jpeg");
		$target_dir = "files/upload/".$cName."/".$studentID."/".$code."/";
		$uploadOk = 0;
		$target_file = $target_dir . basename($_FILES["exFile"]["name"]);
		$FileExt = pathinfo($target_file,PATHINFO_EXTENSION);
		for($i=0;$i<count($allowedExt);$i++)
		{
			if(strtolower($FileExt) == $allowedExt[$i])
				$uploadOk = 1;
		}
		$ret="";
		if($uploadOk == 1)
		{
			CreateDir($cName,$code,$studentID,$name);
			$fName=basename($_FILES["exFile"]["name"]);
			$fName = $fName.rand(0,1000000).rand(0,200000);
			$fName = md5($fName).".".$FileExt;
			$fullDir=$target_dir.$fName;
			move_uploaded_file($_FILES["exFile"]["tmp_name"],$fullDir);
			$ret=$fName;
			$uploaded=1;
			$GLOBALS['uAddress']=$fullDir;
			$c=Connect();
			$name=mysqli_real_escape_string($c,$name);
			$code=mysqli_real_escape_string($c,$code);
			$studentID=mysqli_real_escape_string($c,$studentID);
			$cName=mysqli_real_escape_string($c,$cName);
			mysqli_query($c,"INSERT INTO `tblSent`(`StudentID`,`StudentName`,`CourseName`,`Code`) VALUES('$studentID','$name','$cName','$code');");
			Disconnect($c);
		}
		
		return $uploaded;
	}
?>
<html>
	<head>
	<meta charset="UTF-8">
	<link href="content\bootstrap.min.css" rel="stylesheet" />
	<link href="content\bootstrap-theme.min.css" rel="stylesheet" />
	<link href="content\main.css" rel="stylesheet" />
	<script src="script\main.js" type="text/javascript"></script>
	<title>صفحه اصلی</title>
	<?php
		require_once("header.php");
	?>
	</head>
	<body>
		<h2 style="text-align:center;" class="text-warning"><?php echo $uploadSucc; ?></h1>
	</body>
	
	
	</html>