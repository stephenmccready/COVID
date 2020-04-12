<?php
$connect = mysqli_connect("your host", "your database name", "your passowrd", "your user name");
if(mysqli_connect_errno()){echo '<p>Connection to MySQL server [your host] failed: '.mysqli_connect_error().'</p>';}
