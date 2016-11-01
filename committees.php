<div class="col-sm-9 col-md-10 content" ng-controller="CommitteeController" ng-show="menu==='committees'">
    <h1>Committees</h1>
    <hr>

    <div id="carousel-committees" class="carousel slide" data-ride="carousel" data-interval="">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="tab-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#committee-house" role="tab" data-toggle="tab">House</a></li>
                        <li role="presentation"><a href="#committee-senate" role="tab" data-toggle="tab">Senate</a></li>
                        <li role="presentation"><a href="#committee-joint" aria-controls="messages" role="tab" data-toggle="tab">Joint</a></li>
                    </ul>
                    <div class="tab-content">
                        <br>
                        <div role="tabpanel" class="tab-pane active" id="committee-house" ng-controller="CommitteeHouseController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <input type="text" class="form-control" name="house-search" ng-model="search" placeholder="Search">
                                            </div>
                                            <h3 class="panel-title">House</h3>
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
                                            <th>Contact</th>
                                            <th>Office</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr dir-paginate="r in results | filter:{chamber:'house'} |filter:search | itemsPerPage: 10" pagination-id="committee-house">
                                            <td>
                                                <button class="btn btn-default" ng-click="toggleLocalStorageFavourite(r.committee_id)"><i class="fa {{r.favourite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;
                                                </button>
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
                                            <td>{{r.phone}}</td>
                                            <td>{{r.office}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <dir-pagination-controls pagination-id="committee-house"></dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="committee-senate" ng-controller="CommitteeSenateController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <input type="text" class="form-control" name="house-search" ng-model="search" placeholder="Search">
                                            </div>
                                            <h3 class="panel-title">Senate</h3>
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
                                            <th>Contact</th>
                                            <th>Office</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr dir-paginate="r in results | filter:{chamber:'senate'} |filter:search | itemsPerPage: 10" pagination-id="committee-senate">
                                            <td>
                                                <button class="btn btn-default" ng-click="toggleLocalStorageFavourite(r.committee_id)"><i class="fa {{r.favourite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;
                                                </button>
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
                                            <td>{{r.phone}}</td>
                                            <td>{{r.office}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <dir-pagination-controls pagination-id="committee-senate"></dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="committee-joint"  ng-controller="CommitteeJointController">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <input type="text" class="form-control" name="house-search" ng-model="search" placeholder="Search">
                                            </div>
                                            <h3 class="panel-title">Joint</h3>
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
                                            <th>Contact</th>
                                            <th>Office</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr dir-paginate="r in results | filter:{chamber:'joint'} | filter:search | itemsPerPage: 10" pagination-id="committee-joint">
                                            <td>
                                                <button class="btn btn-default" ng-click="toggleLocalStorageFavourite(r.committee_id)"><i class="fa {{r.favourite ? 'fa-star':'fa-star-o'}}"></i>&nbsp;
                                                </button>
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
                                            <td>{{r.phone}}</td>
                                            <td>{{r.office}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <dir-pagination-controls pagination-id="committee-joint"></dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>