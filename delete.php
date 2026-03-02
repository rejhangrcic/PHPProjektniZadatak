<?php

include "config.php";

$id = intval($_GET["id"] ?? 0);
if ($id <= 0) {
  http_response_code(400);
  die("Neispravan ID.");
}

$sql = "DELETE FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
  http_response_code(400);
  die("Greška: " . $conn->error);
}

header("Location: index.php");