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
    <link rel="stylesheet" href="testschedule.css">
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
                <img src="2.png" class="ml-1 mt-1" alt="Responsive image" style="width:157px; height:57px;position: -webkit-sticky;position: sticky;top:10px;">
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
                                <a class="nav-link my-item" href="campuscomparision.php">Campus wise Comparision</a>
                            </li>
                        </ul>

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
                    <div class="col-md-8  col-sm-1 col-xs-2 mt-3 ml-4">
                        <table>
                            <tr class="text-center">
                                <th>Category</th>
                                <th>KTR</th>
                                <th>MODI</th>
                                <th>RMP</th>
                                <th>VDP</th>
                                <th>SRM AP</th>
                                <th>Total</th>



                            </tr>
                            <?php
                            include('connection.php');
                            if (mysqli_connect_error()) {
                                die('connection failed(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
                            } else {
                                $sql = "select * from campuscomparision";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['category'] != "CONVERSION") {
                                            echo "<tr><td>" . $row['category'] . "</td><td>" . $row['KTR'] . "</td><td>" . $row['MODI'] . "</td><td>" . $row['RMP'] . "</td><td>" . $row['VDP'] . "</td><td>" . $row['SRMAP'] . "</td><td>" . $row['Total'] . "</td></tr>";
                                        }
                                        if ($row['category'] == "CONVERSION") {
                                            echo "<tr><td>" . $row['category'] . "</td><td>" . $row['KTR'] . "%</td><td>" . $row['MODI'] . "%</td><td>" . $row['RMP'] . "%</td><td>" . $row['VDP'] . "%</td><td>" . $row['SRMAP'] . "%</td><td>" . $row['Total'] . "%</td></tr>";
                                        }
                                    }
                                    echo "</table>";
                                }

                                exit();
                            }
                            ?>

                        </table>


                    </div>
                </div>
            </div>
        </div>


    </div>

</body>

</html>