<?php
  require "partials/_db_connection.php";
  $showError = false;
  $showSuccess = false;
  $showWarning = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['submit']))
    {
      
      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_password = $_POST['user_password'];
      $user_C_password = $_POST['user_C_password'];

      if(!(isset($user_name) || isset($user_email) || isset($user_password) || isset($user_C_password)))
      {
        $showWarning = "All fields are Required at the time of Sign-Up";
      }
      else
      {
        
        $sql = "SELECT * FROM `users` WHERE `username`='$user_name' ";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 1)
        {
          $showError = "Username already taken";
        }
        else
        {
          if($user_password == $user_C_password)
          {
            $hash = password_hash($user_password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`username`,`user_email`,`user_password`) VALUES('$user_name','$user_email','$hash')";
            $result = mysqli_query($conn,$sql);
            $showSuccess = "Sign-Up Successfull";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $login_user_name;
            header('location: index.php');
          }
          else
          {
            $showError = "Password does not match";
            $_SESSION['loggedin'] = false;
          }
        }
      }
    }
  }
?>




<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign-Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div class="modal-body">





      
        <form action="" method="post">
            <div class="mb-3">
                <label for="user_name" class="form-label">User Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">Email Id</label>
                <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.    </div>
            </div>
            
            <div class="mb-3">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="user_password" name="user_password">
            </div>
            <div class="mb-3">
                <label for="user_C_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="user_C_password" name="user_C_password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>




        
        
      </div>
    
    </div>
  </div>
</div>