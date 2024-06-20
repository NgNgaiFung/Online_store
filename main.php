<?php
session_start();
if(!isset($_SESSION['user_name'])){
	header("Location:login/login.php");
 }

?> 
<!DOCTYPE html>
<html lang="en">

<!-- head part -->
<head>
<meta charset="utf-8">
	<title>Carousell</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<style>
  .btn{
    font-weight: bold;
  }
  .center-logo {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
  }
  
  .brand-logo {
    margin-left: 20px;
    font-weight: bold;
  }

</style>

<body>
<!-- header part -->

<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Carousell</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="login/logout.php" class="waves-effect waves-light btn">logout</a></li>
        <li><a href="login/profile.php" class="waves-effect waves-light btn green accent-4">Profile</a></li>
      </ul>
      <span class="center-logo">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a href="#Home" class="active">Home</a></li>
        <li class="tab"><a href="#Product">Product</a></li>
        <li class="tab"><a href="#Customer">Customer Service</a></li>
        <li class="tab"><a href="#ask">Frequently ask</a></li>
      </ul>
    </div>
</nav>

<div id="Home"><?php include 'TABS/home.php';?></div>
<div id="Product"><?php include 'TABS/Product.php';?></div>
<div id="Customer"><?php include 'TABS/customer.php';?></div>
<div id="ask"><?php include 'TABS/ask.php';?></div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('.tabs');
    M.Tabs.init(tabs);
  });
</script>

<div class="fixed-action-btn">
  <a class="btn-floating btn-large waves-effect waves-light red" onclick="location.href='TABS/upload.php'">
    <i class="material-icons">add</i>
  </a>
</div>

</body>

<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Carosell</h5>
        <p class="grey-text text-lighten-4">Carousell is a Singaporean smartphone and web-based consumer to consumer and business to consumer marketplace for buying and selling new and secondhand goods. Headquartered in Singapore, it also operates in Malaysia, Indonesia, the Philippines, Cambodia, Taiwan, Hong Kong, Macau, Australia, New Zealand and Canada. Carousell is available on both iOS and Android devices.</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Links</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="#!">FaceBook</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Youtube</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © 2024 Ng Ngai Fung, Tam Yuk Sum
    </div>
  </div>
</footer>

</html> 
