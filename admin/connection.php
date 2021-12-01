<?php
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'user_system');

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);