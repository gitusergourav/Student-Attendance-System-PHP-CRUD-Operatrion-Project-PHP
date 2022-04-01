<?php
  
  require "partials/_db_connection.php";
  $login_Error = false;
  $login_Sucess = false;

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['submit_login']))
    {
      $login_user_name = $_POST['login_user_name'];
      $login_user_password = $_POST['login_user_password'];

      $sql = "SELECT * FROM `users` WHERE `username`='$login_user_name' ";
      $result = mysqli_query($conn,$sql);
      $num_rows_count = mysqli_num_rows($result);
      if($num_rows_count > 0)
      {

      
        while($row = mysqli_fetch_assoc($result))
        {
          $login_hash = password_verify($login_user_password,$row['user_password']);
          if($login_user_password == $login_hash)
          {
            $login_Sucess = "Log In Successfully";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $login_user_name;
            header('location: index.php');
          }
          else
          {
            $login_Error = "Incorrect Password";            
          }
        }


      }
      else
      {
        $login_Error = "Incorrect Username and Password";
      }

    }
  }

?>



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">






        <form action="" method="post">
            <div class="mb-3">
                <label for="login_user_name" class="form-label">User Name</label>
                <input type="text" class="form-control" id="login_user_name" name="login_user_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="login_user_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="login_user_password" name="login_user_password">
            </div>
            <button type="submit" name="submit_login" class="btn btn-primary">Submit</button>
        </form>






      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>