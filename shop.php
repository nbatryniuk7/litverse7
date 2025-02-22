<?php include "layouts/header.php"; ?>


<?php
include "server/connection.php"; // Підключення до бази даних

// Отримуємо текст пошуку
$search = isset($_GET['search']) ? $_GET['search'] : ''; 

// Пагінація
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
$total_records_per_page = 8;
$offset = ($page_no - 1) * $total_records_per_page;

// Запит для підрахунку загальної кількості книг
$sql_count = "SELECT COUNT(*) AS total_records FROM books WHERE book_title LIKE ? OR author LIKE ? OR genre LIKE ?";
$stmt_count = $conn->prepare($sql_count);
$search_param = "%$search%";
$stmt_count->bind_param("sss", $search_param, $search_param, $search_param);
$stmt_count->execute();
$result_count = $stmt_count->get_result();
$row_count = $result_count->fetch_assoc();
$total_records = $row_count['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// Основний запит для отримання книг з фільтрацією та пагінацією
$sql = "SELECT * FROM books WHERE book_title LIKE ? OR author LIKE ? OR genre LIKE ? LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $search_param, $search_param, $search_param, $offset, $total_records_per_page);
$stmt->execute();
$books = $stmt->get_result();
?>




<!-- Виведення книг -->
<section id="featured" class="my-5 py-5">
    <div class="container mt-5 py-5">
        <h3>Shop</h3>
        <hr>
        <p>Here you can check out our featured books</p>
    </div>

    <div class="row mx-auto container">
        <?php while ($row = $books->fetch_assoc()) { ?>
            <div onclick="window.location.href='<?php echo "single_product.php?book_id=" . $row['book_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['book_image']; ?>"/>
                <h5 class="p-name"><?php echo $row['book_title']; ?></h5>
                <h4 class="p-price">₴ <?php echo $row['book_price']; ?></h4>
                <a href="<?php echo "single_product.php?book_id=" . $row['book_id']; ?>"><button class="buy-btn">Buy Now</button></a>
            </div>
        <?php } ?>

        <!-- Пагінація -->
        <nav aria-label="Page navigation example" class="mx-auto">
            <ul class="pagination mt-5 mx-auto">
                <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if ($page_no <= 1) { echo '#'; } else { echo "?page_no=" . ($page_no - 1); } ?>">Previous</a>
                </li>

                <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                <?php if ($page_no >= 3) { ?>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
                <?php } ?>

                <li class="page-item <?php if ($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) { echo '#'; } else { echo "?page_no=" . ($page_no + 1); } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<?php include "layouts/footer.php"; ?>





