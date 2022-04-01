<?php
  session_start();

  if(!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] != true)
  {
    header("location: index.php");
    exit();
  }
?>

<?php

    require "partials/_db_connection.php";
    $register_error = false;
    $register_success = false;
    $registerWarning = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $student_name = $_POST['student_name'];
        $student_roll_no = $_POST['student_roll_no'];
        $student_enrollment_no = $_POST['student_enrollment_no'];
        $student_contact_no = $_POST['student_contact_no'];
        $parent_contact_no = $_POST['parent_contact_no'];
        $student_email = $_POST['student_email'];
        $student_address = $_POST['student_address'];
        $registered_by = $_SESSION['username'];

        if(isset($_POST['register_submit']))
        {
        //    echo isset($student_name) . "<br>";
        //    echo isset($student_roll_no) . "<br>";
        //    echo isset($student_enrollment_no) . "<br>";
        //    echo isset($student_contact_no) . "<br>";
        //    echo isset($parent_contact_no) . "<br>";
        //    echo isset($student_email) . "<br>";
        //    echo isset($student_address) . "<br>";
        //    echo isset($registered_by) . "<br>";

            if(!(isset($student_name) || isset($student_roll_no) || isset($student_enrollment_no) || isset($student_contact_no) || isset($parent_contact_no) || isset($student_email) ||   isset($student_address)) )
            {
                $registerWarning = "All fields are Required at the time of Register";  
            }
            else
            {
                $sql = "INSERT INTO `registered_student`(`stud_name`,`stud_roll_no`,`stud_enrollment_no`,`stud_contact_no`,`parent_contact_no`,`stud_email`,`stud_address`,`registered_by`) VALUES('$student_name','$student_roll_no','$student_enrollment_no','$student_contact_no','$parent_contact_no','$student_email','$student_address','$registered_by')";

                $result = mysqli_query($conn,$sql);
                if($result)
                {
                    $register_success = "Student Register Successfully";
                    $hash = password_hash($student_enrollment_no,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `studlogin`(`name`,`stud_id`,`password`,`registered`) VALUES('$student_name','$student_roll_no','$hash','$registered_by')";
                    $result = mysqli_query($conn,$sql);
                }
                else
                {
                    $register_error = mysqli_error($conn);
                }             
            }
        }
        // else
        // {

        //     echo "wrong";
        // }
    }
    // else{
    //     echo "not done";
    // }


?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student Registration</title>
  </head>
  <body>
    <?php include "partials/_header.php";?>


    <?php
        if($register_success)
        {
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          <strong>Successfully !</strong> ' . $register_success . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($register_error)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>Error !</strong> ' . $register_error . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($registerWarning)
        {
            echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
          <strong>Warning !</strong> ' . $registerWarning . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>



    <div class="container my-4">
        <div class="badge bg-success text-wrap">
            <h1 class="">Register Student</h1>
        </div>





        




        <form action="studentRegister.php" method="post">
            <!-- For student Name -->
            <div class="row my-4">
                <div class="col-auto">
                    <label for="student_name" class="col-form-label fw-bolder">Student Name</label>
                </div>
                <div class="col-auto w-75">
                    <input type="text" id="student_name" name="student_name" class="form-control" placeholder="Name of Student" aria-describedby="passwordHelpInline">
                </div>
            </div>

            <!-- For student Roll No. and Student Enrollment No. -->
            <div class="row my-3">
                <div class="col-auto">
                    <label for="student_roll_no" class="col-form-label fw-bolder">Roll No.</label>
                </div>
                <div class="col-auto ms-5">
                    <input type="text" id="student_roll_no" name="student_roll_no" class="form-control" placeholder="Student Roll Number" aria-describedby="passwordHelpInline">
                </div>
                
                <div class="col-auto" style=" margin-left: 259px;">
                    <label for="student_enrollment_no" class="col-form-label fw-bolder">Enrollment No.</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="student_enrollment_no" name="student_enrollment_no" class="form-control" placeholder="Student Enrollment No." maxlength="15" aria-describedby="passwordHelpInline">
                </div>
            </div>

            <!-- For student contact No. and parent contact No. -->
            <div class="row my-3">
                <div class="col-auto">
                    <label for="student_contact_no" class="col-form-label fw-bolder">Student Cont.</label>
                </div>
                <div class="col-auto ms-2">
                    <input type="text" id="student_contact_no" name="student_contact_no"  placeholder="Student Contact Number" maxlength="10" class="form-control" >
                </div>
                <div class="col-auto" style=" margin-left: 259px;">
                    <label for="parent_contact_no" class="col-form-label fw-bolder">Parent Cont.</label>
                </div>
                <div class="col-auto ms-3">
                    <input type="text" id="parent_contact_no" maxlength="10" name="parent_contact_no" placeholder="Parent Contact Number" class="form-control">
                </div>
            </div>

            <!-- For email id-->
            <div class="row my-4">
                <div class="col-auto">
                    <label for="student_email" class="col-form-label fw-bolder">Student Email</label>
                </div>
                <div class="col-auto w-75">
                    <input type="email" class="form-control" id="student_email" name="student_email" placeholder="Student Email Id" aria-describedby="emailHelp">
                </div>
            </div>

            <!-- For email id-->
            <div class="row my-4">
                <div class="col-auto">
                    <label for="student_address" class="col-form-label fw-bolder">Student Add. </label>
                </div>
                <div class="col-auto w-75 ms-1">
                    <textarea class="form-control" id="student_address" name="student_address" placeholder="Enter Student Address" rows="3"></textarea>
                </div>
            </div>


           <div class="text-center">
               <button type="submit" name="register_submit" class="btn btn-primary">Submit</button>
            </div>
        </form> 












    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>