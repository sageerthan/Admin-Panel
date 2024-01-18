<?php
include('../includes/dbconnection.php');
session_start();
$admin_id = $_SESSION['admin_id'];

$result = "select * from category";
$query = mysqli_query($connection, $result);

if (isset($_POST['insert_product'])) {
    $category_id = $_POST["category_id"];
    $pro_name = $_POST["product_name"];
    $description = $_POST["product_description"];
    $image = $_FILES["product_image"]["name"];
    $temp_image = $_FILES["product_image"]["tmp_name"];
    $price = $_POST["product_price"];
    $qty = $_POST["product_qty"];
   

    if ($category_id == "" || $pro_name == "" || $description == "" || $image == "" || $price == "" || $qty == "" ) {
        $error[] = "Please fill all the fields";
    } 
    else {
        $insert_product = "insert into products (product_name,description,category_id,product_image,price,qty) values
                                ('$pro_name', '$description','$category_id','$image','$price','$qty')";

        $insert_product_run = mysqli_query($connection, $insert_product);

        if ($insert_product_run) {
            move_uploaded_file($temp_image, "./product_images/$image");
            header("location:index.php");
        } else {
            $error[] = "Something went wrong";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        header {
            background: #fff;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            position: fixed;
            left: 345px;
            width: 78%;
            top: 0;
            z-index: 100;
        }

        .container {
            margin-top: 150px;
            margin-left: 50px;
            margin-right: 50px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }

        .container h4 {
            margin-left: 500px;
            color: #FF039E;
            text-align: center;
            text-align: left;
            font-weight: bolder;
            font-size: 20px;
        }

        .input-group {
            margin-left: 100px;
            margin-top: 10px;
        }

        .input-group label {
            margin-left: 8px;
            font-weight: 500;
        }

        .input-group .select-cty,
        .form,
        .pro_name,
        .pro_desc
         {
            padding: 10px;
            border-radius: 5px;
            border: 2px solid var(--pink);
            width: 35%;
            margin-top: 14px;
        }

        .input-group .pro_price,
        .pro_qty
         {
            padding: 10px;
            border-radius: 5px;
            border: 2px solid var(--pink);
            width: 25%;
            margin-top: 14px;
            margin-right: 120px;
        }



        .input-group .form-control {
            background: #FF039E;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 10px;
            margin-bottom: 25px;
            margin-left: 400px;
            cursor: pointer;
        }

        .container .error-msg {
            margin: 10px 0;
            display: block;
            background: crimson;
            color: #fff;
            border-radius: 5px;
            font-size: 15px;
            padding: 10px;
            width: 30%;
            text-align: center;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="index.php"><i class='bx bxs-dashboard'></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="view_products.php"><i class='bx bxl-product-hunt'></i>
                        <span>View products</span></a>
                </li>
                <li>
                    <a href="view_categories.php"><i class='bx bxs-category'></i>
                        <span>View categories</span></a>
                </li>
                <li>
                    <a href="view_orders.php"><i class='bx bxs-show'></i>
                        <span>View orders</span></a>
                </li>
                <li class="active">
                    <a href="insert_products.php"><i class='bx bxs-caret-down-square'></i>
                        <span>Insert products</span></a>
                </li>
                <li>
                    <a href="insert_categories.php"><i class='bx bxs-chevron-down-square'></i>
                        <span>Insert categories</span></a>
                </li>
                <li>
                    <a href="view_customers.php"><i class='bx bxs-group'></i>
                        <span>Customers</span></a>
                </li>
                <li>
                    <a href="add_user.php"><i class='bx bx-user-plus'></i>
                        <span>Add users</span></a>
                </li>
                <li>
                    <a href="view_message.php"><i class='bx bx-message-detail'></i>
                        <span>Customer Message</span></a>
                </li>
                <li>
                    <a href="admin_profile.php"><i class='bx bx-user-circle'></i>
                        <span>Admin Profile</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class='bx bx-log-out'></i>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>

            <h1>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
                Dashboard
            </h1>
            <div class="sidebar-brand">
                <img src="pearl.jpg" alt="">
            </div>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>
            <div class="user-wrapper">
                <?php
                $select = mysqli_query($connection, "SELECT * FROM users WHERE id='$admin_id'") or die('query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }
                ?>
                <img src="Admin.png" width="30px" height="30px" alt="">
                <h4><?php
                    if (empty($fetch['name'])) {
                        echo "No Admin";
                    } else {

                        echo $fetch['name'];
                    }
                    ?></h4>
            </div>
            <div> <small>Admin</small></div>

        </header>

        <div class="container">
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo "<span class='error-msg'>" . $error . "</span>";
                }
            }
            ?>
            <div>
                <h4>Add Product</h4>
            </div>
            <div class="form-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="input-group">
                        <label>Select Category :</label>
                        <select class="select-cty" name="category_id">
                            <option selected>Select Category</option>
                            <?php
                            if (mysqli_num_rows($query) > 0) {
                                foreach ($query as $category) {
                            ?>
                                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option> <?php
                                                                                                                        }
                                                                                                                    } else {
                                                                                                                        echo "No category available";
                                                                                                                    }

                                                                                                                            ?>

                        </select>

                        <label>Product Name :</label>
                        <input type="text" class="pro_name" name="product_name" placeholder="Enter the product name">
                    </div>

                    <div class="input-group">
                        <label>Upload the image :</label>
                        <input type="file" class="form" name="product_image" placeholder="Upload the image">
                    </div>

                    <div class="input-group">
                        <label>Description</label><br>
                        <textarea rows="3" class="pro_desc" name="product_description" placeholder="Enter the description" style="width:60%"></textarea>
                    </div>

                    <div class="input-group">
                        <label style="margin-left:90px;">Price:</label>
                        <input type="text" class="pro_price" name="product_price" placeholder="Enter the price">

                        <label>Quantity:</label>
                        <input type="text" class="pro_qty" name="product_qty" placeholder="Enter the quantity">

            
                    </div>

                    <div class="input-group">
                        <input type="submit" class="form-control" name="insert_product" value="Insert Product">
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>