<?php
  session_start();

  if(!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] != true)
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

    <title>Attendace Details</title>

    


<!-- Modal -->
    <div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusChangeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusChangeModalLabel">Change Attendace</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

       
          <?php
                include 'partials/_db_connection.php';
                $sql = "SELECT `status` FROM  `attendance_data`";
                $result = mysqli_query($conn,$sql);
               
                  echo'
                  <div class="text-center">
                    <button class="btn btn-primary" value="Present" id="present" name="present" type="submit">Present</button>
                    <button class="btn btn-danger" value="Absent" id="absent" name="absent" type="submit">Absent</button>
                  </div>';
          ?>
  
      </div>
    </div>
  </div>
</div>



  </head>
  <body>
    <?php include "partials/_header.php";?>

    <div class="ms-1 my-2">
        <div class="badge bg-success text-wrap">
            <h1 class="">Attendance Details</h1>
        </div>
    </div>

    <form method="post" action="" class="mx-1">
        <div class="mt-2" style="background-color : dodgerblue; border-radius:4px; min-height:50px;">

          <label for="from_date" class="ms-2" style="color:white; font-style: italic;">FROM :</label>
          <input type="date" name="from_date" id="from_date" class="m-2 p-1 pb-2"  value="<?php echo date('Y-m-d'); ?>" style="border-color: transparent; border-radius:6px;">

          <label for="to_date" class="ms-2" style="color:white; font-style: italic;">TO : </label>
          <input type="date" name="to_date" id="to_date" class="m-2 p-1 pb-2"  value="<?php echo date('Y-m-d'); ?>" style="border-color: transparent; border-radius:6px;">

          <button class="btn btn-danger ms-4" type="submit" name="using_date" id="using_date">Show</button>
          <button class="btn btn-danger ms-4" type="submit" name="change_data" id="change_data">Change</button>
          
        </div>
    </form>
   
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Roll No</th>
                <th scope="col">Enrollment No.</th>
                <th scope="col">Student Name</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Update</th>
              </tr>
            </thead>
            <tbody>

            <?php 
                  include "partials/_db_connection.php";
                  // include "partials/_statusChange.php";
                  if($_SERVER['REQUEST_METHOD'] == 'POST')
                  {
                      if(isset($_POST['using_date']))
                      {
                          $from_date = date('Y-m-d',strtotime($_POST['from_date']));
                          $to_date = date('Y-m-d',strtotime($_POST['to_date']));
                          $taken_by = $_SESSION['username'];
                          // echo $date;
        
                          $sql = "SELECT * FROM `attendance_data` WHERE `taken_by`='$taken_by' AND `date` BETWEEN '$from_date' AND '$to_date' ";
                          $result = mysqli_query($conn,$sql);
                          $srno = 0;
                          while($row = mysqli_fetch_assoc($result))
                          {
                            $srno += 1;
                            echo '
                              <tr>
                                <th scope="row">' . $row['roll_no'] . '</th>
                                <td>' . $row['enrollment_no'] . '</td>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['date'] . '</td>';

                                if($row['status'] == 'Present')
                                {
                                  echo'
                                  <td>
                                  <button class="btn btn-primary" value="Present" type="button">P</button>
                                  </td>';
                                  
                                }
                                if($row['status'] == 'Absent')
                                {
                                  echo'
                                  <td>
                                  <button class="btn btn-danger" value="Absent" type="button">A</button>
                                  </td>';
                                }

                                echo'
                                <td> <button class="change btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#statusChangeModal" name="submit" id="id' . $srno . '"type="submit">Change</button> </td>
                                </tr>';
                          }
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

    <script>
        changes = document.getElementsByClassName('change');
        Array.from(changes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                // console.log("edit");
                tr = e.target.parentNode.parentNode;
                
               
                status = tr.getElementsByTagName("td")[3].innerText;
                date = tr.getElementsByTagName("td")[2].innerText;
                roll_no = tr.getElementsByTagName("th")[0].innerText;
               
                console.log(status);
                console.log(roll_no);
                console.log(date);

                
                console.log(e.target.id);

                absent_button = document.getElementById('absent');
                absent_button.addEventListener('click',(e) =>{
                  console.log(e.target.id);
                  window.location.href="attendanceDetails.php?roll_no="+roll_no+"&date="+date+"&status=Absent";
                })

                
                present_button = document.getElementById('present');
                present_button.addEventListener('click',(e) =>{
                  console.log(e.target.id);
                  window.location.href="attendanceDetails.php?roll_no="+roll_no+"&date="+date+"&status=Present";
                })

                });
            })
    </script>
    <?php

            if(isset($_POST['change_data']) AND isset($_GET['roll_no']))
            {
              $roll_no = $_GET['roll_no'];
              $changing_date = $_GET['date'];
              $status = $_GET['status'];
              $take_by = $_SESSION['username'];
              // echo $roll_no;
              // echo $changing_date;
              // echo $status;
              $sql = "UPDATE `attendance_data` SET `status`='$status' WHERE `roll_no`='$roll_no' AND `date`='$changing_date' AND `taken_by`='$take_by' ";
              $result = mysqli_query($conn,$sql);
              if($result)
              { ?>
                <script>
                  alert("Data Changed Successfully");
                </script>
                <?php
              }
            }
            
    ?>
  </body>
</html>