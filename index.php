<!DOCTYPE HTML>  
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Blue Contact Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Titan+One|Ubuntu" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="style.css" />
</head>
<body>  

<?php
$to = 'your@email.com';
$subject = 'Contact Form';

$firstNameErr = $lastNameErr = $emailErr = "";
$firstName = $lastName = $email = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstName"])) {
    $firstNameErr = "*";
  } else {
    $firstName = test_input($_POST["firstName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["lastName"])) {
    $lastNameErr = "*";
  } else {
    $lastName = test_input($_POST["lastName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
      $lastNameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "*";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

mail($to, $subject, $message, "From:".$email);
?>

<div class="container">
<h2 class="col-12">Contact Us</h2>

<div class="col-12 form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <span class="error"><?php echo $firstNameErr;?></span>
  <input type="text" name="firstName" value="<?php echo $firstName;?>" placeholder="First Name" required>
  <br><br>
  <span class="error"><?php echo $lastNameErr;?></span>
  <input type="text" name="lastName" value="<?php echo $lastName;?>" placeholder="Last Name" required>
  <br><br>
  <span class="error"><?php echo $emailErr;?></span>
  <input type="text" name="email" value="<?php echo $email;?>" placeholder="Email" required>
  <br><br>
  <textarea name="message" rows="6" placeholder=" Message "><?php echo $message;?></textarea>
  <br><br>
</div> 
<div class="col-12 submit">
  <input type="submit" name="submit" value="Submit" id="button"> 
</div> 
<p>or</p>
<div class="social-media">
  <a href=""><button type="button"><i class="fa fa-facebook-f"></i></button></a>
  <a href=""><button type="button"><i class="fa fa-twitter"></i></button></a>
  <a href=""><button type="button"><i class="fa fa-google-plus"></i></button></a>
</div> 
</form>
</div>

</body>
</html>