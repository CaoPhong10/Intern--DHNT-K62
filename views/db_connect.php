<?php 
$conn = mysqli_connect('localhost', 'root', '', 'thuctap')
or die('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'UTF8');
?>