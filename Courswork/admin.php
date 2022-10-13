<?php 
    include 'config.php';

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)){
        header('location:login.php');
    };

    if (isset($_POST['add_product'])) {
        
        $brand = mysqli_real_escape_string($conn , $_POST['brand']);
        $model = mysqli_real_escape_string($conn , $_POST['model']);
        $type = mysqli_real_escape_string($conn , $_POST['type']);
        $Fnumber = mysqli_real_escape_string($conn , $_POST['Fnumber']);
        $Snumber = mysqli_real_escape_string($conn , $_POST['Snumber']);
        $country = mysqli_real_escape_string($conn , $_POST['country']);

        $select_product_brand = mysqli_query($conn , "SELECT brand FROM `products` WHERE brand = '$brand'");
        
        if (mysqli_num_rows($select_product_brand) > 0) {
            echo "<script>alert('Product brand already exists');</script>";
        }else {
            $insert_product = mysqli_query($conn , "INSERT INTO `products` (brand , model , type , Fnumber , Snumber , country) VALUES('$brand' , '$model' , '$type' , '$Fnumber' , '$Snumber' , '$country')");
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn , "DELETE FROM products WHERE id = $id");
        header('location:admin.php');
    }

    if (isset($_GET['del-acc'])){
        $delete_id = $_GET['del-acc'];
        mysqli_query($conn , "DELETE FROM users WHERE id = $delete_id");
        header('location:admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<header class="header" id="admin-header">
        <nav class="nav container">
            <a href="#" class="nav_logo">
                <i class="fa-solid fa-print nav_logo-icon"></i> Admin Panel
            </a>

            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav_item">
                        <a href="#home" class="nav_link">Home</a>
                    </li>
                    <li class="nav_item">
                        <a href="#products" class="nav_link">Products</a>
                    </li>
                    <li class="nav_item">
                        <a href="#view" class="nav_link">View</a>
                    </li>
                    <li class="nav_item">
                        <a href="#users" class="nav_link">Users</a>
                    </li>
                </ul>

                <div class="nav_close" id="nav-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="nav_btns">

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
                    <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                    <a href="logout.php">logout</a>
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
                    <p class="home_subtitle"> Are you ready for work ? </p>
                    <span class="home_description"> ! we have a bunch of stuff to doing ! </span>
                </div>

                <div class="home_button">
                <a href="#users" class="h_button">button</a>
                </div>

            </div>
        </section>

        <!--- PRODUCTS --->
        <section class="add-products section" id="products">
            <h2 class="section_title">Products</h2>
            <div class="products_container container grid">

                <form action="" method="POST" enctype="multipart/form-data">

                    <h3 class="product_title">Add new product</h3>

                    <div class="product_box">
                    <select class="try_pod" name="brand" id="brand">
                        <option value="Brother">Brother</option>
                        <option value="Canon">Canon</option>
                        <option value="HP">HP</option>
                        <option value="Xerox">Xerox</option>
                    </select>
                    <label for="" class="pro_options">Brand</label>
                    </div>

                    <div class="product_box">
                    <select class="try_pod" name="model" id="model">
                        <option value="Biza">Biza</option>
                        <option value="Cansi">Cansi</option>
                        <option value="Holy">Holy</option>
                        <option value="Xero">Xero</option>
                    </select>
                    <label for="" class="pro_options">Model</label>
                    </div>

                    <div class="product_box">
                    <select class="try_pod" name="type" id="type">
                        <option value="Matrix">Matrix</option>
                        <option value="Lazer">Lazer</option>
                        <option value="Inkjet">Inkjet</option>
                    </select>
                    <label for="" class="pro_options">Type</label>
                    </div>

                    <div class="product_box">
                    <input type="number" class="product_input" name="Fnumber" min="1" max="50" required >
                    <label for="" class="product_label">number of pages per minute</label>
                    </div>

                    <div class="product_box">
                    <input type="number" class="product_input" name="Snumber" min="1" max="20" required >
                    <label for="" class="product_label">number of pages on a single charge of the consumable</label>
                    </div>

                    <div class="product_box">
                    <input type="text" class="product_input" placeholder="" name="country" required>
                    <label for="" class="product_label">Country</label>
                    </div>

                    <input type="submit" class="add_button" value="add product" name="add_product">
                </form>
            
            </div>
        </section>

        <!--- VIEW --->
        <section class="view section container" id="view">

            <h2 class="section_title">View</h2>

            <div class="view_structor section contaienr">
            <?php 
                $select_product = mysqli_query($conn , "SELECT * FROM `products`");
                if (mysqli_num_rows($select_product) > 0 ) {
                        while ($fetch_products = mysqli_fetch_assoc($select_product)) {
                    ?>

            <div class="view_container grid">
                <article class="view_card">

                    <h3 class="view_title"> <?php echo $fetch_products['brand'];?> </h3>
                    <h3 class="view_title"> <?php echo $fetch_products['model']?> </h3>
                    <h3 class="view_title"> <?php echo $fetch_products['type']?> </h3>
                    <h3 class="view_title"> <?php echo $fetch_products['Fnumber']?> </h3>
                    <h3 class="view_title"> <?php echo $fetch_products['Snumber']?> </h3>
                    <h3 class="view_title"> <?php echo $fetch_products['country']?> </h3>

                    <button class="delete_button">
                    <a href = "admin.php ? delete=<?php echo $fetch_products['id']; ?>" > <i class="fa-solid fa-trash-arrow-up"></i> delete </a> 
                    </button>

                    <button class="update_button">
                    <a href = "update_products.php ? update=<?php echo $fetch_products['id']; ?>" > <i class="fa-solid fa-pen"></i> update </a>
                    </button>

                </article>
            </div>

            <?php 
                }
            }
            ?>
            </div>
        </section>


        <!--- USERS --->
        <section class="card section" id="users">

            <h2 class="section_title">Accounts</h2>

            <div class="card_container bd-container">
            <?php 
            
            $select_users = mysqli_query($conn , "SELECT * FROM `users`");
            if (mysqli_num_rows($select_users) > 0 ) {
                while($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?> 
            <div class="card_glass">
                <img src="img/cats.jpg" alt="" class="card_img">

                <div class="card_data">
                    <h3 class="card_title">Username : <span><?php echo $fetch_users['name']; ?></span></h3>
                    <p class="card_profession"> email : <span class="card_profession"><?php echo $fetch_users['email']; ?></span></p>
                </div>

                <a href="admin.php ? del-acc=<?php echo $fetch_users['id']; ?>" class="card_button"> DELETE </a>

                <div class="card_social">
                    <a href="#" class="card_link"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="card_link"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="card_link"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>

            <?php 
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

    <script src="javascript/admin.js"></script>
    <script src="javascript/reveal.js"></script>

</body>
</html>