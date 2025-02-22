<?php

session_start();

include'server/connection.php';

if(isset($_GET['book_id'])){

  $book_id = $_GET['book_id'];

  $stmt = $conn->prepare("SELECT * FROM books WHERE book_id = ?");
  $stmt->bind_param("i", $book_id);

  $stmt->execute();

  $book = $stmt->get_result();


  // no product id was given
}  else {
  header('location: index.php');
  }

?>


<?php include"layouts/header.php"; ?>


    <!--Single product-->  
    <section class = "container single-product my-5 pt-5">
        <div class = "row mt-5">

          <?php while($row = $book->fetch_assoc()){ ?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-30 pb-4" src="assets/imgs/<?php echo $row['book_image'];?>" id="mainImg"/>
              
              <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['book_image'];?>" class="small-img"/>
                </div>

                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['book_image2'];?>" class="small-img"/>
                </div>

                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['book_image3'];?>" class="small-img"/>
                </div>

                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['book_image4'];?>" class="small-img"/>
                </div>
              </div>
            
            </div>

      
            <div class="col-lg-6 col-md-12 col-12">
                <h6><?php echo $row['genre']?></h6>
                <h3 class = "py-4"><?php echo $row['book_title'];?></h3>
                <h2>₴<?php echo $row['book_price'];?></h2>

            <form method="POST" action="cart.php">
            <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>"/>
            <input type="hidden" name="book_image" value="<?php echo $row['book_image']; ?>"/>
            <input type="hidden" name="book_title" value="<?php echo $row['book_title']; ?>"/>
            <input type="hidden" name="book_price" value="<?php echo $row['book_price']; ?>"/>
            <input type="number" name="book_quantity" value="1"/>
            <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
          </form>


                <h4 class = "mt-5 mb-5"><?php echo $row['author'];?></h4>
                <span><?php echo $row['book_description'];?></span>
            </div>
            
            <?php } ?>
        </div>
    </section>


      <!--Related products-->
      <section id = "related-products" class = "my-5 pb-5">
        <div class = "container text-center mt-5 py-5">
          <h3>Related products</h3>
          <hr class = "mx-auto">
        </div>
        <div class = "row mx-auto container-fluid">

        <?php include 'server/get_featured_books.php'; ?>
        <?php while($row=$featured_books->fetch_assoc()){ ?>
          <div class = "product text-center col-lg-3 col-md-4 col-sm-12">
          <img class = "img-fluid mb-3" src = "assets/imgs/<?php echo $row['book_image']; ?>" />
          <h5 class = "p-name"><?php echo $row['book_title']; ?></h5>
          <h4 class = "p-price">₴ <?php echo $row['book_price']; ?></h4>
          <a href= "<?php echo "single_product.php?book_id=". $row['book_id'];?>" ><button class = "buy-btn">Buy Now</button></a>
        </div>
        <?php } ?>

      </div>
      </section>




  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for(let i = 0; i < 4; i++){
        smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src;
        }
      }

  </script>

  <?php include"layouts/footer.php"; ?>