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
        <table id='admin-table' class='table'>
            <tr>
                <th>Item ID</th>
                <th>Item Price</th>
                <th>Item Details</th>
                <th>Item Image</th>
            </tr>
            <?php
            $sql = "SELECT * FROM item_tbl";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_all($result);

            for ($i = 0; $i < sizeof($data); $i++) {
                echo '<tr>';
                echo '<td>' . $data[$i][0] . '</td>';
                echo '<td>' . $data[$i][1] . '</td>';
                echo '<td>' . $data[$i][2] . '</td>';
                echo '<td ><img src="data:img/jpg;base64,' . base64_encode($data[$i][3]) . '" style = "height:50;"/></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>