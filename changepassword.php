<?php
session_start();
$now = time();
if ($now > $_SESSION['expire']) {
    header("Location:../index.html");
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SRMAP</title>
    <link rel="stylesheet" href="password_responsive.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid ">

        <div class="row">
            <div class="container-fluid ">
                <img src="2.png" class="ml-1 mt-1" alt="Responsive image" style="width:157px; height:57px;">
                <div class="row float-right">
                    <div class="col-md-1 userlogin">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-md " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#696747;">
                                <?php
                                echo $_SESSION['username'];
                                ?>
                            </button>
                            <form action="dropdown.php" method="POST">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" type="submit" id="dropmen" name="dropmen" value="changepsw">Settings</button>
                                    <button class="dropdown-item" type="submit" id="dropmen" name="dropmen" value="getout">Logout</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <img src="icon.png" class="menuicon" onclick="togglemenu()">
                    <div class="col-md-2 col-sm-2  mt-2 side_col position-sticky " id="menuList">
                        <ul class="nav flex-column my-nav ">
                            <li class="nav-item">
                                <a class="nav-link my-item" href="home.php">Placement Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-item" href="companydetails.php">Company Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link my-item" href="testschedule.php">Test Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-item" href="campuscomparision.php">Campus Comparision</a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-md-4  col-sm-1 col-xs-2 mt-3 ml-4">
                        <form action="password.php" method="POST">
                            <div class="form-group">
                                <label for="oldpassword">New Password</label>
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" aria-describedby="emailHelp" required="required" placeholder="New Password">

                            </div>
                            <div class="form-group">
                                <label for="newpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="newpassword" name="nwpassword" required="required" placeholder="Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        var menuList = document.getElementById("menuList");
        menuList.style.maxHeight = "800px";

        function togglemenu() {
            if (menuList.style.maxHeight == "0px") {
                menuList.style.maxHeight = "800px";
            } else {
                menuList.style.maxHeight = "0px";
            }
        }
    </script>
</body>

</html>