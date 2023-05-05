<?php
include('../config.php');
require_once "../session.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<meta charset="UTF-8">
<title>Search Ambulance</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend_search_ambulance.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
</head>
<body>
<div class="wrapper">
      <nav>
        <a href="./user_home.php" class="logo"><img src="../assets/images/Screenshot (23).png" alt="LOGO" width="60px"><span style="padding-left: 25px;">AMB</span></a>
        <div class="menu" >
          <ul>
          <li><a href="./DBook_ambulance.php">My Location</a></li>
            <li><a href="./book_ambulance.php">Book Ambulance</a></li>
            <li><a href="./search_ambulance.php">Search Ambulance </a></li>
            <li><a href="./view_ambulance.php">View Ambulance</a></li>
            <li><a href="./booking_status.php">Booking Status</a></li>
            <li><a href="./feedback.php">Feedback/Complaint</a></li>
            <li><div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Profile
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="./changepassword.php">Change Password</a></li>
    <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
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
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .sb,.result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
    </style>
      <h2  style="padding-top: 8vw;">Search Ambulance</h2><br>
      <form class="row g-3" method="post">
        <div class="col-auto search-box">
        <input class="form-control-lg" type="text" autocomplete="off" name="search" required placeholder="Search city..." />
            <div class="result"></div>
        </div>
        <div class="col-auto form-floating search-box">
        <input list="vehicles" class="form-control" name="vehicles" value="Basic Ambulance" id="floatinginput" placeholder="Basic Ambulance"></input>
      <label for="floatinginput">Ambulance Vehicle Type</label>
      <datalist id="vehicles">
      <option value="Basic Ambulance">
    <option value="Advance Ambulance">
    <option value="Mortuary Ambulance">
    <option value="Neonatal Ambulance">
    <option value="Patient Transport Ambulance">
      </datalist>
        </div>
        <div class="col-auto">
    <input type="submit" class="sb" value="search" style="border-radius: 5px;">
        </div>
  </div>
</form>
      <?php
        $city="1";
        $vehicles="";
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']))
        {
          $city=$_POST['search'];
          $vehicles=$_POST['vehicles'];
        }
        $sql="select * from ambulances WHERE status='ADDED'AND city='$city' AND vehicles='$vehicles';";
        $res=mysqli_query($db,$sql);
        ?>
        <div style="margin-top:5%;">
          <table class="table" >
            <tr align="center">
              <th>Name</th>
              <th>PHONE NUMBER</th>
              <th>VEHICLE NUMBER</th>
              <th>VEHICLE TYPE</th>
              <th>LICENSE</th>
              <th>STATE</th>
              <th>CITY</th>
              <th>AVAILABILITY</th>
              <th>Book Ambulance</th>
            </tr>
            
            <?php
        while($row = mysqli_fetch_array($res))
        {
        ?>
            
            <tr align="center">
              <td> <?php echo $row['name']; ?></td>
                <td> <?php echo $row["phonenu"]; ?></td>
                <td> <?php echo  $row["vehicleno"]  ?></td>
                <td> <?php echo $row["vehicles"] ?></td>
                <td> <?php echo $row["licenseno"]  ?></td>
                <td> <?php echo $row["state"]; ?></td>
                <td> <?php echo $row['city']; ?></td>
                <td> <?php echo $row['availability']; ?></td>
                <td>
                  <?php
            if($row['availability']=="AVAILABLE")
            {?>
            <a href="book_ambulanceapp.php?vehicleno=<?php echo $row['vehicleno']?>" class="btn btn-warning btn-xs tooltips" tooltip-placement="top" tooltip="Remove">BOOK AMBULANCE</i></a>
            <?php }?>
          </div></td>
        </tr>
        
        
        <?php   
        }
        ?>
        
      </table>
    </div>
    </body>
</html>

