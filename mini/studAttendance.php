<?php
  session_start();

  if(!(isset($_SESSION['stud_loggedin'])) || $_SESSION['stud_loggedin'] != true)
  {
    header("location: index.php");
    exit();
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Student Attendace</title>
  </head>
  <body>
    <?php include "partials/_header.php";?>
    <div class="ms-3 my-4">
        <div class="badge bg-success text-wrap">
            <h1 class="">Attendance</h1>
        </div>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Roll No</th>
                <th scope="col">Enrollment No.</th>
                <th scope="col">Student Name</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>

            
            <?php

                include "partials/_db_connection.php";
                $stud_id = $_SESSION['stud_id'];
                $sql = "SELECT * FROM `registered_student` WHERE `stud_roll_no`='$stud_id' ";
                $result = mysqli_query($conn,$sql);
                $num_rows_data = mysqli_num_rows($result);
                if($num_rows_data > 0)
                {
                  $srid = 0;
                  while($row = mysqli_fetch_assoc($result))
                  {
                    $srid +=1 ;
                    echo'
                    <tr>
                    <th scope="row">' . $row['stud_roll_no'] . '</th>
                    <td>' . $row['stud_enrollment_no'] . '</td>
                    <td>' . $row['stud_name'] . '</td>
                    <td>
                      <button class="edit btn btn-outline-primary" type="submit" value="Present" id=e' . $srid . 'name="submit_present">P</button>
                      <button class="edit2 btn btn-outline-danger ms-2" type="submit" value="Absent" id=ed' . $srid . ' name="submit_absent">A</button>

                      
                    </td>
                    </tr>';

                  } 
                }
            ?>

            </tbody>

        </table>
        
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

<script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                // console.log("edit");
                tr = e.target.parentNode.parentNode;
                
                roll_no = tr.getElementsByTagName("th")[0].innerText;
                enroll_no = tr.getElementsByTagName("td")[0].innerText;
                name = tr.getElementsByTagName("td")[1].innerText;


                // printing values (used for checking purpose)
                // console.log(roll_no)
                // console.log(enroll_no)
                // console.log(name)
                
                // console.log(e.target.id);
                  count = e.target.id;
                
                  // which is used to taking value from button
                  sts = document.getElementById(count).value;

                  window.location.href = "studAttendance.php?roll_no="+roll_no+"&enroll_no="+enroll_no+"&name="+name+"&status="+sts;
                  
                });
            })
            
        edits2 = document.getElementsByClassName('edit2');
        Array.from(edits2).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                // console.log("edit");
                tr = e.target.parentNode.parentNode;
                
                roll_no = tr.getElementsByTagName("th")[0].innerText;
                enroll_no = tr.getElementsByTagName("td")[0].innerText;
                name = tr.getElementsByTagName("td")[1].innerText;

                // Printing values (used for chacking purpose)
                // console.log(roll_no)
                // console.log(enroll_no)
                // console.log(name)
                
                count2 = e.target.id;
                // which is used to taking value from button
                sts2 = document.getElementById(count2).value;

                window.location.href = "studAttendance.php?roll_no="+roll_no+"&enroll_no="+enroll_no+"&name="+name+"&status="+sts2;
                
                
            });
        })

</script>

<?php
  include "partials/_db_connection.php";
  if(isset($_GET['roll_no']) and isset($_GET['enroll_no'])  and isset($_GET['name']))
  {

    // Used for display taken values (used for checking purpose)
    // echo $_GET['roll_no'] . "<br>";
    // echo $_GET['enroll_no'] . "<br>";
    // echo $_GET['name'] . "<br>";
    // echo $_GET['status'] . "<br>";

    // Creating variables for accessing values from the url
    $attendace_roll_no = $_GET['roll_no'];
    $attendace_enroll_no = $_GET['enroll_no'];
    $attendace_name = $_GET['name'];
    $attendance_status = $_GET['status'];
    $taken_by_attendance = $_SESSION['teacher'];

    // fetching data from database which is used to do not insert a dublicated record (here we do : we taken data from the database and check roll number from the user if date and roll number is same then data well not be inserted again )
    $sql = "SELECT * FROM `attendance_data` WHERE `date`=CURRENT_DATE AND `roll_no`='$attendace_roll_no'";
    $result = mysqli_query($conn,$sql);

    // checking the rows from the database
    $num_rows_count_attendace = mysqli_num_rows($result);
    if($num_rows_count_attendace > 0)
    {
      ?>
      <script>
          alert("Attendace already taken");
      </script>

      <?php
    }
    else
    {
      // inserting data into database
        $sql = "INSERT INTO `attendance_data`(`roll_no`,`enrollment_no`,`name`,`status`,`taken_by`) VALUES('$attendace_roll_no','$attendace_enroll_no','$attendace_name','$attendance_status','$taken_by_attendance')";
        $result = mysqli_query($conn,$sql);
    }
  }
?>