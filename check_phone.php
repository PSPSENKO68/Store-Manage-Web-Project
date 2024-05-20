<?php
include("database/connection.php");

if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    
    // Thực hiện truy vấn để kiểm tra số điện thoại trong cơ sở dữ liệu
    $sql = "SELECT * FROM customer WHERE phonenumber='$phone'";
    $result = mysqli_query($conn, $sql);

    // Nếu có kết quả, trả về dữ liệu dưới dạng JSON
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response = array("name" => $row['fullname'], "address" => $row['address']);
        echo json_encode($response);
    } else {
        // Nếu không có kết quả, trả về dữ liệu rỗng
        $response = array("name" => "", "address" => "");
        echo json_encode($response);
    }
}
?>
