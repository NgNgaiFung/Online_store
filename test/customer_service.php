<?php
	if (isset($_POST["login"])){
		$email = $_POST["email"];
		$password = $_POST["password"];
			require_once "database.php"; //connect to dbase
			$sql = "SELECT * FROM users WHERE email = '$email'"; //match the entered email to the db email
			$result = mysqli_query($conn, $sql);
			$user = mysql_fetch_array($result, MYSQLI_ASSOC); //access column on db
			if ($user){
				if (password_verify($password, $user["password"])){
					session_start();
					$_SESSION["user"] = "yes";
					header("Location: main.php");
					die();
				}else{
					echo "<div class='alert alert-danger'>Uncorrect Password!</div>";
				}					
			}else{
				echo "<div class='alert alert-danger'>Email does not register!</div>";
			}
	}
	?>

<div class="container center-align custom-container" style="margin-top: 50px;">
    <div class="row">
        <h4 class="center">Login</h4>
        <form class="col s12 m10 offset-m1 center-align" action="login_process.php" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate" name="password" required>
                    <label for="password">Password</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="login" value="Login">Login</button>
        </form>
    </div>
</div>;