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
    <script src="https://unpkg.com/scrollreveal"></script>
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
                        <a href="#home" class="nav_link">Home</a>
                    </li>
                    <li class="nav_item">
                        <a href="#about" class="nav_link">About</a>
                    </li>
                    <li class="nav_item">
                        <a href="#products" class="nav_link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="#contacts" class="nav_link">Contacts</a>
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
                    <a href="filter.php" class="search_link"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    <i class="fa-solid fa-xmark search_close" id="search_close"></i>
                </div>


            </div>
        </nav>
    </header>

    <main class="main">

        <!--- HOME --->

        <section class="home section" id="home">
            <div class="home_container container">

                <h2 class="section_title">Home</h2>

                <div class="home_data">
                    <h1 class="home_title"> Hi , you're welcome back ! </h1>
                    <p class="home_subtitle"> Are you ready for shopping ? </p>
                    <span class="home_description"> ! please enjoy so much ! </span>
                </div>
            </div>
        </section>

        <!--- ABOUT --->

        <section class="about section container" id="about">
            <div class="about_container container grid">
            <h2 class="section_title">About</h2>

            <h1 class="secound_title">Why you should choose us & What we offer for you !</h1>

            <div class="about_content grid">
                <div class="about_image">
                    <img src="img/log in.svg" alt="" class="a_img">
                </div>

                <div class="about_data">
                    <p class="about_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dignissimos tempore, sunt suscipit ad esse adipisci, quos deleniti dolores sapiente qui praesentium itaque assumenda delectus repellendus! Autem asperiores neque unde.</p>             
                </div>

                <div class="about_button">
                    <a href="#products">Buy now <i class="fa-solid fa-arrow-turn-down"></i> </a>
                </div>   
            </div>

            </div>
        </section>

        <!--- PRODUCTS --->

        <section class="U_products section container" id="products">

        <h2 class="section_title">Products</h2>

        <div class="products_structor section contaienr">
        <?php 
            $select_product = mysqli_query($conn , "SELECT * FROM `products`");
            if (mysqli_num_rows($select_product) > 0 ) {
                    while ($fetch_products = mysqli_fetch_assoc($select_product)) {
                ?>

        <div class="products_container grid">
                <article class="products_card">

                    <h3 class="products_title"> <?php echo $fetch_products['brand'];?> </h3>
                    <h3 class="products_title"> <?php echo $fetch_products['model']?> </h3>
                    <h3 class="products_title"> <?php echo $fetch_products['type']?> </h3>
                    <h3 class="products_title"> <?php echo $fetch_products['Fnumber']?> </h3>
                    <h3 class="products_title"> <?php echo $fetch_products['Snumber']?> </h3>
                    <h3 class="products_title"> <?php echo $fetch_products['country']?> </h3>
                    
                    <button class="add_button">
                    <a href = " ? add=<?php echo $fetch_products['id']; ?>" > <i class="fa-solid fa-cart-plus"></i> Add to cart </a>
                    </button>

                </article>
            </div>

            <?php 
                }
            }
            ?>
            </div>
        </section>

        <!--- CONTACTS --->

        <section class="contacts section container" id="contacts">
            <div class="contact_container grid">

                <h2 class="section_title">Contact Us</h2>

                <div>
                    <h2 class="contact_title">Reach out to us today <br> Just send your message <br>We will send you feedback as soon as possible</h2>
                </div>

                <div class="contact_data">
                    <div>
                        <h3 class="contact_subtitle">Call us for insta support</h3>
                        <span class="contact_description"><i class="fa-solid fa-phone"></i> +123 456 789 </span>
                    </div>
                </div>

                <div class="contact_data">
                    <div>
                        <h3 class="contact_subtitle">Write us by email</h3>
                        <span class="contact_description"><i class="fa-solid fa-envelope-circle-check"></i> company@email.com </span>
                    </div>
                </div>

                <form action="" class="conatct_form">
                    <div class="class_inputs">

                        <div class="contact_content">
                            <input type="email" placeholder="Email" class="contact_input">
                        </div>

                        <div class="contact_content">
                            <input type="text" placeholder="Subject" class="contact_input">
                        </div>

                        <div class="contact_content contact_area">
                            <textarea name="Message" placeholder="Message" class="contact_input"></textarea>
                        </div>
                    </div>

                    <div class="contact_button">
                        <a href="#">Send message <i class="fa-solid fa-arrow-up-right-from-square"></i> </a>
                    </div> 
                </form>
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

    <script src="javascript/navbar.js"></script>
    <script src="javascript/reveal.js"></script>
</body>
</html>