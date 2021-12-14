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

    <div class="container">
        <p>
            State the item name you want to delete from the record.
        </p>
        <form action="" method="POST">
            <p> Item Name:
                <input type="text" name='item_name' required>
            </p>
            <input type="submit" name="submit" value="Delete">
        </form>
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