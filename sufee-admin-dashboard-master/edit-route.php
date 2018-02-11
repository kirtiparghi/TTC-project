<?php
if (isset($_GET["id"]) == FALSE) {
  // missing an id parameters, so
  // redirect person back to add employee page
  header("Location: " . "index.html");
  exit();
}

$id = $_GET["id"];

// @TODO: Your code should show the person's information in the form

// @TODO: your database code should  here
//---------------------------------------------------
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "college_ttc";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql 	 = "SELECT * FROM route ";
$sql 	.= "WHERE id='" . $id . "'";

$results = mysqli_query($connection, $sql);
      
if ($results == FALSE) {
  // there was an error in the sql 
  echo "Database query failed. <br/>";
  echo "SQL command: " . $query;
  exit();
}

$routes = mysqli_fetch_assoc($results);

//---------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // get items from DATABASE
  $newroute = [];
  $newroute["rno"] = $_POST['routeNumber'];
  $newroute["bno"] = $_POST['busNumber'];
  $newroute["src"] = $_POST['source'];
  $newroute["dest"] = $_POST['destination'];
  $newroute["arrTime"] = $_POST['arrivalTime'];
  $newroute["deptTime"] = $_POST['departTime'];
  $newroute["is_available_Sat"] = $_POST['is_available_Saturday'];

    $sql2 	 = "UPDATE route SET ";
    $sql2 	.= "routeNumber='" . $newroute["rno"] . "', ";
    $sql2 	.= "busNumber='" . $newroute["bno"] . "', ";
    $sql2 	.= "source='" . $newroute["src"] . "', ";
    $sql2 	.= "destination='" . $newroute["dest"] . "', ";
    $sql2 	.= "arrivalTime='" . $newroute["arrTime"] . "', ";
    $sql2 	.= "departTime='" . $newroute["deptTime"] . "', ";
    $sql2 	.= "is_available_Saturday='" . $newroute["is_available_Sat"] . "' ";
    $sql2 	.= "WHERE id= '" . $id . "' ";
  
    $results2 = mysqli_query($connection, $sql2);
   
    if ($results2 == FALSE) {
      // there was an error in the sql 
      echo "Database query failed. <br/>";
      echo "SQL command: " . $sql2;
      exit();
    }else{
        // 5. Close database connection
        mysqli_close($connection);
        header("Location: " . "tables-basic.php"); 
    }

  //---------------------------------------------------

  // @TODO: delete these two statement after your add your db code

}

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Routes</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                            <a href="tables-basic.php"><i class="menu-icon fa fa-table"></i>View All Routes</a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="add-route.php"> <i class="menu-icon fa fa-laptop"></i>Add a Route</a>
                    </li>

                    <h3 class="menu-title">Manage User</h3><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#"> <i class="menu-icon fa fa-tasks"></i>Add user</a>  
                    </li>

                    <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                    <li class="menu-item">
                        <a href="#"> <i class="menu-icon fa fa-glass"></i>Logout</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">5</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                          </div>
                        </div>

                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary">9</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                            <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language" >
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Forms</a></li>
                            <li class="active">Basic</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">
            <div class="animated fadeIn">

                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header"><strong>Route Update</strong><small> Form</small></div>
                      <div class="card-body card-block">
                        <form action = "<?php echo "edit-route.php?id=" . $id; ?>" method="POST" >
                            <div class="form-group"><label for="Route Number" class=" form-control-label">Route Number</label><input type="text" name="routeNumber"  value = <?php echo $routes["routeNumber"] ?> class="form-control"></div>
                            <div class="form-group"><label for="Bus Number" class=" form-control-label">Bus Number</label><input type="text" name="busNumber" value = <?php echo $routes["busNumber"] ?> class="form-control"></div>
                            <div class = "row">
                              <div class="col-lg-6">
                                <div class="form-group"><label for="Source" class=" form-control-label">Source</label><input type="text" name="source"  value = <?php echo $routes["source"] ?> class="form-control"></div>
                              </div>
                              <div class="col-lg-6">
                              <div class="form-group"><label for="Destination" class=" form-control-label">Destination</label><input type="text" name="destination"  value = <?php echo $routes["destination"] ?> class="form-control"></div>
                              </div>
                            </div>
                            <div class = "row">
                              <div class="col-lg-6">
                                <div class="form-group"><label for="Arrival Time" class=" form-control-label">Arrival Time</label><input type="text" name="arrivalTime"  value = <?php echo $routes["arrivalTime"] ?> class="form-control"></div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group"><label for="Depart Time" class=" form-control-label">Departure Time</label><input type="text" name="departTime"  value = <?php echo $routes["departTime"] ?> class="form-control"></div>
                              </div>
                            </div>
                            
                            <div class="form-group"><label for="SaturdayAvailable" class=" form-control-label">Saturday Availability</label><input type="text" name="is_available_Saturday"  value = <?php echo $routes["is_available_Saturday"] ?> class="form-control"></div>
                            <p>
                            <input type="submit" value="Update route" />
                            </p>
                        </form>
                    </div>
                  </div>

                  </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    
  </body>
</html>
