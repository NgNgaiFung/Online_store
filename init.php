<?php

$hostName = "localhost";
$dbUser = "admin";
$dbPassword = "12345";
$dbName = "login_register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$conn){
	die("Something went wrong, code錯，應該係上面有問題，例如dbname寫錯;");
}


// Drop table if it exists

$sql = "DROP TABLE IF EXISTS `product_images`";

if ($conn->query($sql) === TRUE) {
	echo "Table dropped successfully [DROP]";
} else {
	echo "Error dropping table: " . $conn->error;
}

$sql = "DROP TABLE IF EXISTS `transactions`";

if ($conn->query($sql) === TRUE) {
	echo "Table dropped successfully [DROP]";
} else {
	echo "Error dropping table: " . $conn->error;
}

$sql = "DROP TABLE IF EXISTS `products`";

if ($conn->query($sql) === TRUE) {
	echo "Table dropped successfully [DROP]";
} else {
	echo "Error dropping table: " . $conn->error;
}

$sql = "DROP TABLE IF EXISTS `users`";

if ($conn->query($sql) === TRUE) {
	echo "Table dropped successfully [DROP]";
} else {
	echo "Error dropping table: " . $conn->error;
}

?>

<?php
// Create a new table
$sql = "
CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(50) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(100) NOT NULL,
	`first_name` varchar(50) NOT NULL,
	`last_name` varchar(50) NOT NULL,
	`phone_number` varchar(20) NOT NULL,
	`money` DECIMAL(10, 2) NOT NULL DEFAULT 0,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
";

if ($conn->query($sql) === TRUE) {
	echo "Table created successfully [CREATE]";
} else {
	echo "Error creating table: " . $conn->error;
}

// Reset auto increment value
$sql = "ALTER TABLE `users` AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
	echo "Auto increment reset successfully [RESET AUTO_INCREMENT]";
} else {
	echo "Error resetting auto increment: " . $conn->error;
}

// Generate three test data
$testData = [
    ['username' => 'user1', 'password' => password_hash('pass1', PASSWORD_DEFAULT), 'email' => 'user1@example.com', 'first_name' => 'John', 'last_name' => 'Doe', 'phone_number' => '1234567890', 'money' => 100.00],
    ['username' => 'user2', 'password' => password_hash('pass2', PASSWORD_DEFAULT), 'email' => 'user2@example.com', 'first_name' => 'Jane', 'last_name' => 'Smith', 'phone_number' => '9876543210', 'money' => 250.50],
    ['username' => 'user3', 'password' => password_hash('pass3', PASSWORD_DEFAULT), 'email' => 'user3@example.com', 'first_name' => 'Mike', 'last_name' => 'Johnson', 'phone_number' => '5555555555', 'money' => 50.75],
    ['username' => 'user4', 'password' => password_hash('pass4', PASSWORD_DEFAULT), 'email' => 'user4@example.com', 'first_name' => 'Sarah', 'last_name' => 'Wilson', 'phone_number' => '1111111111', 'money' => 0.00],
    ['username' => 'user5', 'password' => password_hash('pass5', PASSWORD_DEFAULT), 'email' => 'user5@example.com', 'first_name' => 'David', 'last_name' => 'Brown', 'phone_number' => '2222222222', 'money' => 0.00],
    ['username' => 'user6', 'password' => password_hash('pass6', PASSWORD_DEFAULT), 'email' => 'user6@example.com', 'first_name' => 'Emily', 'last_name' => 'Miller', 'phone_number' => '3333333333', 'money' => 0.00],
    ['username' => 'user7', 'password' => password_hash('pass7', PASSWORD_DEFAULT), 'email' => 'user7@example.com', 'first_name' => 'Michael', 'last_name' => 'Taylor', 'phone_number' => '4444444444', 'money' => 0.00],
    ['username' => 'user8', 'password' => password_hash('pass8', PASSWORD_DEFAULT), 'email' => 'user8@example.com', 'first_name' => 'Jessica', 'last_name' => 'Anderson', 'phone_number' => '6666666666', 'money' => 0.00],
    ['username' => 'user9', 'password' => password_hash('pass9', PASSWORD_DEFAULT), 'email' => 'user9@example.com', 'first_name' => 'Brian', 'last_name' => 'Clark', 'phone_number' => '7777777777', 'money' => 0.00],
    ['username' => 'user10', 'password' => password_hash('pass10', PASSWORD_DEFAULT), 'email' => 'user10@example.com', 'first_name' => 'Karen', 'last_name' => 'White', 'phone_number' => '8888888888', 'money' => 0.00],
    ['username' => 'user11', 'password' => password_hash('pass11', PASSWORD_DEFAULT), 'email' => 'user11@example.com', 'first_name' => 'Steven', 'last_name' => 'Turner', 'phone_number' => '9999999999', 'money' => 0.00]
];

foreach ($testData as $data) {
	$username = $data['username'];
	$password = $data['password'];
	$email = $data['email'];
	$first_name = $data['first_name'];
	$last_name = $data['last_name'];
	$phone_number = $data['phone_number'];

	$sql = "INSERT INTO `users` (`username`, `password`, `email`, `first_name`, `last_name`, `phone_number`) 
			VALUES ('$username', '$password', '$email', '$first_name', '$last_name', '$phone_number')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully [INSERT]";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

<?php

// Create a new table for products
$sql = "
CREATE TABLE IF NOT EXISTS `products` (
	`product_id` int(11) NOT NULL AUTO_INCREMENT,
	`product_name` varchar(100) NOT NULL,
	`product_description` varchar(255) NOT NULL,
	`price` decimal(10,2) NOT NULL,
	`seller_id` int(11) NOT NULL,
	`condition` ENUM('brand new', 'like new', 'lightly used', 'well used', 'heavily used') NOT NULL,
	`mailing` tinyint(1) NOT NULL DEFAULT 0,
	`meetup` tinyint(1) NOT NULL DEFAULT 0,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`sold` tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`product_id`),
	FOREIGN KEY (`seller_id`) REFERENCES `users`(`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";

if ($conn->query($sql) === TRUE) {
	echo "Product table created successfully for products [Product]";
} else {
	echo "Error creating product table for products: " . $conn->error;
}

// Reset auto increment value
$sql = "ALTER TABLE `products` AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
	echo "Auto increment reset successfully [RESET AUTO_INCREMENT]";
} else {
	echo "Error resetting auto increment: " . $conn->error;
}

// Generate three test data for products
$testData = [
	['product_name' => 'iPhone 12 Pro 512gb Pacific Blue', 'product_description' => 
	'Purchased from Apple store (with email purchase receipt)
	<br>Comes with box and charging cable
	<br>All original and operating normally
	<br>Battery health: 85%', 
	'price' => 3700, 'seller_id' => 1, 'condition' => 'brand new', 'mailing' => 1, 'meetup' => 0],
	
	['product_name' => 'CHANEL MINI CF FLAP 20CM MINI 20 CF20', 'product_description' => 
	'Brand new in stock 
	<br>Lambskin
	<br>Black Black▫️Light gold buckle Gold HW
	<br>Size: 12 × 20 × 6 cm
	<br>The latest metal chip
	<br>
	<br>100% New and Authentic
	<br>Purchased from specialized store▫️Full set delivery
	<br>Counter list ▫️ Gift box ▫️ Dust bag ▫️ Paper bag
	<br>
	<br>Welcome to inquire with INBOX
	<br>Welcome to INBOX us for any enquiries', 
	'price' => 47800, 'seller_id' => 2, 'condition' => 'lightly used', 'mailing' => 0, 'meetup' => 1],
	
	['product_name' => 'Switch 95% new', 'product_description' => 
	'After using it several times, there are some cracks in the lower right <br>corner of the protective film.
	<br>Contain a Gundam game
	<br>Complete package plus 128gb card', 
	'price' => 1300, 'seller_id' => 5, 'condition' => 'well used', 'mailing' => 1, 'meetup' => 1],
	
	['product_name' => 'MacBook Pro 13-inch 2020', 'product_description' =>
	'Purchased from Apple store (with email purchase receipt)
	<br>Comes with box and charging cable
	<br>All original and operating normally
	<br>Battery health: 85%',
	'price' => 7800, 'seller_id' => 4, 'condition' => 'lightly used', 'mailing' => 0, 'meetup' => 1],

	['product_name' => 'Nintendo Switch', 'product_description' =>
	'After using it several times, there are some cracks in the lower right corner of the protective film.
	<br>Contain a Gundam game
	<br>Complete package plus 128gb card',
	'price' => 1300, 'seller_id' => 6, 'condition' => 'well used', 'mailing' => 1, 'meetup' => 1],

	['product_name' => 'Apple Watch Series 6', 'product_description' =>
	'Purchased from Apple store (with email purchase receipt)
	<br>Comes with box and charging cable
	<br>All original and operating normally
	<br>Battery health: 85%',
	'price' => 5400, 'seller_id' => 7, 'condition' => 'lightly used', 'mailing' => 0, 'meetup' => 1],

	['product_name' => 'AirPods Pro', 'product_description' =>
	'brand new in stock',
	'price' => 1300, 'seller_id' => 8, 'condition' => 'well used', 'mailing' => 1, 'meetup' => 1],

];

// The line breaks in the text area are linebreak characters such as \n. 
// These are not rendered in HTML 
// and thus they won't show up if you simply echo the output. 
// You can echo inside of a <textarea> or a <pre> tag 
// or you can use the nl2br() to replace new lines with <br> tags 
// so that it can be displayed as HTML.

foreach ($testData as $data) {
	$product_name = $data['product_name'];
	$product_description = $data['product_description'];
	$price = $data['price'];
	$seller_id = $data['seller_id'];
	$condition = $data['condition'];
	$mailing = $data['mailing'];
	$meetup = $data['meetup'];

	$sql = "INSERT INTO `products` (`product_name`, `product_description`, `price`, `seller_id`, `condition`, `mailing`, `meetup`) VALUES ('$product_name', '$product_description', $price, $seller_id, '$condition', $mailing, $meetup)";

	if ($conn->query($sql) === TRUE) {
		echo "New product record created successfully [INSERT]";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

<?php

$sql = "
CREATE TABLE IF NOT EXISTS `transactions` (
	`transaction_id` int(11) NOT NULL AUTO_INCREMENT,
	`product_id` int(11) NOT NULL,
	`buyer_id` int(11) NOT NULL,
	`sell_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`transaction_id`),
	FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`),
	FOREIGN KEY (`buyer_id`) REFERENCES `users`(`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";

if ($conn->query($sql) === TRUE) {
	echo "Transaction table created successfully [Transaction]";
} else {
	echo "Error creating transaction table: " . $conn->error;
}

// Reset auto increment value
$sql = "ALTER TABLE `transactions` AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
	echo "Auto increment reset successfully [RESET AUTO_INCREMENT]";
} else {
	echo "Error resetting auto increment: " . $conn->error;
}

?>