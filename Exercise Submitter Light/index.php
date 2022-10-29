
<?php
	$nErr="خطا : نام را وارد نکرده اید";
	$cErr="خطا : کد را وارد نکرده اید";
	$sErr="خطا : شماره دانشجویی را وارد نکرده اید";
	$fullname="";
	$code="H_M_";
	$studentID="";
	if(!isset($_GET['n']))
		$nErr="";
	if(!isset($_GET['c']))
		$cErr="";
	if(!isset($_GET['s']))
		$sErr="";
	
	if(isset($_GET['fullname']))
	{
		$fullname=$_GET['fullname'];
	}
	if(isset($_GET['code']))
	{
		$code=$_GET['code'];
	}
	if(isset($_GET['studentID']))
	{
		$studentID = $_GET['studentID'];
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
		<?php
		require_once("helper.php");
		?>
		<div class="col-md-7">
		<form method="POST" enctype="multipart/form-data" action="submitEx.php">
		
		<div class="col-md-7 col-md-offset-7" >
	 <div class="panel" style="padding:1em;">
	 
	 <div class="form-group">
		<label for="fullname">نام و نام خانوادگی</label>
		<input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>" placeholder="نام و نام خانوادگی خود را وارد کنید" value=""  />
		<p style="text-align:right;" class="text-danger"><?php echo $nErr; ?></p>
	 </div>
	 <div class="form-group">
		<label for="studentID">شماره دانشجویی</label>
		<input type="text" class="form-control" value="<?php echo $studentID; ?>" name="studentID" placeholder="شماره دانشجویی خود را وارد کنید" />
		<p style="text-align:right;" class="text-danger"><?php echo $sErr; ?></p>
	 </div>
	 
	 <div class="form-group">
		<label for="exCode">کد تمرین</label>
		<input type="text" onkeyup="CheckCode(0);" class="form-control" id="exCode" name="code" value="<?php echo $code; ?>" placeholder="کد تمرین که در کلاس به شما داده شده را وارد کنید" />
		<p style="text-align:right;" class="text-danger"><?php echo $cErr; ?></p>
	 </div>
	 <div class="form-group">
		<label for="course">نام درس</label>
		<select class="form-control" name="courseName">
		<option value="Arzyabi Karayi System Haye Computeri">ارزیابی کارایی سیستم های کامپیوتری</option>
		<!-- <option value="Arzyabi Karayi System Haye Computeri">ارزیابی کارایی سیستم های کامپیوتری</option> -->
		</select>
	</div>
	 
	 
	 
	 <div class="form-group">
		<label for="deadline">تاریخ تمرین</label>
		
                <input value="" type="text" id="deadLine" name="deadline" class="form-control" disabled />
            
	 </div>
	 
		<div class="form-group" style="border:1px solid white;padding:2px;border-radius:5px;">
			<label for="exFile">فایل پاسخ تمرین</label>
			<input type="file" name="exFile">
			<p class="help-block" style="direction:rtl;text-align:left;">فرمت های مجاز : عکس های JPG </p>
			<p style="text-align:right;" class="text-danger"></p>
		</div>
		
	 <div style="text-align:center">
		<button type="submit" name="submit" class="btn btn-lg btn-primary"> ارسال پاسخ تمرین </button>
		</div>
		</div>
		
	<div class="form-group">
		<p style="text-align:center;color:lightgreen">طراحی توسط : محمد بشیری نیا و محمد رجبی</p>
	</div>
	 </div>
	 
		</form>
		</div>
		<br />
		<?php
			

		?>
	</body>
</html>