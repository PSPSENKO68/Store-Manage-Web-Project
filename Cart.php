<?php
include("database/connection.php");
require 'fpdf/fpdf.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: sign_in.php");
    exit();
}

class InvoicePDF extends FPDF
{
    const COMPANY_NAME = "Cellphone X";
    const COMPANY_WEBSITE = "www.cellphonex.com.vn";
    const COMPANY_EMAIL = "invoice@cellphonex.com.vn";
    const COMPANY_TEL = "0839028339";
    const FONT_FAMILY = 'Arial';

    public function __construct()
    {
        parent::__construct();
        $this->AliasNbPages();
        $this->SetTopMargin(20);
    }

    public function Header(): void
    {
        // Logo and company information
        $this->Image('images/logo/logo.png', 10, 6, 40);
        $this->SetFont(self::FONT_FAMILY, 'B', 12);
        $this->SetTextColor(0);
        $this->Cell(0, 10, 'INVOICE', 0, 1, 'C');
        $this->SetFont(self::FONT_FAMILY, '', 10);
        $this->SetTextColor(0, 0, 255);
        $this->Cell(0, 10, self::COMPANY_WEBSITE, 0, 1, 'C');
        $this->Cell(0, 10, self::COMPANY_EMAIL, 0, 1, 'C');
        $this->Cell(0, 10, 'Tel: ' . self::COMPANY_TEL, 0, 1, 'C');
        $this->Ln(10);
    }

    public function Footer()
    {
        // Footer with page number
        $this->SetY(-15);
        $this->SetFont(self::FONT_FAMILY, '', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function createInvoice($customer_name, $customer_phone, $customer_address, $items)
    {
        $this->AddPage();
        $this->setCustomerInfo($customer_name, $customer_phone, $customer_address);
        $this->setItemsTable($items);
        $this->setTotal($items);
    }

    private function setCustomerInfo($name, $phone, $address)
    {
        // Customer information
        $order_time = date('Y-m-d H:i:s');
        $this->SetFont(self::FONT_FAMILY, 'B', 12);
        $this->Cell(0, 10, 'Customer Information', 0, 1);
        $this->SetFont(self::FONT_FAMILY, '', 10);
        $this->Cell(0, 10, 'Name: ' . $name, 0, 1);
        $this->Cell(0, 10, 'Phone: ' . $phone, 0, 1);
        $this->Cell(0, 10, 'Address: ' . $address, 0, 1);
        $this->Cell(0, 10, 'Order Time: ' . $order_time, 0, 1);
        $this->Ln(10);
    }

    private function setItemsTable($items)
    {
        // Table header
        $this->SetFont(self::FONT_FAMILY, 'B', 10);
        $this->Cell(50, 10, 'Product', 1, 0, 'C');
        $this->Cell(40, 10, 'Quantity', 1, 0, 'C');
        $this->Cell(50, 10, 'Price', 1, 0, 'C');
        $this->Cell(50, 10, 'Total', 1, 1, 'C');

        // Table content
        $this->SetFont(self::FONT_FAMILY, '', 10);
        foreach ($items as $item) {
            $this->Cell(50, 10, $item['item_name'], 1, 0);
            $this->Cell(40, 10, $item['item_quantity'], 1, 0, 'C');
            $this->Cell(50, 10, '$' . number_format($item['product_price'], 2), 1, 0, 'R');
            $this->Cell(50, 10, '$' . number_format($item['item_quantity'] * $item['product_price'], 2), 1, 1, 'R');
        }
        $this->Ln(10);
    }

    private function setTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['item_quantity'] * $item['product_price'];
        }
        $this->SetFont(self::FONT_FAMILY, 'B', 12);
        $this->Cell(140, 10, 'Total:', 0, 0, 'R');
        $this->Cell(50, 10, '$' . number_format($total, 2), 0, 1, 'R');
    }
}

// if (isset($_POST["add"])) {
//     $id = $_GET["id"];
//     $query = "SELECT * FROM product WHERE id = $id";
//     $result = mysqli_query($conn, $query);

//     if (mysqli_num_rows($result) == 0) {
//         exit;
//     }
//     $row = mysqli_fetch_assoc($result);

//     $item_array = array(
//         'product_id' => $row["id"],
//         'item_name' => $row["name"],
//         'product_price' => $row["price_out"],
//         'item_quantity' => 1,
//         'cost' => $row["price_in"],
//     );

//     if (isset($_SESSION["cart"])) {
//         if (array_key_exists($id, $_SESSION["cart"])) {
//             $_SESSION["cart"][$id]["item_quantity"] += 1;
//         } else {
//             $_SESSION["cart"][$id] = $item_array;
//         }
//     } else {
//         $_SESSION["cart"] = array($id => $item_array);
//     }

//     header("Location: Cart.php");
// }


// if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
//     $id = $_GET["id"];
//     if (isset($_SESSION["cart"])) {
//         $cart_items = $_SESSION["cart"];
//         if (array_key_exists($id, $cart_items)) {
//             unset($cart_items[$id]);
//             $_SESSION["cart"] = $cart_items;
//         }
//     }
//     header("Location: Cart.php");
//     exit;
// }

// if (isset($_GET["action"]) && $_GET["action"] == "increases" && isset($_GET["id"])) {
//     $id = $_GET["id"];
//     if (isset($_SESSION["cart"])) {
//         $cart_items = $_SESSION["cart"];
//         if (array_key_exists($id, $cart_items)) {
//             $cart_items[$id]["item_quantity"] += 1;
//             $_SESSION["cart"] = $cart_items;
//         }
//     }
//     header("Location: Cart.php");
//     exit;
// }

// if (isset($_GET["action"]) && $_GET["action"] == "decreases" && isset($_GET["id"])) {
//     $id = $_GET["id"];
//     if (isset($_SESSION["cart"])) {
//         $cart_items = $_SESSION["cart"];
//         if (array_key_exists($id, $cart_items)) {
//             $cart_items[$id]["item_quantity"] -= 1;
//             if ($cart_items[$id]["item_quantity"] <= 0) {
//                 unset($cart_items[$id]);
//             }
//             $_SESSION["cart"] = $cart_items;
//         }
//     }
//     header("Location: Cart.php");
//     exit;
// }

if (isset($_POST["show"])){
    $phone = $_POST['phone'];
    $sql = "SELECT * FROM customer WHERE phonenumber = '$phone' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['id'];
        echo "<script>";
        echo "window.open('order-manager.php?id=" . $customer_id . "', '_blank')";
        echo "</script>";        
    }
    
}

if (isset($_POST["pay"])) {

    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $moneyIn = $_POST['moneyIn'];
    $moneyOut = $_POST['moneyOut'];
    $order_date = date('Y-m-d H:i:s');
    $total_all_items_price = 0;
    $total_all_item_quantity = 0;
    $cost = 0;

    if (isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $value) {
            $item_name = isset($value["item_name"]) ? $value["item_name"] : "";
            $item_quantity = isset($value["item_quantity"]) ? $value["item_quantity"] : 0;
            $product_price = isset($value["product_price"]) ? $value["product_price"] : 0;
            $total_price = $item_quantity * $product_price;
            $total_all_items_price += $total_price;
            $total_all_item_quantity += $item_quantity;
            $cost += $value["cost"] * $item_quantity;
        }

        $sql = "SELECT * FROM customer WHERE phonenumber = '$phone' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $customer_id = $row['id'];
        } else {
            $sql_insert = "INSERT INTO customer (phonenumber, fullname, address) VALUES ('$phone', '$name', '$address')";
            $result_insert = mysqli_query($conn, $sql_insert);
            $customer_id = mysqli_insert_id($conn);
        }

        $insert_order_history = "INSERT INTO order_history (customer_id, totalmoney, quantity, order_date, money_in, money_out, cost) VALUES ('$customer_id', '$total_all_items_price', '$total_all_item_quantity', '$order_date', '$moneyIn', '$moneyOut', '$cost')";
        $result_insert = mysqli_query($conn, $insert_order_history);
        $order_id = mysqli_insert_id($conn);

        if ($result_insert) {
            if (isset($_SESSION["cart"])) {
                foreach ($_SESSION["cart"] as $key => $value) {
                    $product_id = $value["product_id"];
                    $quantity = $value["item_quantity"];
                    $price = $value["product_price"];
                    $total_price = $quantity * $price;

                    $update_product = "UPDATE product SET quantity = quantity - $quantity, sold = sold + $quantity WHERE id = $product_id";
                    $result_update = mysqli_query($conn, $update_product);

                    $insert_order_detail = "INSERT INTO order_details (order_id, product_id, num, price, total_money) VALUES ('$order_id', '$product_id', '$quantity', '$price', '$total_price')";
                    $result_insert = mysqli_query($conn, $insert_order_detail);
                }
            }
        }
    }


    if (isset($_POST['name'], $_POST['phone'], $_POST['address']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $pdf = new InvoicePDF();
        $customer_name = $_POST['name'];
        $customer_phone = $_POST['phone'];
        $customer_address = $_POST['address'];

        $customer_name = str_replace(
            array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'A', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Đ', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'D', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'Y', 'Y', 'Y', 'Y', 'Y'),
            $customer_name
        );
        $customer_address = str_replace(
            array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'A', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Đ', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'D', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'Y', 'Y', 'Y', 'Y', 'Y'),
            $customer_address
        );

        // Thêm thời gian vào tên file
        $order_time_formatted = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $file_name = $customer_id . '_' . $order_time_formatted . '_invoice.pdf';

        // Lưu file PDF vào database 
        $update_invoice_query = "UPDATE order_history SET invoice = '$file_name' WHERE id = '$order_id'";
        $result_update_invoice = mysqli_query($conn, $update_invoice_query);

        // Lưu file PDF với tên mới và đường dẫn vào thư mục invoice
        $items = $_SESSION['cart'];
        $pdf->createInvoice($customer_name, $customer_phone, $customer_address, $items);
        $pdf->Output('F', 'invoice/' . $file_name);
    } else {
        if (!isset($_POST['name'], $_POST['phone'], $_POST['address'])) {
            echo "Please fill out all required fields.";
        } elseif (empty($_SESSION['cart'])) {
            echo "Your cart is empty.";
        }
    }

    sleep(5);
    unset($_SESSION["cart"]);
}
?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .custom-card-img {
            width: 190px;
            height: 150px;
            padding: 10px;
        }

        .card-title {
            word-wrap: break-word;
        }

        .card {
            background-color: aliceblue;
            width: 190px;
            border-radius: 5px;
            transition: transform .2s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            /* background-color: #43cac2; */
            margin-top: 30px ;
            
        }

        table,
        th,
        tr,
        td {
            text-align: center;
            vertical-align: middle;
        }

        #customerFormContainer {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            background-color: white;
            padding-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 70%;
            max-width: 600px;
            max-height: 80%;
            overflow-y: auto;
        }

        .swal2-container {
            z-index: 3;
        }

        .card-deck {
            max-height: 400px;
            overflow-y: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-height: 400px;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="row">

        <div class="col-lg-7 text-center border">
            <h2>Item List</h2>
            <div class="col-lg-6">
                <div class="mb-3">
                    <a class="btn btn-secondary " href="index.php" style="float: left; margin-right: 10px; margin-bottom: 10px;">Back</a>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                        <input class="form-control form-input" type="text" name="search_term" id="search_term" placeholder="Search for a product" onkeyup="liveSearch(this.value)">
                        <span class="input-group-text"><a href="scan_barcode.php" name="barcode" type="button" class="scan-button"><i class="fa-solid fa-barcode"></i></a></span>
                    </div>


                </div>
            </div>

            <div class="card-deck mx-auto col-lg-12">
                <?php
                $query = "SELECT * FROM product ORDER BY id ASC ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <form id="product" method="post" action="Cart_add.php?action=add&id=<?php echo $row["id"]; ?>">
                            <div class="card mt-3">
                                <img class="card-img-top custom-card-img" src="./images/product/<?= $row["avatar"]; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                                    <h6 class="card-text text-danger">Price: <?php echo $row["price_out"]; ?>$</h6>
                                    <h6 class="card-text text-primary">Quantity: <?php echo $row["quantity"]; ?></h6>
                                </div>
                                <div class="card-footer text-center">
                                    <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success " value="Add">
                                </div>
                            </div>
                        </form>

                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-lg-5 mx-auto ">
            <h2 class="title2">Shopping Cart</h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered ">
                    <thead class="thead text-center">
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove Item</th>
                    </thead>
                    <?php
                    $total_all_items_price = 0;
                    $total_all_item_quantity = 0;
                    if (isset($_SESSION["cart"])) {
                        foreach ($_SESSION["cart"] as $key => $value) {
                            $item_name = isset($value["item_name"]) ? $value["item_name"] : "";
                            $item_quantity = isset($value["item_quantity"]) ? $value["item_quantity"] : 0;
                            $product_price = isset($value["product_price"]) ? $value["product_price"] : 0;
                            $total_price = $item_quantity * $product_price;
                            $total_all_items_price += $total_price;
                            $total_all_item_quantity += $item_quantity;
                    ?>
                            <tbody>
                                <td><?php echo $value["item_name"]; ?></td>
                                <td><?php echo $value["product_price"]; ?>$</td>
                                <td>
                                    <a href="Cart_decreases.php?action=decreases&id=<?php echo $value["product_id"]; ?>" class="quantity-btn"><i class="fa-solid fa-minus"></i></a>
                                    <span class="quantity"><?php echo $value["item_quantity"]; ?></span>
                                    <a href="Cart_increases.php?action=increases&id=<?php echo $value["product_id"]; ?>" class="quantity-btn"><i class="fa-solid fa-plus"></i></a>
                                </td>
                                <td><?php echo $total_price; ?>$</td>
                                <td><a class="" href="Cart_delete.php?action=delete&id=<?php echo $value["product_id"]; ?>"><i class="fa-solid fa-trash" style="font-size: 24px; color:red"></i></a></td>
                            </tbody>
                    <?php
                        }
                    }
                    ?>
                    <tfoot>
                        <th colspan="2">Total price</th>
                        <th><?php echo $total_all_item_quantity; ?></th>
                        <th><?php echo $total_all_items_price; ?>$</th>
                        <td></td>
                    </tfoot>
                </table>
                <button id="confirmButton" type="button" class="btn btn-primary" name="confirm">Confirm Order</button>
            </div>
        </div>

        <div id="customerFormContainer" style="display: none; background-color:#c8c8c8" class="container mt-3 col-lg-6">
            <h2 class="text-center">Nhập Thông Tin Khách Hàng</h2>
            <form id="customerForm" action="" method="POST">
                <div class="form-group col-lg-12">
                    <label for="phone">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group col-lg-12">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group col-lg-12">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="row col-lg-12">
                    <div class="form-group col-lg-6">
                        <label for="address">Money in:</label>
                        <input type="text" class="form-control" id="moneyIn" name="moneyIn" placeholder="Enter money">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="address">Money out:</label>
                        <input type="text" class="form-control" id="moneyOut" name="moneyOut" placeholder="Money out" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pay-btn" name="pay">Pay</button>
                <button id="backButton" class="btn btn-secondary">Back</button>
                <button type="submit" class="btn btn-primary" id="showInvoiceButton" name="show">Show Invoices</button>
            </form>
        </div>


        
    </div>

</body>
<script>
    $(document).ready(function() {
        var maxHeight = 0;
        $('.card').each(function() {
            var currentHeight = $(this).height();
            if (currentHeight > maxHeight) {
                maxHeight = currentHeight;
            }
        });
        $('.card').height(maxHeight);

        $('#phone').on('input', function() {
            var phone = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'check_phone.php',
                data: {
                    phone: phone
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#name').val(data.name);
                    $('#address').val(data.address);
                }
            });
        });

        $('#confirmButton').click(function() {
            $('#customerFormContainer').show();
        });

        $('#backButton').click(function() {
            $('#customerFormContainer').hide();
        });

        $('#moneyIn').keyup(function() {
            var moneyIn = parseFloat($(this).val());
            var totalAllItemsPrice = <?php echo $total_all_items_price; ?>;

            if (!isNaN(moneyIn)) {
                var moneyOut = moneyIn - totalAllItemsPrice;
                $('#moneyOut').val(moneyOut);
            }
        });

        $('#customerForm').submit(function(event) {
            var $submitButton = $(document.activeElement); // Lấy nút mà đã kích hoạt sự kiện submit
            if (!$submitButton.hasClass('pay-btn')) { // Kiểm tra xem nút đó có thuộc lớp 'pay-btn' hay không
                return; // Nếu không, không làm gì cả
            }

            var moneyIn = $('#moneyIn').val(); // Lấy giá trị của moneyIn
            if (moneyIn === null || moneyIn.trim() === '') { // Kiểm tra nếu moneyIn là null hoặc chuỗi trống
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter the amount of money.'
                }).then(function() {
                    $('.swal2-container').insertAfter($('#customerForm'));
                });
                event.preventDefault();
                return; // Dừng lại ở đây nếu moneyIn không hợp lệ
            }

            var moneyInFloat = parseFloat(moneyIn);
            var totalAllItemsPrice = parseFloat(<?php echo $total_all_items_price; ?>);

            if (moneyInFloat <= 0 || moneyInFloat < totalAllItemsPrice) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Money in is invalid. Please enter a valid amount.'
                }).then(function() {
                    $('.swal2-container').insertAfter($('#customerForm'));
                });
                event.preventDefault();
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful',
                    text: 'Thank you for your payment!',
                    confirmButtonText: 'OK',
                }).then(function() {
                    $('.swal2-container').insertAfter($('#customerForm'));
                    setTimeout(function() {
                        window.location.href = 'Cart.php';
                    });
                });
            }
        });

    });

    function liveSearch(value) {
        $.ajax({
            type: "POST",
            url: "live_search.php",
            data: {
                search_term: value
            },
            success: function(data) {
                $('.card-deck').html(data);
            }
        });
    }
</script>

</html>