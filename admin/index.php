<?php
session_start();
if(isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Zanzibar Airport Display System</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../jquery-ui/themes/cupertino/jquery-ui.css">
    <link rel="stylesheet" href="../css/angular-material.css">
    <script src="../js/jquery.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../js/angular.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/angular-route.js"></script>
    <!--<script src="../bower_components/angular-bootstrap/ui-bootstrap.js"></script>-->
    <script src="../bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="../js/angular-aria.js"></script>
    <script src="../js/hammer.js"></script>
    <script src="../js/angular-animate.js"></script>
    <script src="../js/angular-material.js"></script>
    <script src="../angular-ui-date/src/date.js"></script>
    <script src="../DataTables/media/js/jquery.dataTables.js"></script>
    <script src="../angular-datatables/dist/angular-datatables.min.js"></script>
    <script>

        var mainModule = angular.module('airportApp', ["ngRoute","ui.bootstrap",'ngAnimate','ngMaterial',"datatables",'ui.date']);
        mainModule.controller('AppCtrl', function($scope, $http) {
            //When menu button is clicked show the left menu
            $scope.toggleLeft = function() {
                $mdSidenav('left').toggle();
            };
            $scope.closeNav = function() {
                $mdSidenav('left').close();
            };
            $scope.dateOptions = {
                changeYear: true,
                changeMonth: true,
                dateFormat: 'yyyy-mm-dd'
            };
        });
    </script>
    <script src="../js/routes.js"></script>
    <script src="../js/controllers/desinationCtrl.js"></script>
    <script src="../js/controllers/flightCtrl.js"></script>
    <script src="../js/controllers/homeCtrl.js"></script>
    <script src="../js/controllers/timetableCtrl.js"></script>
    <script src="../js/controllers/usersCtrl.js"></script>
    <style>
        html, body{height:100%;}
        #outer{
            min-height:100%;
        }
    </style>
</head>
<body ng-app="airportApp" style="background-color: rgba(65, 65, 68, 0.51);">
<div class="row" id="outer">
<div class="col-sm-12">
<div class="masthead" style="background-color: navajowhite">
    <h3 class="text-center" style="margin-top: 0px">Zanzibar Airport</h3>
    <nav>
        <ul class="nav nav-justified">
            <li><a href="#home"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#timetable"><i class="fa fa-table"></i> Timetable</a></li>
            <li><a href="#flight"><i class="fa fa-plane"></i> Flights</a></li>
            <li><a href="#destination"><i class="fa fa-location-arrow"></i> Destinations</a></li>
            <li><a href="#users"><i class="fa fa-location-arrow"></i> Users</a></li>
            <li><a href="process.php?page=logout" title="loging out <?php echo $_SESSION['name'] ?>"><i class="fa fa-power-off"></i> <?php echo $_SESSION['name'] ?></a></li>
        </ul>
    </nav>
</div>
    <div class="col-sm-12" style="padding-bottom: 60px">
<ng-view></ng-view>
    </div>
    <div class="col-sm-12">
<footer class="text-center" style=" position: fixed;bottom: 0px;width: 100%;background-color: navajowhite">
    <h3 class="text-center">&nbsp; All Right Reserved 2005 Mozeti CO LTD</h3>
</footer>
    </div>
</div>
</div>
</body>
</html>
<?php
}else{
    header("Location: login.php");
}
    ?>