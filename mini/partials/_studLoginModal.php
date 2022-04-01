<?php
  
  require "partials/_db_connection.php";
  $login_Error = false;
  $login_Sucess = false;

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['stud_login']))
    {
      // if()
      $login_stud_id = $_POST['login_stud_id'];
      $login_stud_pass = $_POST['login_stud_pass'];
      $teacher = (string)$_POST['teacher'];
      echo $teacher;

      $sql = "SELECT * FROM `studlogin` WHERE `stud_id`='$login_stud_id' AND `registered` = '$teacher'";

      $result = mysqli_query($conn,$sql);
      $num_rows_count = mysqli_num_rows($result);
      if($num_rows_count > 0)
      {
      
        while($row = mysqli_fetch_assoc($result))
        {
          $stud_login_hash = password_verify($login_stud_pass,$row['password']);
          if($login_stud_pass == $stud_login_hash)
          {
            $login_Sucess = "Log In Successfully";
            session_start();
            $_SESSION['stud_loggedin'] = true;
            $_SESSION['stud_id'] = $login_stud_id;
            $_SESSION['teacher'] = $teacher;
            header('location: studAttendance.php');
          }
          else
          {
            $login_Error = "Incorrect Password";            
          }
        }


      }
      else
      {
        $login_Error =  "Incorrect Username and Password";
        
      }

    }
  }

?>



<!-- Modal -->
<div class="modal fade" id="studLoginModal" tabindex="-1" aria-labelledby="studLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studLoginModalLabel">Log In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">






        <form action="" method="post">
            <div class="mb-3">
                <label for="login_stud_id" class="form-label">Student Id</label>
                <input type="text" class="form-control" id="login_stud_id" name="login_stud_id" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="login_stud_pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="login_stud_pass" name="login_stud_pass">
            </div>
            <div class="mb-3">
                <label for="teacher" class="form-label">Teacher Name</label>
                <select name="teacher" id="teacher" class="form-control">
                <?php
                    include "partials/_db_connection.php";
                    $sql = "SELECT * FROM `users`";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                      echo '<option value="' . $row['username'] . '">' . $row['username'] . '</option>';
                   }
                ?>
                </select>
            </div>
            <button type="submit" name="stud_login" class="btn btn-primary">Login</button>
        </form>






      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>