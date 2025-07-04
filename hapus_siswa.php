<?php

$nis = $_GET['nis'];

$sql = "DELETE FROM siswa WHERE nis='$nis'";
if ($conn->query($sql) === TRUE) {
  header("Location:?page=siswa");
}
$conn->close();
