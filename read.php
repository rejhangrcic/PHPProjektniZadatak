<?php

include "config.php";

$sql = "SELECT id, ime, prezime, email, created_at FROM users ORDER BY id DESC";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
  $users[] = $row;
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($users);