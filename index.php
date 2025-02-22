<?php include"layouts/header.php"; ?>


      <!--Home-->
          <section id = "home">
            <div class = "container">
                <!--<h5>Literature Universe</h5>-->
                <h1>LITVERSE —</h1>
                <p>a place where stories come to life, and every book opens a new horizon...</p>
                <a href="shop.php"><button>Shop Now</button></a>
            </div>

          </section>

      <!--Fiction-->
      <section id = "featured" class = "my-5 pb-5">
        <div class = "container text-center mt-5 py-5">
              <h3>Fiction</h3>
              <hr class = "mx-auto">
              <p>Lose yourself in the pages of our finest fiction, from modern masterpieces to beloved classics...</p>
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


      <!--Nonfiction-->
      <section id = "featured" class = "my-5 pb-5">
        <div class = "container text-center mt-5 py-5">
              <h3>Nonfiction</h3>
              <hr class = "mx-auto">
              <p>Real stories, real insights—explore the books that change the way we see the world</p>
        </div>
            
        <div class = "row mx-auto container-fluid">

        <?php include 'server/get_nonfiction_books.php'; ?>
        <?php while($row=$nonfiction_books->fetch_assoc()){ ?>
          <div class = "product text-center col-lg-3 col-md-4 col-sm-12">
            <img class = "img-fluid mb-3" src = "assets/imgs/<?php echo $row['book_image']; ?>" />
              <h5 class = "p-name"><?php echo $row['book_title']; ?></h5>
              <h4 class = "p-price">₴ <?php echo $row['book_price']; ?></h4>
              <a href= "<?php echo "single_product.php?book_id=". $row['book_id'];?>" ><button class = "buy-btn">Buy Now</button></a>
          </div>
        <?php } ?>

        </div>
        </section>




      <!--New
          <section id = "new" class = "w-100">
          <div class = "row p-0 m-0">
         
            <div class = "one col-lg-4 col-md-12 col-sm-12 p-0">
              <img class = "img-fluid" src = "assets/imgs/heartwarming_stories.png"/>
              <div class = "details">
                <h2>Heartwarming Stories</h2>
                <button class = "text-uppercase">Shop Now</button>
              </div>
            </div>

         
            <div class = "one col-lg-4 col-md-12 col-sm-12 p-0">
              <img class = "img-fluid" src = "assets/imgs/mystery_mania.png"/>
              <div class = "details">
                <h2>Mystery Mania</h2>
                <button class = "text-uppercase">Shop Now</button>
              </div>
            </div>


            <div class = "one col-lg-4 col-md-12 col-sm-12 p-0">
              <img class = "img-fluid" src = "assets/imgs/brain_boosters.png"/>
              <div class = "details">
                <h2>Brain Boosters</h2>
                <button class = "text-uppercase">Shop Now</button>
              </div>
            </div>

          </div>
          </section>-->



      <!--Banner-->
      <section id = "banner" class = "my-5 py-5">
        <div class = "container">
              <p>«A reader lives a thousand lives before he dies.</p>
              <p>The man who never reads lives only one.» — </p>
              <h4>George R. R. Martin</h4>
        </div>
      </section>      
          
      <!--Children's Literature-->
      <section id = "featured" class = "my-5">
        <div class = "container text-center mt-5 py-5">
          <h3>Children's Literature</h3>
          <hr class = "mx-auto">
          <p>Dive into the world of children's literature!</p>
        </div>
      
        <div class = "row mx-auto container-fluid">
            <?php include 'server/get_childrens_books.php'; ?>
            <?php while($row=$childrens_books->fetch_assoc()){ ?>

            <div class = "product text-center col-lg-3 col-md-4 col-sm-12">
                <img class = "img-fluid mb-3" src = "assets/imgs/<?php echo $row['book_image']; ?>"/>
                <h5 class = "p-name"><?php echo $row['book_title']; ?></h5>
                <h4 class = "p-price">₴ <?php echo $row['book_price']; ?></h4>
                <a href= "<?php echo "single_product.php?book_id=". $row['book_id'];?>" ><button class = "buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>

        </div>
      </section>  

      <?php include"layouts/footer.php"; ?>