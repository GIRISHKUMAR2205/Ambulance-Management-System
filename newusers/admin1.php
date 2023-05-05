<?php
ini_set( "display_errors", 0); 
include('../config.php');
require_once "../session.php";
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$phonenu=$_SESSION['phonenu'];
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$sql="select * from patients WHERE bookedby='$name' and status='ASSIGNED'";
$res=mysqli_query($db,$sql);
if($res){
while($row = mysqli_fetch_array($res))
{
    $vehicleno=isset($row['vehicleno'])? $row["vehicleno"] : NULL; 
}
if(!isset($row['vehicleno'])){
    $sql1="select * from ambulances WHERE vehicleno='$vehicleno'";
    $res=mysqli_query($db,$sql1);
    while($row = mysqli_fetch_array($res))
    {
        $dname=$row['name']; 
    }}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="wrapper1"></div>
<script defer>
    var uid=<?php echo $id; ?>;

    <?php
       echo "var drivername ='$dname';";
   ?>


    var track = {
  // (A) INIT
  rider : uid,
  delay : 5000, // delay between location refresh
  timer : null, // interval timer
  hWrap : null, // html <div> wrapper1
  init : () => {
    track.hMap = document.getElementById("wrapper1");
    track.show();
    track.timer = setInterval(track.show, track.delay);
  },
 
  // (B) GET DATA FROM SERVER AND UPDATE MAP
  show : () => {
    // (B1) DATA
    var data = new FormData();
    data.append("req", "get");
    data.append("id", track.rider);
    data.append("drivername",drivername);
 
    // (B2) AJAX FETCH
    fetch("ajax_track.php", { method:"POST", body:data })
    .then(res => res.json())
    .then(data => { for (let r of data) {
      let row = document.createElement("div");
      row.className = "row";
      row.innerHTML = 
        `<div class="title">[${r.track_time}]<br> NAME ${r.drivername}</div>
         <div class="data">${r.lat}, ${r.lng}</div>`;
         document.getElementById("wrapper1").appendChild(row); 
    }})
    .catch(err => track.error(err));
  },
 
  // (C) HELPER - ERROR HANDLER
  error : err => {
    console.error(err);
    alert("An error has occured, open the developer's console.");
    clearInterval(track.timer);
  }
};
window.onload = track.init;
</script>
</body>
</html>