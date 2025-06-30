<?php
include('dbcon.php');

// Get the data from the AJAX request
$username = $_POST["username"];
$password = $_POST["password"];


// Get the user data from the Firebase database
$reference = $database->getReference("users")->orderByChild("user")->equalTo($username);
$value = $reference->getValue();

if (!empty($value)) {
  // Log the user in
  foreach ($value as $key => $user) {
    if ($user["pass"] === $password) {
      
      echo "success";
      exit;
    }
  }
}

// Handle errors
echo "Incorrect email or password";
?>
