<?php
include "conn.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section id='navbar'>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
            <a class="navbar-brand ps-5" href="admin_dashboard.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_item_update.php">Update Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_order.php">View Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_customer_update.php">Update Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="admin_view_charts.php">Charts</a>
                    </li>
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item position-absolute end-0 pe-5">
                            <a href="logout.php"><button class=" btn" id='logout-btn'>LOGOUT</button></a>
                        </li>
                    </ul>
                </ul>
            </div>
        </nav>
    </section>
    <div class="container">
        <p class=text-muted>
            You will not be able to update Item name rather provide item name to update that specific item.
        </p>
        <div class="form-group">
            <form action="" class="myForm" method="POST">
                <p class=text-muted><label for="user_id">User name:</label> <input type="text" class="form-control" name="user_id" placeholder="Enter User ID" id='user_id' required></p>

                <p class=text-muted><label for="">Full Name:</label><input type="text" class="form-control" name="user_name" placeholder="Enter Full Name"></p>

                <p class=text-muted><label for="">Email:</label> <input type="text" name="user_email" class="form-control" placeholder="Enter Email"></p>

                <p class=text-muted><label for="">Password:</label><input type="password" name="password" id="" class="form-control" placeholder="Enter Password"></p>

                <p class=text-muted><label for="">Contact:</label> <input class="form-control type=" text" name="user_contact" placeholder="Enter Phone Number"> </p>

                <p class=text-muted><label for="">Address:</label><input class="form-control type=" text" name="user_address" placeholder="Enter Address"></p>

                <input type="submit" value="Update" name="submit">
            </form>

        </div>
    </div>
    <?php
    $status = $statusMsg = '';
    if (isset($_POST["submit"])) {
        $user_id = $_POST['user_id'];

        $sql = "SELECT customer_id FROM customer WHERE customer_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $status = FALSE;
            if (!empty($_POST['user_name'])) {
                $user_name = $_POST['user_name'];
                $sql = "UPDATE customer
                        SET customer_name = '$user_name' WHERE customer_id = '$user_id'";
                if (mysqli_query($conn, $sql)) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
            }

            if (!empty($_POST['user_email'])) {
                $user_email = $_POST['user_email'];
                $sql = "UPDATE customer
                        SET email = '$user_email' WHERE customer_id = '$user_id'";
                if (mysqli_query($conn, $sql) and $status === TRUE) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
            }
            if (!empty($_POST['password'])) {
                $password = $_POST['password'];
                $sql = "UPDATE user
                        SET password = '$password' WHERE user_id = '$user_id'";
                if (mysqli_query($conn, $sql) and $status === TRUE) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
            }
            if (!empty($_POST['user_contact'])) {
                $user_contact = $_POST['user_contact'];
                $sql = "UPDATE customer
                        SET contact = '$user_contact' WHERE customer_id = '$user_id'";
                if (mysqli_query($conn, $sql) and $status === TRUE) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
            }
            if (!empty($_POST['user_address'])) {
                $user_address = $_POST['user_address'];
                $sql = "UPDATE customer
                        SET address = '$user_address' WHERE customer_id = '$user_id'";
                if (mysqli_query($conn, $sql) and $status === TRUE) {
                    $status = TRUE;
                } else {
                    $status = FALSE;
                }
            }
            if ($status === TRUE) {
                echo "Updated data";
            } else {
                echo "Something went wrong";
            }
        } else {
            echo "Something went wrong";
        }
    }

    ?>
</body>

</html>