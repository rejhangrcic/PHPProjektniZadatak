<?php

include "config.php";

function clean($s) {
  return trim($s ?? "");
}

$ime = clean($_POST["ime"] ?? "");
$prezime = clean($_POST["prezime"] ?? "");
$email = clean($_POST["email"] ?? "");

if ($ime === "" || $prezime === "" || $email === "") {
  http_response_code(400);
  die("Sva polja su obavezna.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  die("Neispravan email.");
}

$sql = "INSERT INTO users (ime, prezime, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $ime, $prezime, $email);

if (!$stmt->execute()) {
  http_response_code(400);
  die("Greška: " . $conn->error);
}

header("Location: index.php");