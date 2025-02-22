<?php

include "connection.php";

$stmt = $conn->prepare("SELECT * FROM books LIMIT 4");

$stmt->execute();

$featured_books = $stmt->get_result();

?>