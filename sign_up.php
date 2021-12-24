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
    <div class="container">
        <div class="form-group">
            <form action="" class="myForm" method="POST">
                <p>User name: </p>
                <input type="text" class="form-control" name="user_id" placeholder="Enter User ID" id='user_id'>
                <p>Full Name: </p>
                <input type="text" class="form-control" name="user_name" placeholder="Enter Full Name">
                <p>Email: </p>
                <input type="text" class="form-control" name="user_email" placeholder="Enter Email">
                <p>Password:</p>
                <input type="password" class="form-control" name="password" id="" placeholder="Enter Password">
                <p>Confirm Password:</p>
                <input type="password" class="form-control" name="c_password" id="" placeholder="Confirm Password">
                <p>Contact: </p>
                <input type="text" class="form-control" name="user_contact" placeholder="Enter Phone Number">
                <p>Address: </p>
                <input type="text" class="form-control" name="user_address" placeholder="Enter Address">
                <input type="submit" class="btn bg-seceondary" value="Sign up" name="submit">
            </form>
        </div>

    </div>
</body>

</html>