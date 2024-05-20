<?php
session_start();
require 'fpdf/fpdf.php';

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
        $this->Image('images/logo/CELLPHONE X.png', 10, 6, 40);
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
            $this->Cell(50, 10, $item['name'], 1, 0);
            $this->Cell(40, 10, $item['quantity'], 1, 0, 'C');
            $this->Cell(50, 10, '$' . number_format($item['price'], 2), 1, 0, 'R');
            $this->Cell(50, 10, '$' . number_format($item['total'], 2), 1, 1, 'R');
        }
        $this->Ln(10);
    }

    private function setTotal($items)
    {
        // Total
        $total = array_sum(array_column($items, 'total'));
        $this->SetFont(self::FONT_FAMILY, 'B', 12);
        $this->Cell(140, 10, 'Total:', 0, 0, 'R');
        $this->Cell(50, 10, '$' . number_format($total, 2), 0, 1, 'R');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['phone'], $_POST['address']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $pdf = new InvoicePDF();
        $customer_name = $_POST['name'];
        $customer_phone = $_POST['phone'];
        $customer_address = $_POST['address'];

        $customer_name = str_replace(
            array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'),
            $customer_name
        );
        $customer_address = str_replace(
            array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'),
            $customer_address
        );

        // Thêm thời gian vào tên file
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_time_formatted = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $file_name = $order_time_formatted . '' . '_invoice.pdf';
        $file_path = 'invoice/' . $file_name; // Đường dẫn đến thư mục invoice

        $items = $_SESSION['cart'];
        $pdf->createInvoice($customer_name, $customer_phone, $customer_address, $items);

        // Lưu file PDF với tên mới và đường dẫn vào thư mục invoice
        $pdf->Output('F', $file_path);

        // Hiển thị thông báo cho người dùng
        echo "<div style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5); z-index: 9999;'>Hóa đơn đã được in và lưu lại thành công.</div>";

        // Chuyển hướng trang về lại Cart.php sau 2 giây
        header("refresh:2;url=Cart.php");
    } else {
        // Specific error messages
        if (!isset($_POST['name'], $_POST['phone'], $_POST['address'])) {
            echo "Please fill out all required fields.";
        } elseif (empty($_SESSION['cart'])) {
            echo "Your cart is empty.";
        }
    }
} else {
    echo "Invalid request method.";
}
?>