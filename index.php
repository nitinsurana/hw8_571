<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homework #8</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="css/main.css" rel="stylesheet">


    <script src="js/lib/jquery.js"></script>
    <script src="js/lib/angular.js"></script>
    <script src="js/lib/dirPagination.js"></script>
    <script src="js/lib/angular-route.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</head>
<body ng-controller="MainController">
<div class="container-fluid">
    <div class="header">
        <div class="row">
            <div class="col-xs-3 col-xs-2">
                <div class="navbar-default">
                    <button type="button" class="pull-left navbar-toggle" style="display: block;" ng-click="sidenavVisible=!sidenavVisible">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="col-xs-9 col-xs-10 text-center">
                <a href="http://sunlightfoundation.com/" target="_blank" class=""><img src="images/logo.png" alt="" height="40" width="80"></a>
                CONGRESS API
            </div>
        </div>
    </div>
    <div class="body">
        <div class="col-md-2 col-xs-2 side-nav" ng-show="sidenavVisible">
            <ul class="nav nav-pills nav-stacked">
                <li ng-click="menu='legislators'" ng-class="menu=='legislators'?'active':''"><a href="#/"><i class="fa fa-user"></i><span class="hidden-xs">&nbsp;&nbsp;Legislators</span></a></li>
                <li ng-click="menu='bills'" ng-class="menu=='bills'?'active':''"><a href="#bills"><i class="fa fa-file"></i><span class="hidden-xs">&nbsp;&nbsp;Bills</span></a></li>
                <li ng-click="menu='committees'" ng-class="menu=='committees'?'active':''"><a href="#committees"><i class="fa fa-sign-out"></i><span class="hidden-xs">&nbsp;&nbsp;Committees</span></a></li>
                <li ng-click="menu='favorites'" ng-class="menu=='favorites'?'active':''"><a href="#favorites"><i class="fa fa-star"></i><span class="hidden-xs">&nbsp;&nbsp;Favorites</span></a></li>
            </ul>
        </div>
        <div class="{{sidenavVisible?'col-xs-10 col-md-10':'col-xs-12 col-md-12'}} content" ng-view></div>
    </div>
</div>
</body>
</html>
