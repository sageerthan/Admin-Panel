<?php
include('../includes/dbconnection.php');
session_start();
$admin_id = $_SESSION['admin_id'];

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "select * from products where product_id='$id'";
    $result = mysqli_query($connection, $sql);
    $product = mysqli_fetch_assoc($result);

    $name = $product['product_name'];
    $price = $product['price'];
    $description = $product['description'];
    $image_url = $product['product_image'];

    $catergoryIdResult = mysqli_query($connection, "select * from products where product_id = $id");
    $category_id = mysqli_fetch_assoc($catergoryIdResult)['category_id'];

    $types = mysqli_query($connection, "select products.product_name,products.product_id,category.category_id,category.category_name from products,category where
                            category.category_id=products.category_id");

    $productStock = mysqli_query($connection, "select * from product_stock where product_id='$id'");
    $productSize = mysqli_query($connection, "select * from product_size");
    $productColour = mysqli_query($connection, "select * from product_colour");
}

$nameError = $priceError = $descriptionError = $main_categoryError = $typeError = $imageError = $sizeError = $colorError = "";

if (isset($_POST['update-details'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $new_image = $_FILES['image']['name'];
    $temp_image = $_FILES['image']['tmp_name'];

    if (isset($_FILES['image'])) {
        $imageError = validate_image($_FILES['image']);
        if ($imageError == '' && $_FILES['image']['size'] != 0) {
            move_uploaded_file($temp_image, "./product_images/$new_image");
        } else {
            $imageError = "Error occured in uploading image";
        }
    }
    $nameError = validate_name($name);
    $priceError = validate_price($price);
    $descriptionError = validate_description($description);
    $typeError = validate_type($type);
    if ($nameError == '' && $priceError == '' && $descriptionError == '' && $imageError == '' && $typeError == '') {
        updateDetails($connection, $id, $name, $price, $description, $new_image, $type);
        echo "<script>alert('Product updated successfully');window.location.href='product_details.php'?id='$id';</script>";
    }
}
 if(isset($_POST['add-stock']))
 {
    $size=$_POST['size'];
    $colour=$_POST['colour'];
    $stock=$_POST['stock'];

    $sql="insert into product_stock (product_id,colour_id,size_id,stock_qty) values ('$id','$colour','$size','$stock')";
    $result=mysqli_query($connection,$sql);
    echo "<script>alert('Product details updated successfully!');window.location.href = 'product_details.php?id=$id';</script>";
 }

 if(isset($_GET['id']) && isset($_GET['stock']))
 {
    $sid=$_GET['stock'];
    $qty=$_POST["$sid"];

    $result="update product_stock set stock_qty='$qty' where  stock_id='$sid'";
    $product_id=mysqli_query($connection,$result);
    echo "<script>alert('Product details updated successfully!');window.location.href = 'product_details.php?id=$id';</script>";
 }

 if(isset($_GET['id']) && isset($_GET['remove']))
 {
    $sid=$_GET['remove'];
    $result="delete from product_stock where stock_id='$sid'";
    $delete=mysqli_query($connection,$result);
    echo "<script>alert('Product details deleted successfully!');window.location.href = 'product_details.php?id=$id';</script>";
 }
 
 if(isset($_POST["delete-product"]))
 {
    $result="delete from products where product_id='$id'";
    $delete=mysqli_query($connection,$result);
    
    $result1="delete from product_stock where product_id='$id'";
    $delete1=mysqli_query($connection,$result1);
    echo "<script>alert('Product completely deleted');window.location.href='view_products.php'</script>";
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

        .product-container {
            margin-top: 90px;

        }

        .product-container .h1 {
            display: flex;
        }

        .product-container .h1 span {
            color: #FF039E;
            margin-left: 400px;
        }

        .product-container .detail-box {
            display: flex;
            width: 100%;
        }

        .product-container .detail-box img {
            width: 500px;
            height: 500px;
            border-radius: 8px;
            margin: 6px;
        }

        .product-container .detail-box form {
            padding: 0 10px;
            width: 100%;

        }

        .product-container .detail-box form .input-box {
            width: 100%;
            margin: 7px 0;
        }

        .product-container .detail-box form .input-box>div {
            display: flex;
            gap: 10px;
        }

        .product-container .detail-box form .input-box table {
            width: 100%;
        }

        .product-container .detail-box form .input-box input,
        .product-container .detail-box form .input-box textarea,
        .product-container .detail-box form .input-box select {
            width: 100%;
            padding: 7px;
            border-radius: 3px;
            border: 2px solid grey;
            font-size: 16px;
        }

        .product-container .detail-box form .input-box table {
            border-collapse: collapse;
            border-color: #FF039E;
        }

        table tr:nth-of-type(even) {
            background-color: rgb(255, 227, 232);
        }

        .product-container .detail-box form .input-box table th {
            font-weight: 600;
            text-transform: capitalize;
            color: #FF039E;
            font-weight: 600;
        }

        .product-container .detail-box form .input-box table td input {
            width: 80px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border: 2px solid #FF039E;
        }

        .product-container .detail-box form .input-box table td button {
            display: inline;
        }

        .product-container .detail-box small {
            color: red;
        }

        .product-container .detail-box label {
            font-weight: 600;
        }
       

        .product-container .detail-box form .input-box .box {
            display: inline-block;
            padding: 3px 5px;
            align-items: center;
            border-radius: 5px;
            margin-top: 5px;
            margin-right: 5px;
            background-color: rgb(255, 227, 232);
        }

        .product-container .detail-box form .input-box .box button {
            background-color: transparent;
        }

        .product-container .detail-box form .input-box .box button:hover i {
            color: pink;
        }


        h1 button {
            font-size: 16px;
            padding: 7px 10px;
            background: #FF039E;
            color: white;
            border: none;
            margin-left: 300px;
            cursor: pointer;
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
                <li class="active">
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
                <li>
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
            <div> <small>Admin</small>
            </div>

        </header>
        <div class="product-container">
            <h1 class="h1"><span>View product</span><a href="view_products.php"><button>
                        < Back to products</button></a></h1>

            <div class="detail-box">
                <img src="./product_images/<?= $image_url ?>">
                <form class="details" action="product_details.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                    <div class="input-box">
                        <label for="id">Product ID</label><br>
                        <input type="text" id="id" name="id" value="<?php echo $id; ?>" disabled>
                    </div>
                    <div class="input-box">
                        <label for="name">Product Name</label><br>
                        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                        <small><?php echo $nameError ?></small>
                    </div>
                    <div class="input-box">
                        <label for="price">Unit price</label><br>
                        <input type="text" id="price" name="price" value="<?php echo $price; ?>">
                        <small><?php echo $priceError ?></small>
                    </div>
                    <div class="input-box">
                        <label for="description">Description</label><br>
                        <textarea type="text" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
                        <small><?php echo $descriptionError ?></small>
                    </div>
                    <div class="input-box">
                        <label for="">Edit product image</label>
                        <input type="file" name="image" accept=".jpeg, .jpg, .png, .webp">
                        <small><?php echo $imageError ?></small>

                    </div>
                    <div class="input-box">
                        <label for="">Category</label><br>
                        <div>
                            <select name="type" id="">
                                <option value="select">Select sub category</option>
                                <?php
                                while ($ty = mysqli_fetch_assoc($types)) {
                                    echo "<option value='" . $ty['category_id'] . "'";
                                    if ($ty['product_id'] == $id) echo 'selected';
                                    echo ">" . $ty['category_name'] . " - " . $ty['product_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <small><?php echo   $typeError ?></small>
                    </div>
                    <button style="font-size: 16px;padding:10px 15px;margin-bottom:20px; background-color: #FF039E;color:white;
                                   border-radius:6px;border:none" name="update-details">Update details</button>

                    <div class="input-box">
                        <label for="">Available stock quantity</label>
                        <table border="1px">
                            <tr>
                                <th>Product Size</th>
                                <th>Product Colour</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            while ($stock = mysqli_fetch_assoc($productStock)) {
                                echo "<tr><td>" . getSize($connection, $stock['size_id']) . "</td>
                                <td>" . getColour($connection, $stock['colour_id']) . "</td>
                                <td style=''>
                                        <input type='number' name='" . $stock['stock_id'] . "' value='" . $stock['stock_qty'] . "'>
                                        <button style='margin-left:15px;font-size:14px;padding:5px 8px;background: #FF039E;color:white;border-radius:6px;border:none;' onclick='handleUpdate($id, " . $stock['stock_id'] . ")'>Update</button>
                                </td>
                                <td><button  style='font-size:14px;padding:5px 8px;background: #FF039E;color:white;border-radius:6px;border:none;' onclick='handleRemove($id, " . $stock['stock_id'] . ")'>Remove</button></td></tr>";
                            }



                            ?>
                        </table>
                    </div>
                    <div class="input-box">
                        <label for="">Add new stock</label>
                        <div>
                            <select name='size' id=''>
                                <option value="select">Select size</option>
                                <?php
                                while($size=mysqli_fetch_assoc($productSize))
                                {
                                echo "<option value='".$size['size_id']."'>".$size['size_name']."</option>";
                                }
                                ?>
                            </select>
                        
                            <select name='colour' id=''>
                                <option value="select">Select Colour</option>
                                <?php
                                while($colour=mysqli_fetch_assoc($productColour))
                                {
                                echo "<option value='".$colour['colour_id']."'>".$colour['colour_name']."</option>";
                                }
                                ?>
                            </select>
                            <input type="number" name="stock" id="" placeholder="Enter stock quantity" value="0" min="0">
                        </div>
                        <small><?php echo $sizeError . " " . $colorError ?></small>
                        <div style="display: flex;align-items:center">
                            <button style="font-size: 16px;padding:10px 15px;margin-top:10px;background-color:#FF039E;color:#fff;width:20%;border:none;border-radius:6px;" name="add-stock">Add stock</button>
                        </div>
                    </div>
                    <div class="input-box">
                        <label for="">Delete this product from the system</label><br>
                        <button type="submit" style="background-color:red;padding:7px 15px;font-size:16px;margin-top:8px;color:#fff;width:20%;border:none;border-radius:6px;" name="delete-product" onclick="return confirm('Are you sure? Do you want to delete this product?')">Delete</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function handleUpdate(pid, sid) {
            let form = document.querySelector(".details");
            let action = "product_details.php?id=" + pid + "&stock=" + sid; 
            form.setAttribute('action', action);
            form.submit();
        }
        function handleRemove(pid, sid) {
            let form = document.querySelector(".details");
            let action = "product_details.php?id=" + pid + "&remove=" + sid; 
            form.setAttribute('action', action);
            form.submit();
        }
    </script>

    <script src="admin.js"></script>
</body>

</html>
<?php
function getSize($connection, $sizeid)
{
    $query = "select size_name from product_size where size_id='$sizeid'";
    $result = mysqli_query($connection, $query);

    return mysqli_fetch_assoc($result)['size_name'];
}

function getColour($connection, $colourid)
{
    $query = "select colour_name from product_colour where colour_id='$colourid'";
    $result = mysqli_query($connection, $query);

    return mysqli_fetch_assoc($result)['colour_name'];
}

function validate_image($image)
{
    if ($image['size'] != 0) {
        $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'webp') {
            return "You can only upload .jpg, .jpeg, .png files only!";
        }
    }
    return "";
}
function validate_name($name)
{
    if ($name == "") {
        return "Product name is required";
    } else {
        return "";
    }
}
function validate_price($price)
{
    if ($price == "") {
        return "Product price is required";
    } else if ((preg_match("/[^0-9.]/", $price))) {
        return "price cannot have letters or special characters";
    } else {
        return "";
    }
}
function validate_description($description)
{
    if ($description == "") {
        return "Product description is required";
    } else {
        return "";
    }
}
function validate_type($type)
{
    if ($type == "select") {
        return "Product type is required";
    } else {
        return "";
    }
}
function updateDetails($connection, $id, $name, $price, $description, $new_image, $type)
{
        mysqli_query($connection, "update products set product_name = '$name', price = $price, description = '$description', product_image = '$new_image',category_id='$type'  where product_id = $id");
     
}
?>