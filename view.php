<?php
// Include the database configuration file  
include "conn.php";

// Get image data from database 

$sql = ("SELECT item_img FROM item_tbl WHERE item_id = '1'");
$result = mysqli_query($conn, $sql);
?>

<?php if ($result->num_rows > 0) { ?>
    <div class="gallery">
        <?php while ($row = $result->fetch_array()) { ?>
            <img src="data:img/jpg;charset=utf8;base64,<?php echo base64_encode($row['item_img']); ?>" />
        <?php } ?>
    </div>
<?php } else { ?>
    <p class="status error">Image(s) not found...</p>
<?php } ?>