<?php  
	include_once 'assets/php/header.php';
    include_once 'filesLogic.php'
?>
<?php

$db = new PDO("mysql:host=localhost;dbname=user_system", "root", "");

?>
<?php

if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $stmt = $db -> prepare("select * from 'upload' where id=?");
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $data = $stmt -> fetch();
    
    $file = 'dpo'.$data['name'];

    if(file_exists($file)){
        header('Content-Disposition: name="'.basename($file).'"');
        header('Content-Type:'.$data['mime']);
        header ('Content-Length:'.filesize($file));
        readfile($file);
        exit;
        
    }
      
}
?>


<table class ="table">
<thead>

<tr>
<th>ID</th>
<th>File Name</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php



?>

<tr>
 <td> <?php echo $collum['id']?></td>
 <td> <?php echo $collum['name']?></td>
 <td><a href="download.php?id=<?php echo $collum['id']?>" class="btn btn-danger">Download</a></td>
</tr>

<?php

?>

</tbody>

</table>
