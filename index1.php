<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="hasslehaltlogo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hasselhalt</title>
  <?php require "./scripts/externel_links.php";?>
  <link href="./styles/login-style.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid px-0">
    <?php 
          include "./components/navbar.php";
          include "./components/login_icons.php";
          include "./components/login_form.php";
    
          ?>
        
  </div>
  <script src="./scripts/aos.js"></script>
  <script src="./scripts/login.js"></script>
</body>

</html>