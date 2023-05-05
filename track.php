<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="row">
  <div class="title">Updated</div>
  <div class="data" id="date"></div>
</div>
<div class="row">
  <div class="title">Latitude, Longitude</div>
  <div class="data">
    <span id="lat"></span>, <span id="lng"></span>
  </div>
</div>
    <script>
       var uid=<?php echo $id; ?>;
       var phonenu=<?php echo $phonenu; ?>;
       <?php
       echo "var name ='$name';";
       echo "var email ='$email';";
       echo "var phonenu ='$phonenu';";
       echo "var username ='$username';";
       echo "var password ='$password';";
   ?>
        var track = {
  // (A) INIT
  rider : uid,   // rider id - fixed to 999 for demo
  delay : 5000, // delay between gps update (ms)
  timer : null,  // interval timer
  hDate : null,  // html date
  hLat : null,   // html latitude
  hLng : null,   // html longitude
  init : () => {
    // (A1) GET HTML
    track.hDate = document.getElementById("date");
    track.hLat = document.getElementById("lat");
    track.hLng = document.getElementById("lng");

    // (A2) START TRACKING
    track.update();
    track.timer = setInterval(track.update, track.delay);
  },

  // (B) SEND CURRENT LOCATION TO SERVER
  update : () => navigator.geolocation.getCurrentPosition(
    pos => {
      // (B1) LOCATION DATA
      var data = new FormData();
      data.append("req", "update");
      data.append("id", track.rider);
      data.append("name",name);
      data.append("username",username);
      data.append("email",email);
      data.append("phonenu",phonenu);
      data.append("password",password);
      data.append("lat", pos.coords.latitude);
      data.append("lng", pos.coords.longitude);

      // (B2) AJAX SEND TO SERVER
      fetch("ajax_track.php", { method:"POST", body:data })
      .then(res => res.text())
      .then(txt => { if (txt=="OK") {
        let now = new Date();
        track.hDate.innerHTML = now.toString();
        track.hLat.innerHTML = pos.coords.latitude;
        track.hLng.innerHTML = pos.coords.longitude;
      } else { track.error(txt); }})
      .catch(err => track.error(err));
    },
    err => track.error(err)
  ),

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