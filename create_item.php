<?php
include 'conn.php';

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
                <p class=text-muted> Item ID:
                    <input type="text" class="form-control " name='item_id'>
                </p>
                <p class=text-muted> Item Name:
                    <input type="text" class="form-control " name='item_name'>
                </p>
                <p class=text-muted> Item Price:
                    <input type="text" class="form-control " name='item_price'>
                </p class=text-muted>
                <p class=text-muted> Item Details:
                    <input type="text" class="form-control " name='item_details'>
                </p class=text-muted>
                <input type="file" class="form-control-file " name="image" style="color: antiquewhite;">
                <input type="submit" name="submit" class="btn btn-primary" value="Upload">
            </form>
        </div>
    </div>
    <?php
    $status = $statusMsg = '';
    if (isset($_POST["submit"])) {
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $item_details = $_POST['item_details'];
        $status = 'error';
        if (!empty($_FILES["image"]["name"])) {
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Allow certain file formats 
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                // Insert image content into database 
                $insert = $conn->query("INSERT into item_tbl (item_id,item_name,item_price,item_details,item_img) 
                VALUES ('$item_id','$item_name','$item_price','$item_details','$imgContent')");

                if ($insert) {
                    $status = 'success';
                    $statusMsg = "File uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select an image file to upload.';
        }
    }

    // Display status message 
    echo $statusMsg;

    ?>
</body>

</html>