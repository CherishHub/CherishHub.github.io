<?php 
  $servername = "localhost";
  $username = "root";

  $conn = mysqli_connect("localhost","root","","cbvbank");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";
?>