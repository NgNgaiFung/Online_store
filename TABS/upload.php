<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/GP/login/database.php");

$errors = array('product_name'=>'', 'product_description'=>'', 'price'=>'', 'condition'=>'', 'delivery'=>'', 'productImage'=>'', 'good'=>'');

if(!isset($_SESSION['user_name'])){
    header("Location: ../login/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if user is logged in
    if (!isset($_SESSION['user_name'])) {
        echo "You must be logged in to upload a product.";
        exit;
    }

    $sellername = $_SESSION['user_name'];
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['price'];
    $productCondition = $_POST['condition'];
    $productMailing = $_POST['mailing'];
    $productMeetup = $_POST['meetup'];
    $productImage = $_FILES['productImage'];

    // Check if product name is empty
    if (empty($productName)) {
        $errors['product_name'] = 'Product name is required.<br>';
    } else {
        // Check if product name is valid
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $productName)) {
            $errors['product_name'] = 'Product name must be letters, spaces, or numbers only.<br>';
        } else {
            // Check if product name is too long
            if (strlen($productName) > 50) {
                $errors['product_name'] = 'Product name must be less than 50 characters.<br>';
            } else {
                $productName = $_POST['product_name'];
            }
        } 
    }

    // Check if product description is empty
    if (empty($productDescription)) {
        $errors['product_description'] = 'Product description is required.<br>';
    } else {
        // Check if product description is valid
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $productDescription)) {
            $errors['product_description'] = 'Product description must be letters, spaces, or numbers only.<br>';
        } else {
            // Check if product description is too long
            if (strlen($productDescription) > 500) {
                $errors['product_description'] = 'Product description must be less than 500 characters.<br>';
            } else {
                $productDescription = $_POST['product_description'];
            }
        }
    }
    
    if (empty($productPrice)) {
        $errors['price'] = 'Price is required.<br>';
    } else {
        if (!preg_match('/^[0-9.]+$/', $productPrice)) {
            $errors['price'] = 'Price must be a number.<br>';
        } else {
            $productPrice = $_POST['price'];
        }
    }

    if (empty($productCondition)) {
        $errors['condition'] = 'Condition is required.<br>';
    } else {
        $productCondition = $_POST['condition'];
    }

    if ($productMeetup == 0 && $productMailing == 0) {
        $errors['delivery'] = 'At least one of meetup or mailing must be selected.<br>';
    } else {
        $productMeetup = $_POST['meetup'];
        $productMailing = $_POST['mailing'];
    }

    if (empty($productImage)) {
        $errors['productImage'] = 'Product image is required.<br>';
    } else {
        $productImage = $_FILES['productImage'];
    }

    $imageFileType = strtolower(pathinfo($productImage["name"], PATHINFO_EXTENSION));
    if ($imageFileType != "jpg") {
        $errors['productImage'] = 'Only JPG files are allowed.<br>';
    }

    if (array_filter($errors)) {
        $error['good'] = "There are errors in the form.";
        mysqli_close($conn);
    } else {

    $targetDir = "../product_images/";

    // Check if directory does not exist and create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Get the seller_id from the users table
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sellername);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $sellerId = $row['id'];

    // Now you can use $sellerId in your insert statement
    $sql = "INSERT INTO products (seller_id, product_name, product_description, price, `condition`, mailing, meetup) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $sellerId, $productName, $productDescription, $productPrice, $productCondition, $productMailing, $productMeetup);
    $stmt->execute();

    // Get the id of the inserted product
    $productId = $conn->insert_id;

    // Construct the filename using the product ID
    $targetFile = $targetDir . "product" . $productId . "." . "jpg";


    if (move_uploaded_file($productImage["tmp_name"], $targetFile)) {
        echo "The file " . basename($productImage["name"]) . " has been uploaded.";
        header("Location: ../main.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
        echo "Error: " . $_FILES["productImage"]["error"];
    }
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Upload</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style>

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-image: url('../images/background2.jpg');
        background-size: cover;
        background-position: center;
    }

    .profile-container {
            background-color: rgb(15, 15, 15, 0.7);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            position: relative; /* added */
            width: 70%; /* added */
            font-size: 1.5em; /* added */
            color : white;
    }

    input {
		color: white;
	}

    textarea{
        color: white;
    }

    </style>
</head>
<body>
    <div class="profile-container">
        <h4>Upload Product</h4>
        <form class="col s12" action="upload.php" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="input-field col s9">
                    <input type="text" id="product_name" name="product_name"><br>
                    <label for="product_name">Product Name</label>
                </div>
                <div class="input-field col s3">
                    <input type="text" id="price" name="price"><br>
                    <label for="price">Product Price</label><br>     
                </div>
            </div>
            <div class="row">
                <div class="col s9">
                    <div class="red-text"><?php echo $errors['product_name']; ?></div>
                </div>
                <div class="col s3">
                    <div class="red-text"><?php echo $errors['price']; ?></div>
                </div>
            </div>

            <div class="input-field">
                <textarea id="product_description" name="product_description" class="materialize-textarea"></textarea>
                <label for="product_description">Product Description:</label>
                <div class="red-text"><?php echo $errors['product_description']; ?></div>
            </div>


            <label for="condition">Condition:</label><br>
            <div class="row">
                <div class="col s2 offset-m1">
                    <label>
                        <input type="radio" name="condition" value="brand new" checked="checked">
                        <span>Brand New</span>
                    </label>
                </div>
                <div class="col s2">
                    <label>
                        <input type="radio" name="condition" value="like new">
                        <span>Like New</span>
                    </label>
                </div>
                <div class="col s2">
                    <label>
                        <input type="radio" name="condition" value="lightly used">
                        <span>Lightly Used</span>
                    </label>
                </div>
                <div class="col s2">
                    <label>
                        <input type="radio" name="condition" value="well used">
                        <span>Well Used</span>
                    </label>
                </div>
                <div class="col s2">
                    <label>
                        <input type="radio" name="condition" value="heavily used">
                        <span>Heavily Used</span>
                    </label>
                </div>
            </div>
            <div class="red-text"><?php echo $errors['condition']; ?></div>

            <div class="row">
                <div class="col s6">
                    <label class for="mailing">mailing:</label><br>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <input type="radio" name="mailing" value="1" checked="checked">
                                <span>Yes</span>
                            </label>
                        </div>
                        <div class="col s6">
                            <label>
                                <input type="radio" name="mailing" value="0">
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col s6">
                    <label class for="meetup">meetup:</label><br>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <input type="radio" name="meetup" value="1" checked="checked">
                                <span>Yes</span>
                            </label>
                        </div>
                        <div class="col s6">
                            <label>
                                <input type="radio" name="meetup" value="0">
                                <span>No</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="red-text"><?php echo $errors['delivery']; ?></div>
            <div class="row">
                <div class="col s3 offset-m3">
                    <p>Upload product image:</p>
                </div>
                <div class="col s3">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" id="productImage" name="productImage">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Please upload your product file">
                        </div>
                    </div>
                    <div class="red-text"><?php echo $errors['productImage']; ?></div>
                </div>
            </div>

            <div class="red-text"><?php echo $errors['good']; ?></div>

            <div class="row">
                <div class="col s5 offset-m1">
                    <a href="../main.php" class="waves-effect waves-light btn">Back</a>
                </div>
                <div class="col s5">
                    <button class="waves-effect waves-light btn" type="submit" name="submit">Upload Product</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>

