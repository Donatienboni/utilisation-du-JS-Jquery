<?php

$conn = new mysqli('localhost', 'root', '', 'agencemmi3');

if ($conn) {
    echo "";
} else {
    die(mysqli_error($conn));
}

?>