<<?php

if (isset($_POST['submit'])) {

  include_once 'dbh.inc.php';

  $first = mysqli_real_escape_string($conn, $_POST[first]);
  $last = mysqli_real_escape_string($conn, $_POST[last]);
  $email = mysqli_real_escape_string($conn, $_POST[email]);
  $username = mysqli_real_escape_string($conn, $_POST[username]);
  $password = mysqli_real_escape_string($conn, $_POST[password]);

  //Error handlers
  //Check for empty field
  if (empty($first) || empty($last) || empty($email) || empty($username) || empty($password) ) {
        header("Location: ../signup.php?signup=empty");
        exit();
  } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
          header("Location: ../signup.php?signup=invalid");
          exit();
      } else {
          //Check if email is invalid
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              header("Location: ../signup.php?signup=email");
              exit();
          } else {
              $sql = "SELECT * FROM users WHERE user_id='$username'";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck >0 ) {
                  header("Location: ../signup.php?signup=usertaken");
                  exit();
              } else {
                  //Hashing the Password
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  //Insert the user into the database
                  $sql = "INSERT INTO users (user_first, user_last, user_email, user_username, user_password) VALUES ('$first', '$last', '$email', '$username', '$hashedPwd');";
                  mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
              }
          }
      }
  }

} else {
  header("Location: ../signup.php");
  exit();
}
