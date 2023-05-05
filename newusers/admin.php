<?php
include('../config.php');
require_once "../session.php";
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$phonenu=$_SESSION['phonenu'];
$username=$_SESSION['username'];
$password=$_SESSION['password'];
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
    var track = {
  // (A) INIT
  delay : 10000, // delay between location refresh
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
 
    // (B2) AJAX FETCH
    fetch("ajax_track.php", { method:"POST", body:data })
    .then(res => res.json())
    .then(data => { for (let r of data) {
      let row = document.createElement("div");
      row.className = "row";
      row.innerHTML = 
        `<div class="title">[${r.track_time}] <br>NAME ${r.drivername}</div>
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