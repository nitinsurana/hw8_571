<div class="col-sm-9 col-md-10 content" ng-controller="BillsController" ng-show="menu==='bills'">
    <h1>Bills</h1>
    <hr>

    <div id="carousel-bills" class="carousel slide" data-ride="carousel" data-interval="">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="tab-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#bills-active" role="tab" data-toggle="tab">Active Bills</a></li>
                        <li role="presentation"><a href="#bills-new" role="tab" data-toggle="tab">New Bills</a></li>
                    </ul>
                    <div class="tab-content">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="bills-active" ng-controller="BillsActiveController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <input type="text" class="form-control" name="bills-search" ng-model="search" placeholder="Search">
                                            </div>
                                            <h3 class="panel-title">Active Bills</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table  table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Bill ID</th>
                                            <th>Bill Type</th>
                                            <th>Title</th>
                                            <th>Chamber</th>
                                            <th>Introduced On</th>
                                            <th>Sponsor</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr dir-paginate="b in results | filter:b.history.active | filter:search | itemsPerPage: 10" pagination-id="bills-active">
                                            <td class="text-uppercase">{{b.bill_id}}</td>
                                            <td class="text-uppercase">{{b.bill_type}}</td>
                                            <td>{{b.official_title}}</td>
                                            <td class="text-capitalize">
                                                <img ng-if="b.chamber==='house'" src="images/h.png" height="20" width="20"/>
                                                <img ng-if="b.chamber==='senate'" src="images/s.svg" height="20" width="20"/>
                                                {{b.chamber}}
                                            </td>
                                            <td>{{b.introduced_on}}</td>
                                            <td>{{b.sponsor.title+' '+b.sponsor.first_name+' '+ b.sponsor.last_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" ng-click="showBillDetails(b.bill_id)">View Details</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <dir-pagination-controls pagination-id="bills-active"></dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="bills-new" ng-controller="BillsNewController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <input type="text" class="form-control" name="house-search" ng-model="search" placeholder="Search">
                                            </div>
                                            <h3 class="panel-title">Legislators By House</h3>
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
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr dir-paginate="r in results | filter:{chamber:'senate'} | filter:search | itemsPerPage: 10" pagination-id="legislators-senate">
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
                                            <td>{{r.state_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" ng-click="showLegislatorDetails(r.bioguide_id)">View Details</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <dir-pagination-controls pagination-id="legislators-senate"></dir-pagination-controls>
                                    </div>
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
                                <button class="btn btn-default" ng-click="toggleLocalStorageFavourite(bill.bill_id)"><i class="fa {{bill.favourite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;
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
                                <td>Bill ID</td>
                                <td class="text-uppercase">{{bill.bill_id}}</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{bill.official_title}}</td>
                            </tr>
                            <tr>
                                <td>Bill Type</td>
                                <td class="text-uppercase">{{bill.bill_type}}</td>
                            </tr>
                            <tr>
                                <td>Sponsor</td>
                                <td>{{bill.sponsor.title+' '+bill.sponsor.first_name+' '+bill.sponsor.last_name}}</td>
                            </tr>
                            <tr>
                                <td>Chamber</td>
                                <td class="text-capitalize">{{bill.chamber}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{bill.history.active?'Active':'New'}}</td>
                            </tr>
                            <tr>
                                <td>Introduced On</td>
                                <td>{{bill.introduced_on}}</td>
                            </tr>
                            <tr>
                                <td>Congress URL</td>
                                <td><a href="{{bill.urls.congress}}">URL</a></td>
                            </tr>
                            <tr>
                                <td>Version Status</td>
                                <td>{{bill.last_version.version_name}}</td>
                            </tr>
                            <tr>
                                <td>Bill URL</td>
                                <td><a ng-if="bill.last_version.urls && bill.last_version.urls.pdf" href="{{bill.last_version.urls.pdf}}">URL</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <object data="{{bill.last_version.urls.pdf}}" type="application/pdf">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>