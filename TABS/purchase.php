<?php
// Include the database connection
include('../login/database.php');

// Check if the asset exists
if (isset($_GET['user_id']) && isset($_GET['seller_id']) && isset($_GET['product_id']) && isset($_GET['user_money']) && isset($_GET['product_price'])) {

    $userID = $_GET['user_id'];

    $sellerID = $_GET['seller_id'];

    $product_id = $_GET['product_id'];
    
    $user_money = $_GET['user_money'];

    $product_price = $_GET['product_price'];

} else {
    header("Location: transaction/fail.php");
}


if (!empty($userID) && !empty($sellerID) && !empty($product_id) && !empty($user_money) && !empty($product_price)) {
    if ($userID != $sellerID){
        if ($product_price < $user_money) {
            $conn->begin_transaction();
            try {
                $upsql = "UPDATE products SET sold = 1 WHERE product_id = $product_id";
                $conn->query($upsql);
                $sql = "INSERT INTO transactions (buyer_id, product_id) VALUES ($userID, $product_id)";
                $conn->query($sql);
                $sql = "UPDATE users SET money = money - $product_price WHERE id = $userID";
                $conn->query($sql);
                $conn->commit();
                header("Location: transaction/successful.php");
                exit();
            } catch (Exception $e) {
                $conn->rollback();
                header("Location: transaction/fail.php");
                exit();
            }
        } else {
            header("Location: transaction/fail.php");
            exit();
        }
    } else {
        header("Location: transaction/fail.php");
        exit();
    }
} else {
    header("Location: transaction/fail.php");
    exit();
}

// Close the connection
mysqli_close($conn);

?>