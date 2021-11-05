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
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>


    <script>
    var subjectObject = {

        "2017": {
            "SEAS": ["CSE", "MECH", "ECE", "B.Sc Computer Science", "B.Sc Physics", "B.Sc Maths", "B.Sc Biology"],
            "SEAMS": ["BBA"],
            "SLASS": ["BA History", "BA English", "BA Economics"],

        },
        "2018": {
            "SEAS": ["CSE"]


        }
    }
    window.onload = function() {
        var subjectSel = document.getElementById("year");
        var topicSel = document.getElementById("school");
        var chapterSel = document.getElementById("branch");
        for (var x in subjectObject) {
            subjectSel.options[subjectSel.options.length] = new Option(x, x);
        }
        subjectSel.onchange = function() {
            //empty Chapters- and Topics- dropdowns
            chapterSel.length = 1;
            topicSel.length = 1;
            //display correct values
            for (var y in subjectObject[this.value]) {
                topicSel.options[topicSel.options.length] = new Option(y, y);
            }
        }
        topicSel.onchange = function() {
            //empty Chapters dropdown
            chapterSel.length = 1;
            //display correct values
            var z = subjectObject[subjectSel.value][this.value];
            for (var i = 0; i < z.length; i++) {
                chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i]);
            }
        }
    }
    </script>
</head>

<body>
    <div class="container-fluid ">

        <div class="row">
            <div class="container-fluid ">
                <img src="2.png" class="ml-1 mt-1" alt="Responsive image"
                    style="width:157px; height:57px;position: -webkit-sticky;position: sticky;top:10px;">
                <div class="row float-right">
                    <div class="col-md-1 userlogin">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-md " type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="background-color:#696747;">
                                <?php
                                echo $_SESSION['username'];
                                ?>
                            </button>
                            <form action="dropdown.php" method="POST">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" type="submit" id="dropmen" name="dropmen"
                                        value="changepsw">Settings</button>
                                    <button class="dropdown-item" type="submit" id="dropmen" name="dropmen"
                                        value="getout">Logout</button>


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
                    <div class="col-md-6  col-sm-1 col-xs-2 mt-2 ml-4">



                        <?php

                        $branch = filter_input(INPUT_GET, "branch");
                        $year = filter_input(INPUT_GET, "year");
                        $school = filter_input(INPUT_GET, "school");

                        $_SESSION['branch'] = $branch;
                        $_SESSION['school'] = $school;
                        $_SESSION['year'] = $year;



                        $data[] = array();
                        include("connection.php");

                        if (empty($year)) {

                            $sql = "SELECT * , count(*) as number FROM placementstatus where status in('placed','Not Placed') GROUP BY status";
                        } elseif (empty($school)) {

                            $sql = "SELECT * , count(*) as number FROM placementstatus where year ='$year' and status in('placed','Not Placed') GROUP BY status";
                        } elseif (empty($branch)) {
                            $sql = "SELECT *, count(*) as number FROM placementstatus where year='$year' and school='$school' and status in('placed','Not Placed') GROUP BY status";
                        } else {

                            $sql = "SELECT *, count(*) as number FROM placementstatus where year='$year' and school='$school' and branch='$branch' and status in('placed','Not Placed') GROUP BY status";
                        }




                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $dataPoints[] = array("name" => $row['status'], "y" => $row['number'], "link" => $row['link']);
                            $data = $dataPoints;
                        }

                        if (empty($year)) {
                            $sql2 = "SELECT *, count(*) as number FROM placementstatus where status!='placed' and status!='notplaced' GROUP BY status";
                        } elseif (empty($school)) {
                            $sql2 = "SELECT *, count(*) as number FROM placementstatus where year='$year' and status!='placed' and status!='notplaced' GROUP BY status";
                        } elseif (empty($branch)) {
                            $sql2 = "SELECT *, count(*) as number FROM placementstatus where  year='$year' and school='$school' and status!='placed' and status!='notplaced' GROUP BY status";
                        } else {
                            $sql2 = "SELECT *, count(*) as number FROM placementstatus where branch='$branch' and year='$year' and school='$school' and status!='placed' and status!='notplaced' GROUP BY status";
                        }
                        $result2 = mysqli_query($con, $sql2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $sdataPoints[] = array("name" => $row2['status'], "y" => $row2['number'], "url" => $row2['link']);
                            $stype = $sdataPoints;
                        }


                        ?>
                        <?php
                        if (empty($dataPoints) == false) {
                        ?>
                        <figure class="highcharts-figure">
                            <div id="first"></div>
                        </figure>
                        <?php
                        }
                        ?>
                        <figure class="highcharts-figure">
                            <div id="two"></div>
                        </figure>
                        <script>
                        // Create the chart

                        Highcharts.chart('first', {
                            exporting: {
                                menuItemDefinitions: {
                                    // Custom definition
                                    switchChart: {
                                        onclick: function() {
                                            var chartType = this.options.chart.type;

                                            this.update({
                                                chart: {
                                                    type: chartType === 'bar' ? 'pie' : 'bar'
                                                }
                                            })
                                        },
                                        text: 'Switch chart'
                                    }
                                },
                                buttons: {
                                    contextButton: {
                                        menuItems: ["switchChart", "separator", "printChart", "separator",
                                            "downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG",
                                            "separator", "viewData", "downloadCSV"
                                        ]
                                    }
                                }
                            },
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'

                            },
                            title: {
                                text: 'Placement Status',
                                style: {
                                    color: '#696747',
                                    fontSize: '25px',
                                    fontFamily: 'Montserrat-bold'
                                }
                            },
                            accessibility: {
                                announceNewData: {
                                    enabled: true
                                },
                                point: {
                                    valueSuffix: '%'
                                }
                            },

                            plotOptions: {
                                pie: {
                                    colors: [
                                        'red',
                                        '#2eb82e',

                                        '#DDDF00',
                                        '#24CBE5',
                                        '#64E572',
                                        '#FF9655',
                                        '#FFF263',
                                        '#6AF9C4'
                                    ],


                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true
                                    },
                                    showInLegend: true
                                },
                                series: {

                                    cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function() {
                                                location.href = this.options.link;
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        distance: 10,
                                        format: '{point.name}: {point.y} ({point.percentage:.1f}%)',
                                        style: {
                                            color: 'Black',
                                            fontSize: '15px',
                                            fontFamily: 'Montserrat-medium'
                                        }
                                    }
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:15px;font-family:Montserrat-medium;">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color};font-size:15px;font-family:Montserrat-medium;">{point.name}</span>: <b style="font-size:15px;font-family:Montserrat-bold;">{point.y:}</b> of total<br/><div style="font-size:15px;font-family:Montserrat-bold;">({point.percentage:.1f}%)</div>'
                            },

                            series: [{
                                name: '<?php
                                            $school = filter_input(INPUT_GET, "school");
                                            echo $school;
                                            ?>',

                                colorByPoint: true,
                                data: <?php
                                            echo json_encode($data, JSON_NUMERIC_CHECK); ?>,


                            }]
                        });
                        </script>
                        <script>
                        // Create the chart

                        Highcharts.chart('two', {
                            exporting: {
                                menuItemDefinitions: {
                                    // Custom definition
                                    switchChart: {
                                        onclick: function() {
                                            var chartType = this.options.chart.type;

                                            this.update({
                                                chart: {
                                                    type: chartType === 'bar' ? 'pie' : 'bar'
                                                }
                                            })
                                        },
                                        text: 'Switch chart'
                                    }
                                },
                                buttons: {
                                    contextButton: {
                                        menuItems: ["switchChart", "separator", "printChart", "separator",
                                            "downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG",
                                            "separator", "viewData"
                                        ]
                                    }
                                }
                            },
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'

                            },
                            title: {
                                text: 'Student Category',
                                style: {
                                    color: '#696747',
                                    fontSize: '25px',
                                    fontFamily: 'Montserrat-bold'
                                }
                            },
                            accessibility: {
                                announceNewData: {
                                    enabled: true
                                },
                                point: {
                                    valueSuffix: '%'
                                }
                            },

                            plotOptions: {
                                pie: {
                                    colors: [
                                        'blue',
                                        'red',
                                        '#DDDF00',
                                        '#24CBE5',
                                        '#64E572',
                                        '#FF9655',
                                        '#FFF263',
                                        '#6AF9C4'
                                    ],
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true
                                    },
                                    showInLegend: true
                                },
                                series: {

                                    cursor: 'pointer',
                                    point: {
                                        events: {
                                            click: function() {
                                                location.href = this.options.url;
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        distance: 10,
                                        format: '{point.name}: {point.y} ({point.percentage:.1f}%)',
                                        style: {
                                            color: 'Black',
                                            fontSize: '15px',
                                            fontFamily: 'Montserrat-medium'
                                        }
                                    }
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:15px;font-family:Montserrat-medium;">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color};font-size:15px;font-family:Montserrat-medium;">{point.name}</span>: <b>{point.y:}</b> of total<br/><div style="font-size:15px;font-family:Montserrat-bold;">({point.percentage:.1f}%)</div>'
                            },

                            series: [{
                                name: '<?php
                                            $school = filter_input(INPUT_GET, "school");
                                            echo $school;
                                            ?>',
                                colorByPoint: true,
                                data: <?php
                                            echo json_encode($stype, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        </script>
                    </div>
                    <div class="col-md-3 ml-auto col-sm-1 col-xs-2 mt-n5 scorecard">



                        <form method="GET" name="form1" id="form1" action="" class="ml-4 mt-2 ">
                            <div class="form-group row ">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-8 ml-3">
                                    <select name="year" id="year" class="form-control " required="required">
                                        <option value="" selected="selected" disabled>Select year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">School</label>
                                <div class="col-sm-8 ml-3">

                                    <select name="school" id="school" class="form-control " rquired="required">
                                        <option value="" selected="selected" disabled>Please select Year first</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Branch</label>
                                <div class="col-sm-8 ml-3">
                                    <select name="branch" id="branch" class="form-control ">
                                        <option value="" selected="selected" disabled> Please select School first
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Search" class="btn btn-primary m-2">
                            </div>

                        </form>




                        <table class="table mt-n5">
                            <div id="scorehead" class="m-0 p-0"><strong>Placement Highlights </strong></div>
                            <thead>
                                <?php
                                if (empty($branch)) {
                                    $school = filter_input(INPUT_GET, "school");
                                    echo "<div id='scorehead'><strong>";
                                    echo $school;
                                    echo "</strong></div>";
                                } else {
                                    $branch = filter_input(INPUT_GET, "branch");
                                    echo "<div id='scorehead'><strong>";
                                    echo $branch;
                                    echo "</strong></div>";
                                }
                                ?>

                            </thead>

                            <tbody>



                                <?php



                                include("connection.php");
                                $branch = filter_input(INPUT_GET, "branch");
                                $school = filter_input(INPUT_GET, "school");
                                $year = filter_input(INPUT_GET, "year");

                                if (empty($school)) {
                                    $sql = "SELECT round(AVG(salary),2),MAX(salary) FROM placementstatus where  year='$year' and status='placed' ";
                                } elseif (empty($branch)) {
                                    $sql = "SELECT round(AVG(salary),2),MAX(salary) FROM placementstatus where  year='$year' and school='$school' and status='placed' ";
                                } else {
                                    $sql = "SELECT round(AVG(salary),2),MAX(salary) FROM placementstatus where branch='$branch' and year='$year' and school='$school' and status='placed'";
                                }
                                $result = mysqli_query($con, $sql);
                                while ($row1 = mysqli_fetch_array($result)) {

                                    echo "<tr><td><div class='scoreitem'>Average salary :</div></td><td><div class='scoreitem'>" . $row1[round('AVG(salary)', 2)] . " LPA </div></td></tr>";
                                    echo "<br />";



                                    echo "<tr><td><div class='scoreitem'>Highest salary :</div> </td><td><div class='scoreitem'>" .  $row1['MAX(salary)'] . " LPA</div></td></tr>";
                                    echo "<br/>";
                                    echo "</div>";
                                }
                                $n = 0;
                                $snoarray = array();
                                $num = "";
                                if (empty($year)) {
                                    echo "<tr><td><div class='scoreitem'>Median Salary :</div></td><td><div class='scoreitem'>LPA</div></td>";
                                } else {
                                    if (empty($school)) {
                                        $m = "SELECT sno FROM placementstatus where  year='$year' and  status='placed' order by salary ASC ";
                                    } elseif (empty($branch)) {
                                        $m = "SELECT sno FROM placementstatus where  year='$year' and school='$school' and status='placed' order by salary ASC ";
                                    } else {
                                        $m = "SELECT sno FROM placementstatus where branch='$branch' and year='$year' and school='$school' and status='placed' order by salary ASC ";
                                    }

                                    $result2 = mysqli_query($con, $m);
                                    if ($result2->num_rows > 0) {
                                        while ($row2 = mysqli_fetch_array($result2)) {

                                            array_push($snoarray, $row2['sno']);
                                        }


                                        if (sizeof($snoarray) % 2 == 0) {

                                            $a = sizeof($snoarray);
                                            $a = $a - 1;
                                            $y = ($a - 1) / 2;
                                            $z = ($a + 1) / 2;
                                            /*     echo $a;
                                            echo "<br>";
                                            echo $y;
                                            echo "<br>";
                                            echo $z;
                                            echo "<br>";    
                                        print_r($snoarray[$y]);*/

                                            if (empty($school)) {
                                                $score = "SELECT round(avg(salary),2) as salvalue  FROM placementstatus WHERE sno in ('$snoarray[$y]','$snoarray[$z]') and  year='$year'  order by salary ASC ";
                                            } elseif (empty($branch)) {
                                                $score = "SELECT round(avg(salary),2) as salvalue  FROM placementstatus WHERE sno in ('$snoarray[$y]','$snoarray[$z]') and  year='$year' and school='$school' order by salary ASC  ";
                                            } else {
                                                $score = "SELECT round(avg(salary),2) as salvalue  FROM placementstatus WHERE sno in ('$snoarray[$y]','$snoarray[$z]') and year='$year' and branch='$branch' and school='$school' order by salary ASC ";
                                            }
                                        } else {

                                            $x = sizeof($snoarray) / 2;
                                            


                                            if (empty($year)) {
                                                $score = "SELECT salary as salvalue FROM placementstatus WHERE sno ='$snoarray[$x]' and status='placed' order by salary ASC ";
                                            } elseif (empty($school)) {
                                                $score = "SELECT salary as salvalue FROM placementstatus WHERE sno ='$snoarray[$x]' and status='placed' and year='$year' order by salary ASC ";
                                            } elseif (empty($branch)) {
                                                $score = "SELECT salary as salvalue FROM placementstatus WHERE sno ='$snoarray[$x]' and year='$year' and school='$school' and status='placed' order by salary ASC  ";
                                            } else {
                                                $score = "SELECT salary as salvalue  FROM placementstatus WHERE sno ='$snoarray[$x]' and branch='$branch' and year='$year' and school='$school' and status='placed' order by salary ASC ";
                                            }
                                        }

                                        $result3 = mysqli_query($con, $score);
                                        if ($result3->num_rows > 0) {
                                            while ($row3 = mysqli_fetch_array($result3)) {


                                                echo "<tr><td><div class='scoreitem'>Median Salary :</div></td><td><div class='scoreitem'>" . $row3['salvalue'] . " LPA</div></td>";
                                            }
                                        }
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

</body>

</html>