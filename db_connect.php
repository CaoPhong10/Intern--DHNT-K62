<?php 
$conn = mysqli_connect('localhost', 'root', '', 'thuctap2')
or die('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'UTF8');
?>