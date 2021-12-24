<?php
include 'conn.php';
session_start();
$id = $_SESSION['id'];
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $item_id = $_GET["item_id"];
                $sql = "SELECT * FROM item_tbl WHERE item_id='$item_id'";
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_assoc($result);
                $itemArray = array($data["item_id"] => array('name' => $data["item_name"], 'id' => $data["item_id"], 'quantity' => $_POST["quantity"], 'price' => $data["item_price"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($data["item_id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($data["item_id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET["item_id"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Customer Dashboard</title>
</head>

<body>
    <section id='navbar'>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
            <a class="navbar-brand ps-5" href="customer_dashboard.php">Home</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item nav-item position-absolute end-0 pe-5 ">
                            <a href="logout.php"><button class=" btn" id='logout-btn'>LOGOUT</button></a>
                        </li>
                    </ul>
                </ul>
            </div>
        </nav>
    </section>
    <section>
        <div id="data" class="container">
            <h1>Pizzeria</h1>

            <div id=data2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                        $sql = "SELECT COUNT(item_id) FROM item_tbl";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_array($result);
                        $total_item = $data[0];
                        echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
                        for ($i = 1; $i < $total_item; $i++) {
                            echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'></li>";
                        }
                        ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner ">
                        <div class="item active" style=" text-align: center; font-size: 25px;">
                            <div class="p4nic">
                                <p><?php
                                    $sql = "SELECT * FROM item_tbl LIMIT 1";
                                    $result = mysqli_query($conn, $sql);
                                    $data = mysqli_fetch_all($result);
                                    echo "Item Name: " . $data[0][1] . '<br>';
                                    echo "Item price: " . $data[0][2] . '<br>';
                                    echo "Item details: " . $data[0][3] . '<br>';
                                    echo '<img src="data:img/jpg;base64,' . base64_encode($data[0][4]) . '" style = "height:500;"/>';
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM item_tbl";
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_all($result);
                        for ($i = 1; $i < $total_item; $i++) {
                            echo "<div class='item' style='text-align: center; font-size: 25px; max-height:fit-content;'>";
                            echo "<div class='p4nic'>";
                            echo "<p>";
                            echo "Item Name = " . $data[$i][1] . '<br>';
                            echo "Item price = " . $data[$i][2] . '<br>';
                            echo "Item details = " . $data[$i][3] . '<br>';
                            echo '<img src="data:img/jpg;base64,' . base64_encode($data[$i][4]) . '" style = "height:500;"/>';
                            echo "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">

            <div id="shopping-cart">
                <div class="txt-heading">Shopping Cart</div>

                <a id="btnEmpty" href="customer_dashboard.php?action=empty">Empty Cart</a>
                <?php
                if (isset($_SESSION["cart_item"])) {
                    $total_quantity = 0;
                    $total_price = 0;
                ?>
                    <table class="tbl-cart" cellpadding="10" cellspacing="1">
                        <tbody>
                            <tr>
                                <th style="text-align:left;">Name</th>
                                <th style="text-align:left;">Code</th>
                                <th style="text-align:right;" width="5%">Quantity</th>
                                <th style="text-align:right;" width="10%">Unit Price</th>
                                <th style="text-align:right;" width="10%">Price</th>
                                <th style="text-align:center;" width="5%">Remove</th>
                            </tr>
                            <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_price = $item["quantity"] * $item["price"];
                            ?>
                                <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["id"]; ?></td>
                                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                    <td style="text-align:right;"><?php echo  $item["price"]; ?></td>
                                    <td style="text-align:right;"><?php echo  number_format($item_price, 2); ?></td>
                                    <td style="text-align:center;"><a href="customer_dashboard.php?action=remove&item_id=<?php echo $item["id"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                </tr>
                            <?php
                                $total_quantity += $item["quantity"];
                                $total_price += ($item["price"] * $item["quantity"]);
                            }
                            ?>

                            <tr>
                                <td colspan="2" align="right">Total:</td>
                                <td align="right"><?php echo $total_quantity; ?></td>
                                <td align="right" colspan="2"><strong><?php echo  number_format($total_price, 2); ?></strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="" method=POST>
                        <input type="submit" name="submit" value="<?php if ($total_quantity > 1) {
                                                                        echo $purchase_items = "Purchase Items";
                                                                    } else {
                                                                        echo $purchase_items = "Purchase Item";
                                                                    } ?>">
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {
                        $cart = $_SESSION['cart_item'];
                        $item_details = "";
                        foreach ($_SESSION["cart_item"] as $item) {
                            $item_details = $item_details . $item["name"] . "," . $item["quantity"] . ",";
                        }
                        $sql = "INSERT INTO order_tbl (order_details,order_total,customer_id,order_status) VALUES ('$item_details','$total_price','$id','pending')";
                        if (mysqli_query($conn, $sql)) {
                            echo "Order Placed";
                        } else {
                            echo "Something went wrong";
                        }
                    }
                    ?>
                <?php
                } else {
                ?>
                    <div class="no-records">Your Cart is Empty</div>
                <?php
                }
                ?>
            </div>

            <div id="product-grid">
                <div class="txt-heading">Products</div>
                <?php
                $sql = "SELECT * FROM item_tbl";
                $result = mysqli_query($conn, $sql);
                if (!empty($result)) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                        <div>
                            <form id='customer-form' method="post" action="customer_dashboard.php?action=add&item_id=<?php echo $rows["item_id"]; ?>">
                                <div>
                                    <div><label for="">Item Name:</label><?php echo $rows["item_name"]; ?></div>
                                    <div><label for="">Item price:</label><?php echo $rows["item_price"]; ?></div>
                                    <div id='customer-form'><label for="">Item Quantity:</label><input type=" text" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" />
                                    </div>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
</body>

</html>