<?php  
	include_once 'assets/php/header.php';
    include_once 'filesLogic.php';
?>
<body>
<style>
form{

width:auto;

margin:100px;

padding:30px;

border:1px solid #555;

}

input{

width:auto;

border:1px solid #f1e1e1;

display:block;

padding:15px 15px;

align-content: center;

}

button{

border:none;

padding:10px;

border-radius:10px;

}
table {
  width: auto;
  border-collapse: collapse;
  margin: 100px auto;
  align-content:center;
}
th,
td {
    padding:50%;
    width:auto;
  height: 50px;
  vertical-align: center;
  border: 1px solid black;
}
</style>

<h1>Upload Class Documents Below</h1>
<h3>Click Button to Download Documents<h2> <button>          
  <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'downloads.php') ? 'active' : ''; ?>" href="<?= $base_url ?>/downloads.php"><i class="fas fa-file-word"></i>&nbsp;Download&nbsp;</a>
</button>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
 
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title">
    <label>File Upload</label>
    <input type="File" name="file">
    <input type="submit" name="submit">
 
 
</form>
 
</body>
</html>
 
<?php 
$localhost = "localhost"; #localhost
$dbusername = "root"; #username of phpmyadmin
$dbpassword = "";  #password of phpmyadmin
$dbname = "user_system";  #database name
 
#connection string
$conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);
 
if (isset($_POST["submit"]))
 {
     #retrieve file title
        $title = $_POST["title"];
     
    #file name with a random number so that similar dont get replaced
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
 
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
   
     #upload directory path
$uploads_dir = 'upload';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
 
    #sql query to insert into database
    $sql = "INSERT into upload (`id`, `name`, `size`, `download`, `action`) VALUES (NULL, '', '', '', '')
    ";
 
    if(mysqli_query($conn,$sql)){
 
    echo "File Sucessfully uploaded";
    }
    else{
        echo "Error";
    }
}
 
 
?>