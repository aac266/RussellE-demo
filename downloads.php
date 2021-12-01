<?php  
	include_once 'assets/php/header.php';
    include_once 'filesLogic.php'
    //include 'filesLogic.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title>Download files</title>
</head>
<body>

<table>
<thead>
    <th>ID</th>
    <th>Filename</th>
    <th>size (in mb)</th>
    <th>Downloads</th>
    <th>Action</th>
</thead>
<tbody>
  <?php foreach ($files as $file): ?>
    <tr>
      <td><?php echo $file['id']; ?></td>
      <td><?php echo $file['name']; ?></td>
      <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
      <td><?php echo $file['downloads']; ?></td>
      <td><a href="downloads.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
    </tr>
  <?php endforeach;?>

</tbody>
</table>

</body>
</html>
<style>
form{

width:30%;

margin:100px;

padding:30px;

border:1px solid #555;

}

input{

width:100%;

border:1px solid #f1e1e1;

display:block;

padding:5px 10px;

align-content: center;

}

button{

border:none;

padding:10px;

border-radius:10px;

}
table {
  width: 60%;
  border-collapse: collapse;
  margin: 100px auto;
  align-content:center;
}
th,
td {
  height: 50px;
  vertical-align: center;
  border: 1px solid black;
}
</style>