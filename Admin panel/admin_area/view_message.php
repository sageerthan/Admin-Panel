<?php
include('../includes/dbconnection.php');
session_start();
$admin_id = $_SESSION['admin_id'];

$orderby = 'newest';
if (isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
}
if ($orderby == 'newest') {
    $messageResult = mysqli_query($connection, 'select * from messages order by date desc limit 5');
} else if ($orderby == 'oldest') {
    $messageResult = mysqli_query($connection, "select * from messages order by date asc");
}

if(isset($_GET['del_msg']))
{
    $delete=$_GET['del_msg'];
    $result="delete from messages where msg_id='$delete'";
    $del_msg=mysqli_query($connection,$result);
    echo "<script>alert('Message deleted successfully!!!');window.location.href='view_message.php';</script>";
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
        .container h4 {
            color: #FF039E;
            text-align: center;
        }

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
            margin-top: 120px;
            margin-left: 400px;
        }

        .container h4 {
            text-align: center;
            font-weight: bolder;
            font-size: 20px;
        }

        .container .top-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .container .top-header button {
            background-color: hsl(323, 100%, 51%);
            color: whitesmoke;
            border-radius: 8px;
            box-shadow: 0 2px 5px hsl(323, 100%, 41%);
            border: none;
            cursor: pointer;
        }

        .container .top-header button.unactive {
            background-color: transparent;
            box-shadow: 0 2px 5px hwb(0 87% 12%);
            color: #FF039E;
        }

        .container .messages-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, 350px);
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
        }

        .container .messages-wrapper .message-box {
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 20px grey;
            transition: 0.3s;
            cursor: pointer;
        }

        
        .container .messages-wrapper .message-box:hover {
            transform: translateY(-5px);
        }

        .container .messages-wrapper .message-box .box_top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 2px solid grey;
        }

        .container .messages-wrapper .message-box .box_top .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .container .messages-wrapper .message-box .box_top .profile i {
            background-color: #FF039E;
            color: white;
            border-radius: 50%;
            padding: 10px 12px;
        }

        .container .messages-wrapper .message-box .box_top .profile .name_user {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .container .messages-wrapper .message-box .box_top .profile .name_user span {
            font-size: 13px;
        }

        .container .messages-wrapper .message-box .comments {
            padding: 10px 10px 5px;
            font-size: 13px;
            flex: 1;
        }

        .container .messages-wrapper .message-box .date {
            padding: 0 10px 10px;
            font-size: 13px;
            text-align: right;
        }
        .container .messages-wrapper .message-box .box_top .delete {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color:hsl(0, 100%, 50%);
            color:white;
            border:none;
            border-radius: 40px;
            cursor: pointer;
        }
        .container .messages-wrapper .message-box .box_top .delete i{
            color:#fff;
            padding:2px;
            font-size: 20px;
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
                <li class="active">
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
    </div>

    <div class="container">
        <h4>Customer Messages</h1>

            <div class="top-header">
                <a href="view_message.php?orderby=newest"><button style="font-size: 16px;padding:5px 12px" class="<?php if ($orderby == 'oldest') echo "unactive";
                                                                                                                    else echo ""; ?>">Newest</button></a>
                <a href="view_message.php?orderby=oldest"><button style="font-size: 16px;padding:5px 12px" class="<?php if ($orderby == 'newest') echo "unactive";
                                                                                                                    else echo ""; ?>">Oldest</button></a>
            </div>
            <div class='messages-wrapper'>
                <?php
                while ($msg = mysqli_fetch_assoc($messageResult)) { ?>
                    <div class="message-box">

                        <div class="box_top">
                            <div class="profile">
                                <span class="profile_img">
                                    <i class='bx bxs-user'></i>
                                </span>

                                <span class="name_user">
                                    <span style="font-weight: 600;text-transform:uppercase;"><?php echo $msg['name'] ?></span>
                                    <span><?php echo $msg['email'] ?></span>
                                </span>
                            </div>
                            <a href="view_message.php?del_msg=<?php echo $msg['msg_id'] ?>"><button type='submit' name="delete_msg" class="delete"><i class='bx bxs-message-x'></i>Delete</button></a>
                        </div>

                        <div class="comments">
                            <?php echo $msg['message'] ?>
                        </div>

                        <div class="date">
                            <?php echo $msg['date'] ?>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

    </div>

</body>

</html>