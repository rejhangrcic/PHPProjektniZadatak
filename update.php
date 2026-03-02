<?php

include "config.php";

function clean($s) {
  return trim($s ?? "");
}

$id = intval($_POST["id"] ?? 0);
$ime = clean($_POST["ime"] ?? "");
$prezime = clean($_POST["prezime"] ?? "");
$email = clean($_POST["email"] ?? "");

if ($id <= 0) {
  http_response_code(400);
  die("Neispravan ID.");
}
if ($ime === "" || $prezime === "" || $email === "") {
  http_response_code(400);
  die("Sva polja su obavezna.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  die("Neispravan email.");
}

$sql = "UPDATE users SET ime=?, prezime=?, email=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $ime, $prezime, $email, $id);

if (!$stmt->execute()) {
  http_response_code(400);
  die("Greška: " . $conn->error);
}

header("Location: index.php");