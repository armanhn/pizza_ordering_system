<?php
include 'conn.php';

$sql = "SELECT * FROM order_tbl";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
$data = mysqli_fetch_all($result);
$all_order = [];
for ($i = 0; $i < sizeof($data); $i++) {
    array_push($all_order, $data[$i][1]);
}
$all_item = [];
$item_name = [];
$item_quantity = [];
for ($i = 0; $i < sizeof($all_order); $i++) {
    $val = $all_order[$i];
    $item = explode(",", $val);
    array_push($all_item, $item);
}

for ($i = 0; $i < sizeof($all_item); $i++) {
    for ($j = 0; $j < sizeof($all_item[$i]); $j++) {
        if ($all_item[$i][$j] != "") {
            if ($j % 2 == 0) {
                array_push($item_name, $all_item[$i][$j]);
            } else if ($j % 2 == 1) {
                array_push($item_quantity, $all_item[$i][$j]);
            }
        }
    }
}



$sql = "SELECT item_name FROM item_tbl";
$result = mysqli_query($conn, $sql);
$unique_item = mysqli_fetch_all($result);
$chart_data = [];
for ($i = 0; $i < sizeof($unique_item); $i++) {
    $counter = 0;
    for ($j = 0; $j < sizeof($item_name); $j++) {
        if ($item_name[$j] == $unique_item[$i][0]) {
            $counter += $item_quantity[$j];
        }
    }
    array_push($chart_data, $counter);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body style="background-color: white;">
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
                        <li class="nav-item nav-item position-absolute end-0 pe-5">
                            <a href="logout.php"><button class=" btn" id='logout-btn'>LOGOUT</button></a>
                        </li>
                    </ul>
                </ul>
            </div>
        </nav>
    </section>
    <div id='chart' class='container' style="max-width: 1080px;"></div>
    <script>
        var array1 =
            <?php echo json_encode($chart_data); ?>;
        var array2 =
            <?php echo json_encode($unique_item); ?>;
        var options = {
            series: [{
                data: array1
            }],
            chart: {
                type: 'bar',

            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: array2,
            },

        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>

</html>