<?php
include_once('../config.php');
require_once "../session.php";
$name=$_SESSION['name'];
require_once "../config.php";
//require_once "session.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
 $dname= trim($_POST['dname']);
    $from=trim($_POST['from']);
    $to=trim($_POST['to']);
    $reason=trim($_POST['reason']);
    $status="PENDING";
           if(empty($error)){
               $insertQuery=$db->prepare("INSERT INTO leaveapproval (drivername,fromdate,todate,reason,status) VALUES( ?,?,?,?,?);");
               $insertQuery->bind_param("sssss",$dname,$from,$to,$reason,$status);
               $result=$insertQuery->execute();
               if($result){
                $success='
                <script>if($result)
                {   
 $(document).ready(function(){
     $("#myModal").modal("show");
 });}</script>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Successfully submitted.
                      </div>
                    </div>
                  </div>
                </div>';
                echo "$success";
               }else{
                   $error='<pclass="error">Something went wrong!</p>';
                   echo "$error";
               }
            }
    $insertQuery->close();
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
 $(document).ready(function(){
     $("#myModal").modal("show");
 });</script>
<title>Apply Leave</title>
</head>
<body>
<div class="wrapper">
      <nav>
        <a href="./driver_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu" >
          <ul>
          <li><a href="./mylocation.php">My Location</a></li>
          <?php
          $sql="select * from patients;";
          $res=mysqli_query($db,$sql);
          while($row = mysqli_fetch_array($res))
          {
           if($row['status']=="ASSIGNED"){?>
            <li><a href="./patient_request.php" class="position-relative">Patient Request for Ambulance<span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span></a></li>
            <?php }
             elseif ($row['status']=="COMPLETED") {
            }else
            {?>
            <li><a href="./patient_request.php" class="position-relative">Patient Request for Ambulance</a></li><?php }}?>
            <li><a href="./add_ambulance.php">Add Ambulance</a></li>
            <li><a href="./ambulance_status.php">Ambulance Status</a></li>
            <li><a href="./view_ambulance.php">View Ambulance</a></li>
            <li><a href="./apply_leave.php">Leave Application</a></li>
            <li><div class="dropdown" style="padding-right: 35px;">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
    Profile
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="./changepassword.php">Change Password</a></li>
    <li><a class="dropdown-item" href="./driver_logout.php">Logout</a></li>
  </ul>
</div></li>
          </ul>
        </div>
      </nav>
    </div>



    <style>
        *,
*::before,
*::after {
margin: 0;
padding: 0;
}
.wrapper {
  width: 100vw;
  margin: 0 auto;
  position: fixed;
  z-index: 999;
}
nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  background-color: hsl(240, 2%, 8%);
  padding: 1rem 1.5rem;
  width: 100%;
}
nav .logo  {
  font-weight: 700;
}
nav ul {
  list-style: none;
  display: flex;
  padding-top: 15px;
  gap: 2rem;
}
nav a {
  text-decoration: none;
  color: white;
}
nav #toggle,
nav label {
  display: none;
}
.menu li{
  font-size: medium;
}
.bottom-right {
  position: absolute;
  bottom: 275px;
  right: 175px;
  color: black;
  font-size: 35px;
}
    </style>
    <div style="padding-top: 8%;">
      <div class="container text">
          <h2>Apply Leave Here</h2><br>
        <div class="col">
      <form action="" method="post">
        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingInput" name="dname" required readonly placeholder="name@example.com" value="<?php echo $name;?>">
          <label for="floatingInput" required>Driver Name</label>
        </div>
        From Date : <input id="date_picker" name="from" class="form-control" type="date" required>
        To Date : <input id="date_picker1" name="to" class="form-control" type="date" required>
        <span class="text-danger">Includes End date</span>
<div class="form-floating mb-3 mt-3">
  <textarea class="form-control" placeholder="Leave a comment here" name="reason" id="floatingTextarea2" style="height: 100px" required></textarea>
  <label for="floatingTextarea2">Reason</label>
</div>
  <div class="form-floating mt-3">
  <input type="submit" name =submit value="Submit" class="btn btn-primary w-100"><br>
  </div>
</form>
<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
        $('#date_picker1').attr('min',today);
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 2).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('max',today);
        $('#date_picker1').attr('max',today);
    </script>
</div>
    </div>
    <?php
    include('../config.php');
    if(isset($_GET['end']))
          {
                  mysqli_query($db,"UPDATE leaveapproval SET status='COMPLETED' where drivername = '".$_GET['name']."' and fromdate = '".$_GET['fdate']."' and todate = '".$_GET['tdate']."'");
                      mysqli_query($db,"UPDATE ambulances SET availability='AVAILABLE' where name = '".$_GET['name']."'");
          }
$sql="select * from leaveapproval WHERE drivername='$name';";
$res=mysqli_query($db,$sql);
?>
<div style="padding-top:8%;">
<h2>View Leave Approvals</h2><br>
<table class="table" >
<tr align="center">
    <th>Driver Name</th>
    <th>START DATE</th>
    <th>END DATE</th>
    <th>REASON</th>
    <th>STATUS</th>
</tr>
<?php
while($row = mysqli_fetch_array($res))
{
?>
    
    <tr align="center">
        <td> <?php echo $row['drivername']; ?></td>
        <td> <?php echo $row["fromdate"]; ?></td>
        <td> <?php echo $row["todate"] ?></td>
        <td> <?php echo $row['reason']; ?></td>
        <td><?php if($row['status']=="GRANTED")
        {
          echo $row['status'];
          ?>
            <a href="./apply_leave.php?name=<?php echo $row['drivername'];?>&fdate=<?php echo $row["fromdate"]?>&tdate=<?php echo $row["todate"] ?>&end=end" onClick="return alert('Are you sure you want to end?')"class="btn btn-warning" >END LEAVE</a>
        <?php
        } else
        { echo $row['status'];
        }?></td>
    </tr>

    
 <?php   
}
?>

</table>
</body>
</html>