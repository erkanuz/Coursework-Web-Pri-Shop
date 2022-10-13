<?php 
    include 'config.php';

    session_start();

    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)){
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
<header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav_logo">
                <i class="fa-solid fa-print nav_logo-icon"></i> Printers
            </a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="home.php" class="nav_link">Home</a>
                    </li>
                    <li class="nav_item">
                        <a href="home.php" class="nav_link">About</a>
                    </li>
                    <li class="nav_item">
                        <a href="home.php" class="nav_link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="home.php" class="nav_link">Contacts</a>
                    </li>
                </ul>

                <div class="nav_close" id="nav-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="nav_btns">

                <div class="nav_search" id="search">
                    <i class="fa-solid fa-folder-tree"></i>
                </div>

                <div class="nav_shop" id="cart-shop">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <div class="nav_toggle" id="nav-toggle">
                    <i class="fa-solid fa-burger"></i>
                </div>

                <div class="nav_user" id="user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="user_box" id="user_info">
                    <i class="fa-solid fa-xmark" id="user_close"></i>
                    <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                    <a href="logout.php">logout</a>
                </div>

                <div class="search_box" id="search_info">
                <form action="" method="GET">
                    <a href="filter.php" class="search_link"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    <i class="fa-solid fa-xmark search_close" id="search_close"></i>
                    <p>Brands List</p>
                    <?php 
                        $select_product = mysqli_query($conn , "SELECT * FROM `products`");

                        if (mysqli_num_rows($select_product) > 0 ) {
                            foreach ($select_product as $brandList) {
                                $check = [];
                                if(isset($_GET['brand'])) { $check = $_GET['brand']; }
                              ?>

                              <div>
                                <input type="checkbox" name="brand[]" value="<?= $brandList['id']; ?>"
                                    <?php if(in_array($brandList['id'] , $check)) { echo "checked"; } ?>
                                />
                                <?= $brandList['brand']; ?>
                              </div>

                              <?php 
                            }
                        } else {
                            echo "No brands found";
                        }
                    ?>
                    <button type="submit" class="search_btn"> Search </button>
                </div>
                </form>

            </div>
        </nav>
    </header>

    <main class="main">

    <section class="home section" id="home">
            <div class="home_container container">

                <h2 class="section_title">Filter</h2>

                <div class="home_data">
                    <h1 class="home_title"> Hi , you're welcome back ! </h1>
                    <p class="home_subtitle"> Do you wanna to try filter option ? </p>
                    <span class="home_description"> ! please try it ! </span>
                </div>
            </div>
    </section>

    <!--- FILTER --->

    <section class="home section" id="home">
        <div class="home_container container grid">
            <?php 

                if(isset($_GET['brand'])) {

                    $brandcheck = [];
                    $brandcheck = $_GET['brand'];
                    foreach($brandcheck as $rowbrand) {

                       $products = mysqli_query($conn , "SELECT * FROM `products` WHERE id IN ($rowbrand)");
                       if(mysqli_num_rows($products) > 0) {
                           foreach ($products as $proditems) :
                               ?>
                               <div class="products_container grid">
                                   <div class="products_card">
                                       <h3><?= $proditems['brand']; ?></h3>
                                       <h3><?= $proditems['model']; ?></h3>
                                       <h3><?= $proditems['type']; ?></h3>
                                       <h3><?= $proditems['Fnumber']; ?></h3>
                                       <h3><?= $proditems['Snumber']; ?></h3>
                                       <h3><?= $proditems['country']; ?></h3>
                                   </div>
                                </div>
                               <?php
                           endforeach;
                       }
                    }

                } else {
                    $products = mysqli_query($conn , "SELECT * FROM `products`");
                    if(mysqli_num_rows($products) > 0) {
                        foreach ($products as $proditems) :
                            ?>
                                <div>
                                    <h3><?= $proditems['brand']; ?></h3>
                                </div>
                            <?php
                        endforeach;
                    } else {
                        echo "no brand !";
                    }
                }
            ?>
        </div>
    </section>

    <!--- FOOTER --->

    <footer class="footer section">
            <div class="footer_container container grid">

                <div class="footer_content">
                    <h3 class="footer_title">Our information</h3>

                    <ul class="footer_list">
                        <li>Las Vegas</li>
                        <li>Camboji 7099</li>
                        <li>123-456-789</li>
                    </ul>
                </div>

                <div class="footer_content">
                    <h3 class="footer_title">About Us</h3>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Support Center</a>
                        </li>
                    </ul>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Customer Support</a>
                        </li>
                    </ul>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Copy right</a>
                        </li>
                    </ul>
                </div>

                <div class="footer_content">
                    <h3 class="footer_title">Products</h3>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Matrix Printers</a>
                        </li>
                    </ul>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Lazer Printers</a>
                        </li>
                    </ul>

                    <ul class="footer_links">
                        <li>
                            <a href="#" class="footer_link">Inject Printers</a>
                        </li>
                    </ul>
                </div>

                <div class="footer_content">
                    <h3 class="footer_title">Social</h3>

                    <ul class="footer_social">
                        <a href="" target="_blank" class="footer_social-link">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="" target="_blank" class="footer_social-link">
                            <i class="fa-brands fa-gitkraken"></i>
                        </a>
                        <a href="" target="_blank" class="footer_social-link">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </ul>
                </div>
            </div>

            <span class="footer_copy"> &#169; Erkan Uz. All rights reserved</span>
        </footer>

    </main>

    <!--- Javascript --->
    <script src="javascript/navbar.js"></script>
</body>
</html>