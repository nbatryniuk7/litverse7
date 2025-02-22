<?php

session_start();

if (isset($_POST ['add_to_cart'])){

  // if user has already added a book to cart
  if(isset($_SESSION['cart'])){

    $book_array_ids = array_column($_SESSION['cart'],"book_id");
    // if book has already been added to cart or not
    if(!in_array($_POST['book_id'], $book_array_ids)){

      $book_id = $_POST['book_id'];
      
      $book_array = array(
        'book_id' => $_POST['book_id'],
        'book_title' => $_POST['book_title'],
        'book_price' => $_POST['book_price'],
        'book_image' => $_POST['book_image'],
        'book_quantity' => $_POST['book_quantity']
      );
  
      $_SESSION['cart'][$book_id] = $book_array;
    
    
    // book has already been added  
    }else{

      echo '<script>alert("Book was already to cart");</script>';
  } 
  
    // if this is the first book
    }else{
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $book_price = $_POST['book_price'];
    $book_image = $_POST['book_image'];
    $book_quantity = $_POST['book_quantity'];

    $book_array = array(
      'book_id' => $book_id,
      'book_title' => $book_title,
      'book_price' => $book_price,
      'book_image' => $book_image,
      'book_quantity' => $book_quantity
    );

    $_SESSION['cart'][$book_id] = $book_array;

  }

  // calculate total
calculateTotalCart();


  // remove book from cart
}elseif(isset($_POST['remove_book'])){
  
  $book_id = $_POST['book_id'];
  unset($_SESSION['cart'][$book_id]) ;

  // calculate total
  calculateTotalCart();


}elseif(isset($_POST['edit_quantity'])){

    // we get id and quantity from the form
  $book_id = $_POST['book_id'];
  $book_quantity = $_POST['book_quantity'];

    // get the book array from the session
  $book_array = $_SESSION['cart'][$book_id];

    // update book quantity
  $book_array['book_quantity'] = $book_quantity;

    // return array back its place
  $_SESSION['cart'][$book_id] = $book_array;

    // calculate total
    calculateTotalCart();

}else{
  //header('location: index.php');
}

function calculateTotalCart(){

  $total = 0;

  foreach($_SESSION['cart'] as $key => $value){
    $book = $_SESSION['cart'][$key];
    $price = $book['book_price'];
    $quantity = $book['book_quantity'];
    $total += $price * $quantity;
  }

  $_SESSION['total'] = $total;

}

?>

<?php include"layouts/header.php"; ?> 

    <!--Cart-->
    <section class = "cart container my-5 py-5">
        <div class = "container mt-5">
            <h2 class = "font-weight-bolde">Your Cart</h2>
            <hr>
        </div>

        <table class = "mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php if(isset($_SESSION['cart'])) { ?>


            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class = "product-info">
                        <img src="assets/imgs/<?php echo $value['book_image']; ?>" />
                        <div>
                            <p><?php echo $value['book_title']; ?></p>
                            <small><span>₴</span><?php echo $value['book_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="book_id" value="<?php echo $value['book_id']; ?>"/>
                                <input type="submit" name="remove_book" class = "remove-btn" value="Remove"/>

                            </form>

                        </div>
                    </div>
                </td>

                <td>
                    <form method="POST" action="cart.php">
                    <input type="hidden" name="book_id" value="<?php echo $value['book_id']; ?>"/>
                    <input type="number" name="book_quantity" value="<?php echo $value['book_quantity']; ?>"/>
                    <input type="submit" class = "edit-btn" value="Edit" name="edit_quantity"/>
                    </form>
                </td>

                <td><span class = "product-price">₴ <?php echo $value['book_quantity'] * $value['book_price']; ?></span></td>
            </tr>

            <?php } ?>

            <?php } ?>

            </table>



            <div class = "cart-total">
                <table>
                    <tr>
                        <td>Total</td>
                        <?php if(isset($_SESSION['total'])) { ?>
                          <td>₴ <?php echo $_SESSION['total']; ?></td>
                          <?php } ?>
                    </tr>
                </table>
            </div>


            <div class = "checkout-container">
                <form method="POST" action="checkout.php">
                <input type="submit" class = "btn checkout-btn" value="Checkout" name="checkout">
                </form>
            </div>


     
    </section>

    <?php include"layouts/footer.php"; ?>