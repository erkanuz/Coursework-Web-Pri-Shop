<?php 

include 'config.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $brand = mysqli_real_escape_string($conn , $_POST['brand']);
    $model = mysqli_real_escape_string($conn , $_POST['model']);
    $type = mysqli_real_escape_string($conn , $_POST['type']);
    $Fnumber = mysqli_real_escape_string($conn , $_POST['Fnumber']);
    $Snumber = mysqli_real_escape_string($conn , $_POST['Snumber']);
    $country = mysqli_real_escape_string($conn , $_POST['country']);

    $select_products = mysqli_query($conn , "UPDATE `products` SET brand = '$brand' , model = '$model' , type = '$type' , Fnumber = '$Fnumber' , Snumber = '$Snumber' , country = '$country' WHERE id = '$update_p_id' ");

}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <title>Update</title>
</head>
<body>

<section class="update_products section">
        <?php 

            $update_id = $_GET['update'];
            $select_products = mysqli_query($conn , "SELECT * FROM `products` WHERE id ='$update_id' ");
            if(mysqli_num_rows($select_products) > 0 ) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
        <h2 class="section_title">Update</h2>
        <div class="products_container container grid">
        <form action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $fetch_products['id'];?>" name="update_p_id">

        <div class="product_box">
            <select class="try_pod" name="brand" id="brand">
                <option value=""><?php echo $fetch_products['brand'];?></option>
                <option value="Brother">Brother</option>
                <option value="Canon">Canon</option>
                <option value="HP">HP</option>
                <option value="Xerox">Xerox</option>
            </select>
                    <label for="" class="pro_options">Brand</label>
        </div>

        <div class="product_box">
            <select class="try_pod" name="model" id="model">
                <option value=""><?php echo $fetch_products['model']?></option>
                <option value="Biza">Biza</option>
                <option value="Cansi">Cansi</option>
                <option value="Holy">Holy</option>
                <option value="Xero">Xero</option>
            </select>
                    <label for="" class="pro_options">Model</label>
        </div>

        <div class="product_box">
            <select class="try_pod" name="type" id="type">
                <option value=""><?php echo $fetch_products['type']?></option>
                <option value="Matrix">Matrix</option>
                <option value="Lazer">Lazer</option>
                <option value="Inkjet">Inkjet</option>
            </select>
                    <label for="" class="pro_options">Type</label>
        </div>

        <div class="product_box">
            <input type="number" class="product_input" name="Fnumber" min="1" max="50" value="<?php echo $fetch_products['Fnumber']; ?>" required >
            <label for="" class="product_label">number of pages per minute</label>
        </div>

        <div class="product_box">
            <input type="number" class="product_input" name="Snumber" min="1" max="20" value="<?php echo $fetch_products['Snumber']; ?>" required >
            <label for="" class="product_label">number of pages on a single charge of the consumable</label>
        </div>

        <div class="product_box">
            <input type="text" class="product_input" placeholder="" name="country" value="<?php echo $fetch_products['country']; ?>" required>
            <label for="" class="product_label">Country</label>
        </div>

        <button type="submit" name="update_product" class="update_btn">Update button</button>

        <button class="close_button"><a href="admin.php">Back</a></button>

        </form>
        </div>

        <?php 
            }
        }
        ?>

        </section>
    
</body>
</html>