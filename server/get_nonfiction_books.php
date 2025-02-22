<?php

include "connection.php";

$stmt = $conn->prepare("SELECT * FROM books WHERE genre = 'Nonfiction' LIMIT 4");

$stmt->execute();

$nonfiction_books = $stmt->get_result();

?>