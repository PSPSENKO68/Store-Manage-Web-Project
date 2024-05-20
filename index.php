<?php
include './view/header.php';

?>
<!DOCTYPE html>
<html lang="en">
<title>Home</title>
<link rel="icon" href="./images/logo/icon.png" type="image/x-icon" />
<style>
    main {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        background-color: #ffffff;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 72%;
        margin-top: 50px;
    }

    .sidebar h2 {
        color: grey;
    }

    .menu-items {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        /* Đảm bảo các mục menu phân bổ đều trên hàng */
        gap: 20px;
        /* Khoảng cách giữa các mục */
        margin-top: 150px;
    }

    .menu-item {
        width: 200px;
        height: 200px;
        margin: 10px;
        background-color: rgb(214, 212, 212);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: transform 0.5s;
        perspective: 1000px;
        margin-top: 20px;
    }

    .item-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        backface-visibility: hidden;
    }

    .menu-item a {
        color: #b24fff;
        text-decoration: none;
        font-size: 24px;
    }

    .menu-item:hover {
        transform: translateY(-10px);
        background-color: darkgray;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

    }

    .content {
        margin-left: 20px;
    }

    .fas {
        font-size: 50px;
        color: #b24fff;
    }
</style>

<main>
    <div class="sidebar">
        <div class="menu-items">
            <?php
            if (isset($_SESSION['admin'])) {
                echo '<div class="menu-item">';
                echo '<div class="item-content">';
                echo '<i class="fas fa-user"></i>';
                echo '<a href="user-manager.php">User</a>';
                echo '</div></div>';
            }
            ?>
            <div class="menu-item">
                <div class="item-content">
                    <i class="fas fa-list-alt"></i>
                    <a href="category-manager.php">Category</a>
                </div>
            </div>
            <?php
            if (isset($_SESSION['admin'])) {
                echo '<div class="menu-item">';
                echo '<div class="item-content">';
                echo '<i class="fas fa-users"></i>';
                echo '<a href="customer-manager.php">Customer</a>';
                echo '</div></div>';
            }
            ?>
            <div class="menu-item">
                <div class="item-content">
                    <i class="fas fa-cart-shopping"></i>
                    <a href="Cart.php">Order</a>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-content">
                    <i class="fas fa-chart-simple"></i>
                    <a href="statistics.php">Statistic</a>
                </div>
            </div>
        </div>
    </div>

    <?php include './view/footer.php'; ?>


</main>
<script>
    $(document).ready(function() {
        $(".menu-item").click(function() {
            window.location.href = $(this).find("a").attr("href");
        });
    });
</script>

</html>