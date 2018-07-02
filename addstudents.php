

<!DOCTYPE html>
<html>
<head>
	
	<title>Add csv files</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width,initial-scale=1.0">
	  <meta charset="utf-8">
	  <link href="css/style.css" rel="stylesheet">
	  <link href="css/style1.css" rel="stylesheet">
	  <link href="css/style2.css" rel="stylesheet">
		<script src="js/respond.js"></script>
	    <script src="neww.js"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <link href="css/style.css" rel='stylesheet' type='text/css' />
	    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body background="#21A957" style="margin-top: 100px; background-color: #f4511e;">
	<div class="container">
	<div class="container" style="">
	<form class="well form-horizontal" action="#" method="POST" enctype="multipart/form-data">
	<fieldset style="margin-top: 100px;">
	<div class="form-group">
	  <label class="col-md-4 control-label">Upload CSV</label>  
	    <div class="col-md-4 inputGroupContainer">
	    	<div class="input-group">
		        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
			  <input name="file" class="form-control" type="file">
	    	</div>
	    </div>
	</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4" align="center">
    <button type="submit"  background-color="#21A957" name="upload" class="btn btn-warning" style="background-color: #21A957;">Upload <span class="glyphicon glyphicon-send"></span></button>
  </div>
</div>
</fieldset>
<?php
	session_start();
	include database.php;

 if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
//echo $file;
    $fileName = $_FILES['file']['name']; 
//echo $fileName;   
    $fileType = $_FILES['file']['type'];
//echo $fileType;    
    $fileTmpName = $_FILES['file']['tmp_name'];
//echo $fileTmpName;     
  $fileExt = explode('.', $fileName);
//echo $fileExt;    
  $fileTmpexp = explode('.', $fileTmpName);
//echo $fileTmpexp;  
    $fileActualExt = strtolower(end($fileExt));
//echo $fileActualExt;   
    $fileTemp = strtolower($fileTmpexp[0]);
  // echo $fileTemp;  
    $fileTmpexp = explode('\\', $fileTemp);
    $fileTemp = end($fileTmpexp);
    $fileTemp1 = $fileTemp;
    $fileNameNew = $fileTmpName.".".$fileActualExt;
    $fileTemp = $fileTemp.'.'.$fileActualExt;

 $allowed = array('csv');
    if (in_array($fileActualExt,$allowed)) {
//echo 1;
$fileDestination = 'csv/'.$fileTemp;
//echo $fileDestination;
//echo $fileTemp;
           if(move_uploaded_file($fileTmpName,$fileDestination)){
		echo "done";}
	else{
		echo "not ";
		}
//echo 2;
//echo $fileDestination;
 $sql1 = "LOAD DATA LOCAL INFILE '".$fileDestination."' INTO TABLE `list` COLUMNS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES;";
echo 4;
$result1 = $conn->query($sql1);
echo 3;
            //echo '<script language="javascript">';
            echo "File Uploaded Successfully.";
           // echo '</script>';
           
    }
else{
      //echo '<script language="javascript">';
      echo "This file type is not allowed.";
      //echo '</script>';
 
    }

}
?>
</form>
</div>

</div>
</body>
</html>
