<?php

include "connection.php";

$stmt = $conn->prepare("SELECT * FROM books WHERE genre = 'Children`s literature' LIMIT 4");

$stmt->execute();

$childrens_books = $stmt->get_result();

?>