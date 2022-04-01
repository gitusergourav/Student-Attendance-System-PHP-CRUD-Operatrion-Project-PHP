<?php

    include "partials/_loginModal.php";
    include "partials/_signupModal.php";
    include "partials/_studLoginModal.php";
    

echo'
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>';

                if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true)
                {
                    echo'
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                            <a class="dropdown-item" href="studentAttendace.php">Student Attendance</a>
                            </li>
                            <li>
                            <a class="dropdown-item" href="studentRegister.php">Register Student</a>
                            </li>
                            <li>
                            <hr class="dropdown-divider">
                            </li>
                            <li>
                            <a class="dropdown-item" href="attendanceDetails.php">Attendance Details</a>
                            </li>
                            </ul>
                        </ul>
                    </li>';
                }
                
            
                if(!(isset($_SESSION['loggedin']) || (isset($_SESSION['stud_loggedin']))))
                {
                echo '
                <div style="margin-left:820px">
                <button class="btn btn-outline-success mx-1" type="submit" data-bs-toggle="modal" data-bs-target="#studLoginModal">Student Login</button>
                <button class="btn btn-outline-success mx-1" type="submit" data-bs-toggle="modal" data-bs-target="#loginModal">Admin</button>
                <button class="btn btn-outline-success mx-1" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">Sign-Up</button>
            </div>';
            }
            if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true)
            {
                echo '<div class="me-3 " style="margin-left: 750px;"> Welcome : <b>' . $_SESSION['username'] . '</b></div>';
                echo '<a href="partials/_logout.php" class="btn btn-outline-success mx-1">Log-Out</a>';
            }

            if(isset($_SESSION['stud_loggedin']) and $_SESSION['stud_loggedin'] == true)
            {
                echo '<div style="margin-left: 1036px;">';
                echo '<a href="partials/_logout.php"  class="btn btn-outline-success mx-1" >Log-Out</a>';
                echo '</div>';
            }
            echo'
        </div>
    </div>
</nav>';
?>
    <?php 
        
        if($showError)
        {
          echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>Error !</strong> ' . $showError  . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showSuccess)
        {
          echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          <strong>Successfully !</strong> ' . $showSuccess . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showWarning)
        {
          echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
          <strong>Warning !</strong> ' . $showWarning . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
      
    ?>
    <?php

        if($login_Sucess)
        {
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          <strong>Successfully !</strong> ' . $login_Sucess . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($login_Error)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>Error !</strong> ' . $login_Error . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

    ?>