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
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</head>
<body ng-controller="MainController">
<div class="container-fluid">
    <div class="header">
        <div class="row">
            <div class="col-xs-3 col-sm-2">
                <div class="navbar-default">
                    <button type="button" class="pull-left navbar-toggle" style="display: block;" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="col-xs-9 col-sm-10 text-center">
                <a href="http://sunlightfoundation.com/" target="_blank" class=""><img src="images/logo.png" alt="" height="40" width="80"></a>
                CONGRESS API
            </div>
        </div>
    </div>
    <div class="body">
        <div class="col-md-2 col-sm-3 side-nav">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-user"></i>&nbsp;&nbsp;Legislators</a></li>
                <li><a href="#"><i class="fa fa-file"></i>&nbsp;&nbsp;Bills</a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Committees</a></li>
                <li><a href="#"><i class="fa fa-star"></i>&nbsp;&nbsp;Favorites</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 content" ng-controller="LegislatorController">
            <h1>Legislators</h1>
            <hr>

            <div id="carousel-legislators" class="carousel slide" data-ride="carousel" data-interval="">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="tab-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">By State</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">House</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Senate</a></li>
                            </ul>
                            <div class="tab-content">
                                <br>
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <select name="state-filter" ng-model="stateFilter" class="form-control" ng-options="state for state in states">
                                                            <option value="">All States</option>
                                                        </select>
                                                    </div>
                                                    <h3 class="panel-title">Legislators By State</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table  table-responsive">
                                                <thead>
                                                <tr>
                                                    <th>Party</th>
                                                    <th>Name</th>
                                                    <th>Chamber</th>
                                                    <th>District</th>
                                                    <th>State</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr dir-paginate="r in results | filter:(!!stateFilter || undefined) && {state_name: stateFilter} | itemsPerPage: 10">
                                                    <td>
                                                        <img ng-if="(r.party && r.party==='R')" src="images/r.png" class="img-responsive" height="20" width="20">
                                                        <img ng-if="(r.party && r.party==='D')" src="images/r.png" class="img-responsive" height="20" width="20">
                                                    </td>
                                                    <td>{{r.first_name+' '+ r.last_name}}</td>
                                                    <td class="text-capitalize">
                                                        <img ng-if="r.chamber==='house'" src="images/h.png" height="20" width="20"/>
                                                        <img ng-if="r.chamber==='senate'" src="images/s.svg" height="20" width="20"/>
                                                        {{r.chamber}}
                                                    </td>
                                                    <td class="text-capitalize">{{r.district? ('District '+r.district) : 'N/A'}}</td>
                                                    <td>{{r.state_name}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" ng-click="showLegislatorDetails(r.bioguide_id)">View Details</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <dir-pagination-controls></dir-pagination-controls>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <table class="table  table-responsive table-striped">
                                        <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="r in results">
                                            <td>{{r.first_name}}</td>
                                            <td>{{r.last_name}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <table class="table  table-responsive table-striped">
                                        <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="r in results">
                                            <td>{{r.first_name}}</td>
                                            <td>{{r.last_name}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>
                                    <button class="btn btn-default" ng-click="showPrevTabCarousel()"><i class="fa fa-chevron-left"></i>&nbsp;</button>
                                    Details
                                    <div class="pull-right">
                                        <button class="btn btn-default" ng-click="toggleLocalStorageFavourite(legislator.bioguide_id)"><i class="fa {{legislator.favourite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;</button>
                                    </div>
                                </h2>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-responsive">
                                    <tbody>
                                    <tr>
                                        <td rowspan="6" class="text-center">
                                            <img height="200" ng-if="legislator && legislator.bioguide_id" src="https://theunitedstates.io/images/congress/original/{{legislator.bioguide_id}}.jpg">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{legislator.title +' '+legislator.first_name + ' '+legislator.last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="mailto:{{legislator.oc_email}}">{{legislator.oc_email}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Chamber : {{legislator.chamber}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contact :{{legislator.phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span ng-if="legislator.party==='D'"><img src="images/d.png" alt="" height="20"> Democrat</span>
                                            <span ng-if="legislator.party==='R'"><img src="images/r.png" alt="" height="20"> Republic</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Start Term</td>
                                        <td>{{legislator.term_start}}</td> <!-- todo format date using moment.js -->
                                    </tr>
                                    <tr>
                                        <td>End Term</td>
                                        <td>{{legislator.term_end}}</td><!-- todo format date using moment.js -->
                                    </tr>
                                    <tr>
                                        <td>Term</td>
                                        <td><!-- TODO show a progress bar --></td>
                                    </tr>
                                    <tr>
                                        <td>Office</td>
                                        <td>{{legislator.office}}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{legislator.state}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>{{legislator.fax}}</td>
                                    </tr>
                                    <tr>
                                        <td>Birthday</td>
                                        <td>{{legislator.birthday}}</td>
                                    </tr>
                                    <tr>
                                        <td>Social Links</td>
                                        <td>
                                            <a ng-if="legislator.facebook_id" href="https://facebook.com/{{legislator.facebook_id}}">
                                                <img src="images/fb.png" alt="" height="30">
                                            </a>
                                            <a ng-if="legislator.twitter_id" href="https://facebook.com/{{legislator.twitter_id}}">
                                                <img src="images/t.png" alt="" height="30">
                                            </a>
                                            <a ng-if="legislator.website" href="https://facebook.com/{{legislator.website}}">
                                                <img src="images/w.png" alt="" height="30">
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h3>Committees</h3>
                                <table class="table table-responsiveness">
                                    <thead>
                                    <tr>
                                        <th>Chamber</th>
                                        <th>Committee ID</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="c in legislator.committees">
                                        <td class="text-capitalize">
                                            {{c.chamber}}
                                        </td>
                                        <td>
                                            {{c.committee_id}}
                                        </td>
                                        <td>
                                            {{c.name}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <h3>Bills</h3>
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Bill ID</th>
                                        <th>Title</th>
                                        <th>Chamber</th>
                                        <th>Bill Type</th>
                                        <th>Congress</th>
                                        <th>Link</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="b in legislator.bills">
                                        <td class="text-uppercase">{{b.bill_id}}</td>
                                        <td>{{b.official_title}}</td>
                                        <td>{{b.chamber}}</td>
                                        <td>{{b.bill_type}}</td>
                                        <td>{{b.congress}}</td>
                                        <td>
                                            <a ng-if="b.last_version && b.last_version.urls && b.last_version.urls.pdf" href="{{b.last_version && b.last_version.urls && b.last_version.urls.pdf}}">Link</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
