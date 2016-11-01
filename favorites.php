<div class="col-sm-9 col-md-10 content" ng-controller="FavoritesController" ng-show="menu==='favorites'">
    <h1>Favorites</h1>
    <hr>

    <div id="carousel-favorites" class="carousel slide" data-ride="carousel" data-interval="">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="tab-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#favorites-legislators" role="tab" data-toggle="tab">Legislators</a></li>
                        <li role="presentation"><a href="#favorites-bills" role="tab" data-toggle="tab">Bills</a></li>
                        <li role="presentation"><a href="#favorites-committees" aria-controls="messages" role="tab" data-toggle="tab">Committees</a></li>
                    </ul>
                    <div class="tab-content">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="favorites-legislators" ng-controller="FavoritesLegislatorController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="panel-title">Favorite Legislators</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table  table-responsive">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Party</th>
                                            <th>Name</th>
                                            <th>Chamber</th>
                                            <th>State</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="r in results">
                                            <td>
                                                <button class="btn btn-default" ng-click="removeFavorite('legislator-'+r.bioguide_id, $index)"><i class="fa fa-trash"></i>&nbsp;</button>
                                            </td>
                                            <td>
                                                <img height="20" ng-if="r && r.bioguide_id" src="https://theunitedstates.io/images/congress/original/{{r.bioguide_id}}.jpg">
                                            </td>
                                            <td>
                                                <img ng-if="(r.party && r.party==='R')" src="images/r.png" class="img-responsive" height="20" width="20">
                                                <img ng-if="(r.party && r.party==='D')" src="images/r.png" class="img-responsive" height="20" width="20">
                                            </td>
                                            <td>{{r.last_name+', '+ r.first_name}}</td>
                                            <td class="text-capitalize">
                                                <img ng-if="r.chamber==='house'" src="images/h.png" height="20" width="20"/>
                                                <img ng-if="r.chamber==='senate'" src="images/s.svg" height="20" width="20"/>
                                                <img ng-if="r.chamber==='joint'" src="images/s.svg" height="20" width="20"/>
                                                {{r.chamber}}
                                            </td>
                                            <td>{{r.state_name}}</td>
                                            <td>
                                                <a href="mailto:{{r.oc_email}}">{{r.oc_email}}</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" ng-click="navigateToRoute(r.bioguide_id)">View Details</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="favorites-bills" ng-controller="FavoritesBillController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="panel-title">Favorite Bills</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table  table-responsive">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th>Party</th>
                                            <th>Name</th>
                                            <th>Chamber</th>
                                            <th>State</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="r in results">
                                            <td>
                                                <button class="btn btn-default" ng-click="removeFavorite('bill-'+r.bill_id, $index)"><i class="fa fa-trash"></i>&nbsp;</button>
                                            </td>
                                            <td class="text-uppercase">
                                                {{r.bill_id}}
                                            </td>
                                            <td class="text-uppercase">
                                                {{r.bill_type}}
                                            </td>
                                            <td>{{r.official_title}}</td>
                                            <td class="text-capitalize">
                                                <img ng-if="r.chamber==='house'" src="images/h.png" height="20" width="20"/>
                                                <img ng-if="r.chamber==='senate'" src="images/s.svg" height="20" width="20"/>
                                                <img ng-if="r.chamber==='joint'" src="images/s.svg" height="20" width="20"/>
                                                {{r.chamber}}
                                            </td>
                                            <td>{{r.introduced_on}}</td>
                                            <td>{{r.sponsor.title+', '+r.sponsor.last_name+', '+r.sponsor.last_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" ng-click="navigateToBillRoute(r.bill_id)">View Details</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="favorites-committees" ng-controller="FavoritesCommitteeController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="panel-title">Favorite Committees</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table  table-responsive">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Chamber</th>
                                            <th>Committee ID</th>
                                            <th>Name</th>
                                            <th>Parent Committee</th>
                                            <th>Sub Committee</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="r in results">
                                            <td>
                                                <button class="btn btn-default" ng-click="removeFavorite('legislator-'+r.bioguide_id, $index)"><i class="fa fa-trash"></i>&nbsp;</button>
                                            </td>
                                            <td class="text-capitalize">
                                                <img ng-if="r.chamber==='house'" src="images/h.png" height="20" width="20"/>
                                                <img ng-if="r.chamber==='senate'" src="images/s.svg" height="20" width="20"/>
                                                <img ng-if="r.chamber==='joint'" src="images/s.svg" height="20" width="20"/>
                                                {{r.chamber}}
                                            </td>
                                            <td>{{r.committee_id}}</td>
                                            <td>{{r.name}}</td>
                                            <td>{{r.parent_committee_id}}</td>
                                            <td>{{r.subcommittee}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                <button class="btn btn-default" ng-click="toggleLocalStorageFavorite(legislator.bioguide_id)"><i class="fa {{legislator.favorite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;
                                </button>
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
                                    <a ng-if="legislator.facebook_id" href="https://facebook.com/{{legislator.facebook_id}}"><img src="images/fb.png" alt="" height="30"></a>
                                    <a ng-if="legislator.twitter_id" href="https://twitter.com/{{legislator.twitter_id}}"><img src="images/t.png" alt="" height="30"></a>
                                    <a ng-if="legislator.website" href="{{legislator.website}}"><img src="images/w.png" height="30"></a>
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