<?php
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location:../login/login.php");
}

include('../login/database.php');

// Assuming you have a database connection in a variable $conn
$user_name = $_SESSION['user_name'];

// Fetch user information
$query = "SELECT id, first_name, last_name, username, email, phone_number, `money` FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM products WHERE product_id = $id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if(isset($product['seller_id'])){
    $sellerId = $product['seller_id'];
    $sql = "SELECT * FROM users WHERE id = $sellerId";
    $result = mysqli_query($conn, $sql);
    $seller = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Product description</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>

    <style>

    body {
        height: 100vh;
        width: 100%;
        background-image: url("../images/background3.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        align-item: center;
    }

    .main-custom-container {
        padding: 20px;
        max-width: 80%;
        margin: 0 auto;
        width: 80%;
        background-color: white;
    }

    .product-image {
        display: block;
        margin: 0 auto;
        object-fit: cover;
        width: 450px;
        height: 450px;
    }

    .description {
        font size: 10px;
        font-weight: bold;
        text-decoration: underline;
    }

    .des-custom-container{
        padding: 20px;
        max-width: 80%;
        margin: 0 auto;
        height: 100%;
        width: 80%;
    }

    h5 {
        font size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }

    </style>
</head>

<body>
    <div class="container main-custom-container">
        <img class="materialboxed product-image" src="../product_images/product<?php echo htmlspecialchars($product['product_id']); ?>.jpg">
        <div class="row">
            <div class="col s4 offset-m2">
                <h5><?php echo htmlspecialchars($product['product_name']); ?></h5>
                <p><?php echo htmlspecialchars($product['product_description']); ?></p>
                <p>Price: HK$<?php echo htmlspecialchars($product['price']); ?></p>
                <div class="row">
                    <div class="col s4 offset-m2 card-action left-align">
                        <button class="btn waves-effect waves-light" type="submit" name="Purchase" value="Purchase" 
                        onclick="window.location.href='purchase.php?user_id=<?php echo htmlspecialchars($user['id']); ?>&product_id=<?php echo htmlspecialchars($product['product_id']); ?>&seller_id=<?php echo htmlspecialchars($seller['id']); ?>&product_price=<?php echo htmlspecialchars($product['price']); ?>&user_money=<?php echo htmlspecialchars($user['money']); ?>'">Purchase</button>
                    </div>
                    <div class="col s4 card-action right-align">
                        <button class="btn waves-effect grey lighten-1" type="submit" name="Home" value="Home" onclick="window.location.href='../main.php'">Back</button>
                    </div>
                </div>
            </div>
            <div class="col s4">
                <h5>Seller</h5>
                <table>
                    <thead>
                        <tr>
                            <td>Name: </td>
                            <td><?php echo htmlspecialchars($seller['first_name']) . " " . htmlspecialchars($seller['last_name']); ?><span style="font-size: 12px; color: gray">@<?php echo htmlspecialchars($seller['username'])?></span></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><?php echo htmlspecialchars($seller['email']); ?></td>
                        </tr>
                        <tr>
                            <td>Phone number: </td>
                            <td><?php echo htmlspecialchars($seller['phone_number']); ?></td>
                        </tr>
                    </thead>
                </table>
                <h5>Details</h5>
                <table>
                    <tr>
                        <td>Condition: </td>
                        <td><?php echo htmlspecialchars($product['condition']); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery method: </td>
                        <td><?php   if($product['meetup'] == 1) { echo "Meetup"; }
                                    if($product['meetup'] == 1 and $product['mailing'] == 1) { echo ", "; }
                                    if($product['mailing'] == 1) { echo "Mailing"; }
                        ?></td>
                    </tr>
                </table>
            </div>
        </div>
     </div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.materialboxed');
        var instances = M.Materialbox.init(elems);
    });
</script>

</html>