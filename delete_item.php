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
        <div class="form-group">
            <form action="" method="POST" enctype="multipart/form-data">

                <p class=text-muted> Item Name:
                    <input type="text" class="form-control " name='item_name'>
                </p>
                <input type="submit" name="submit" class="btn btn-primary" value="Delete">
            </form>
        </div>
    </div>
    <?php
    $status = $statusMsg = '';
    if (isset($_POST["submit"])) {
        $item_id = $_POST['item_name'];
        $sql = "SELECT item_id FROM item_tbl WHERE item_id = '$item_id'";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $sql = "DELETE FROM item_tbl WHERE item_id ='$item_id'";
            if (mysqli_query($conn, $sql)) {
                echo "Item was Deleted";
            }
        } else {
            echo "Something went wrong";
        }
    }
    ?>
</body>

</html>