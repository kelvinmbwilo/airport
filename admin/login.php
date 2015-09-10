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

        <div class="col-sm-12" style="margin-top: 12%">
            <div class="col-sm-6 col-sm-offset-3">

                <h1 class="text-center"><img class="img-rounded" src="logo.png" style="height: 60px;width: 60px"> Zanzibar International Airport</h1>
                <div class="col-sm-5" >
                    <img src="login.jpg" class="img-responsive img-thumbnail img-rounded">
                </div>
                <div class="col-sm-7">
                    <?php
                    if(isset($_GET['login'])){
                        if($_GET['login'] == 'falue'){
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error!</strong> Incorrect username or Password.
                            </div><?php
                        }
                    } ?>

                    <form method="post" action="process.php?page=login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button><a href="../">Main Page</a>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-sm-12">
            <footer class="text-center" style=" position: fixed;bottom: 0px;width: 100%;background-color: navajowhite">
                <h3 class="text-center">&nbsp; All Right Reserved 2005</h3>
            </footer>
        </div>
    </div>
</div>
</body>
</html>