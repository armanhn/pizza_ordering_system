<?php
$conn = mysqli_connect("localhost", "root", "", "pizza_ordering_system");

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
