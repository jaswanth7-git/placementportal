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
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>



    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#placementtable').dataTable({
                searching: false,
                paging: false,
                info: false
            });
            $('#placementtable').DataTable();

        });
    </script>
</head>

<body>
    <div class="container-fluid ">

        <div class="row">

            <div class="container-fluid ">


                <img src="2.png" class="ml-1 mt-1 " alt="Responsive image" style="width:157px; height:57px;">

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

                    <div class="col-md-8  col-sm-1 col-xs-2 mt-n1 ml-4">
                        <div class="col-md-8 mt-2 ">

                            <form>
                                <div class="form-group row ml-2">
                                    <label for="inputPassword" class="col-sm-2 col-form-label" style="font-size:25px;padding:0px;margin:0px;">Search</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="searchname" id="myInput" placeholder="Student Name" onkeyup="myFunction()">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            function myFunction() {
                                // Declare variables
                                var input, filter, table, tr, td, i, txtValue;
                                input = document.getElementById("myInput");
                                filter = input.value.toUpperCase();
                                table = document.getElementById("placementtable");
                                tr = table.getElementsByTagName("tr");

                                // Loop through all table rows, and hide those who don't match the search query
                                for (i = 0; i < tr.length; i++) {
                                    td = tr[i].getElementsByTagName("td")[0];
                                    if (td) {
                                        txtValue = td.textContent || td.innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            tr[i].style.display = "";
                                        } else {
                                            tr[i].style.display = "none";
                                        }
                                    }
                                }
                            }
                        </script>
                        <div class="col mt-2">
                            <?php
                            $x = $_SESSION['branch'];
                            $y = $_SESSION['school'];
                            echo "<center><div class='mx-auto m-1' style='font-size:27px;font-family:Montserrat-bold;color: #696747;'> ";
                            if (empty($x)) {
                                echo $y . " Foreign Students";
                            } else {
                                echo $x . " Foreign Students";
                            }
                            echo "</div></center>";
                            ?>

                            <table id="placementtable">
                                <thead>
                                <tr class='text-center'>
                                    <th style="cursor: pointer;">Name</th>
                                    <th style="cursor: pointer;">Roll No</th>
                                    <th style="cursor: pointer;">Year</th>
                                    <th style="cursor: pointer;">Branch</th>
                                    <th style="cursor: pointer;">Student type</th>
                                    <th style="cursor: pointer;">Email</th>
                                    <th style="cursor: pointer;">CGPA</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php




                                $branch = $_SESSION['branch'];
                                $school = $_SESSION['school'];
                                $year = $_SESSION['year'];

                                include("connection.php");
                                if (empty($school)) {
                                    $sql = "SELECT * from placementstatus where year=$year and status='Foreign student' ";
                                }
                                elseif (empty($branch)) {

                                    $sql = "SELECT * from placementstatus where year=$year and school ='$school' and status='Foreign student' ";
                                } else {
                                    $sql = "SELECT * from placementstatus where year=$year and school ='$school' and branch='$branch'  and status='Foreign student' ";
                                }
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["rollno"] . "</td><td>" . $row["year"] . "</td><td>" . $row["branch"] . "</td><td>" . $row["status"] . "</td><td>" . $row["email"] . "</td><td>" . $row["cgpa"] . "</td></tr>";
                                    }
                                }

                                ?>


                                </tbody>
                            </table>




                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

</body>

</html>