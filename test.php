<?php
include "config.php";

if ($conn) {
    echo "Konekcija radi!";
} else {
    echo "Konekcija ne radi.";
}
?>