<?php
include "conn.php";
if (($open = fopen("C:\Users\arman\OneDrive\Desktop\us-500\us-500.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($open, ",")) !== FALSE) {
        $array[] = $data;
    }

    fclose($open);
}
// for ($i = 0; $i < sizeof($array); $i++) {
//     $random = rand(10, 999);
//     $id = $array[$i][0] . $random;
//     $name = $array[$i][0] . " " . $array[$i][1];
//     $address = $array[$i][3];
//     $contact = $array[$i][8];
//     $email = $array[$i][10];
//     // $str = $id . "," . $name . "," . $address . "," . $contact . "," . $email;
//     // array_push($myData, $str);
//     $sql = "INSERT INTO customer (customer_id,customer_name,address,contact,email) VALUES ('$id',
//     '$name','$address','$contact','$email')";

//     mysqli_query($conn, $sql);
// }
