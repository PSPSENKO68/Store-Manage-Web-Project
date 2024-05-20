<?php
include ("./database/connection.php");
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ./sign_in.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
    <title>User Information</title>
</head>
<style>
    body {
        background: #de47ff;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }

    .on-status {
        color: green;
    }

    .off-status {
        color: red;
    }

    .upload-btn {
        cursor: pointer;
        background-color: #682773;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .upload-btn:hover {
        background-color: #BA68C8;
    }
</style>

<body>
    <div class="container rounded bg-white my-5 py-3 col-md-10">
        <?php
        $id = $_GET["id"];
        $sql = "SELECT * FROM product where id = '$id' lIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $category_id = $row['category_id'];
        $sql_category = "SELECT * FROM category where id = '$category_id' lIMIT 1";
        $result_category = mysqli_query($conn, $sql_category);
        $row_category = mysqli_fetch_assoc($result_category);
        ?>

        <h3 class="text-center mt-2">Product Information</h3>
        <form action="./api/api-update-product.php?id=<?php echo $row['id'] ?>" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="d-flex flex-column align-items-center text-center col-md-5">
                    <img id="avatar-preview" class="mt-5" width="100%"
                        src="./images/product/<?= $row['avatar'] ?>">
                    <div class="col-md-6">
                        <label for="avatar-upload" class="btn btn-primary mt-3">
                            <i class="fas fa-upload me-1"></i> Choose Image
                        </label>
                        <input type="file" name="image" id="avatar-upload" accept="image/*" class="d-none">
                    </div>
                </div>
                <div class="p-3 py-5 col-md-7">
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">ID</label><input disabled
                                type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>"></div>
                        <div class="col-md-6">
                            <label class="labels" style="font-size: 15px">Category</label>
                            <select class="form-control" name="category_id">
                                <?php
                                // Loop through categories and populate dropdown
                                $category_sql = "SELECT * FROM category";
                                $category_result = mysqli_query($conn, $category_sql);
                                while ($category_row = mysqli_fetch_assoc($category_result)) {
                                    $selected = ($category_row['id'] == $row_category['id']) ? 'selected' : '';
                                    echo "<option value='" . $category_row['id'] . "' $selected>" . $category_row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels" style="font-size: 15px">Product Name:</label><input
                                type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" <?php if (!isset($_SESSION["admin"])){echo 'disabled';}?>></div>
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">Created at:</label><input
                                disabled type="text" class="form-control" name="created_at"
                                value="<?php echo $row['created_at'] ?>"></div>
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">Updated at:</label><input
                                disabled type="text" class="form-control" name="update_at"
                                value="<?php echo $row['updated_at'] ?>"></div>
                        <?php
                            if (isset($_SESSION["admin"])) {
                                echo '<div class="col-md-6"><label class="labels" style="font-size: 15px">Price in:</label><input type="text" class="form-control" name="price_in" value="' . $row["price_in"] . '"></div>';
                            }
                        ?>
                        
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">Price out:</label><input
                                type="text" class="form-control" name="price_out    "
                                value="<?php echo $row['price_out'] ?>" <?php if (!isset($_SESSION["admin"])){echo 'disabled';}?>></div>
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">Quantity:</label><input
                                type="text" class="form-control" name="quantity" value="<?php echo $row['quantity'] ?>" <?php if (!isset($_SESSION["admin"])){echo 'disabled';}?>>
                        </div>
                        <div class="col-md-6"><label class="labels" style="font-size: 15px">Sold:</label><input
                                type="text" class="form-control" name="sold" value="<?php echo $row['sold'] ?>" disabled>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <svg id="barcode"></svg>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mt-5 text-center">
                            <a class="btn btn-danger" href="product-manager.php?id=<?php echo $category_id; ?>">Back</a>
                            <?php if (isset($_SESSION["admin"])){
                                echo '<button class="btn btn-primary " type="submit" name="update">Update Profile</button>';
                            }?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>

</html>

<script>
    document.getElementById('avatar-upload').addEventListener('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    JsBarcode("#barcode", "<?php echo $row['id'] ?>", {
        format: "CODE128",
        width: 4,
        height: 50
    });
</script>