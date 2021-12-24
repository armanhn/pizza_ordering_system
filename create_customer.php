<?php
include 'conn.php';
if (isset($_POST['submit'])) {
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $contact = $_POST['user_contact'];
    $address = $_POST['user_address'];

    if ($password === $c_password) {
        $sql = "INSERT INTO user (user_id,password,user_type) VALUES ('$id','$password','customer')";
        $sql2 = "INSERT INTO customer (customer_id,customer_name,address,contact,email) VALUES ('$id',
        '$name','$address','$contact','$email')";
        if (mysqli_query($conn, $sql)) {
            echo "DONE";
        } else {
            echo "ERROR";
        }
        if (mysqli_query($conn, $sql2)) {
            echo "DONE";
        } else {
            echo "ERROR";
        }
    } else {
        echo "Password does not match";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="sign_up.js"></script>
    <title>Document</title>
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
        <form action="" class="myForm" method="POST">
            <p><label for="user_id">User name:</label> <input type="text" name="user_id" placeholder="Enter User ID" id='user_id'></p>

            <p><label for="">Full Name:</label><input type="text" name="user_name" placeholder="Enter Full Name"></p>

            <p><label for="">Email:</label> <input type="text" name="user_email" placeholder="Enter Email"></p>

            <p><label for="">Password:</label><input type="password" name="password" id="" placeholder="Enter Password"></p>

            <p><label for="">Confirm Password: </label><input type="password" name="c_password" id="" placeholder="Confirm Password"></p>

            <p><label for="">Contact:</label> <input type="text" name="user_contact" placeholder="Enter Phone Number"> </p>

            <p><label for="">Address:</label><input type="text" name="user_address" placeholder="Enter Address"></p>

            <input type="submit" value="Sign up" name="submit">
        </form>
    </div>
</body>

</html>