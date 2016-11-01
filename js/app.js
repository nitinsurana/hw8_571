//TODO remove direct calls to API and replace with api.php proxying them
//TODO Fix dates
//TODO Fix menu collapse
//TODO Ask for pagination in bills ?
//TODO Maybe split the legislators table in a separate angularjs component & template in .html file
//TODO Report - ActiveBills tab is missing title in the table's description but it shows up in the pdf screenshot
//TODO show loader while any table is loading for e.g. legislator
//TODO show "no data found" message in legislator_details when no data found
//TODO Combine all .php files into 2 files - index.php & api.php
//TODO row heading bold e.g. (Bill ID : abcd) or (State : New Jersey)
//TODO sort the states dropdown/select in legislators screen
//TODO Menu toggle on click
//TODO Mobile screen responsiveness (check the video)
//TODO deploy on AWS for 571
//TODO instead of creating entirely new active & new bills <table> => create a component and use it with different filters
//TODO fix the 404s for legislators' bioguide_id.jpg
//TODO chamber has a 3rd possible value => joint(s.svg) =>handle in all tabs for legislator, bills, committee
//TODO after selecting a favorite, the favorites menu doesn't load again to show the newly added favorites because the controller does not execute again


window.API_KEY = '682b365f52874343b644bc3d6a0149e4';

var app = angular.module('app', ['angularUtils.directives.dirPagination']);

app.controller('MainController', function MainController($scope) {
    $scope.menu = 'legislators';
});

app.controller('FavoritesController', function ($scope) {
    $scope.fetch = function (k) {
        var results = [];
        var length = window.localStorage.length;
        for (var i = 0; i < length; i++) {
            var key = window.localStorage.key(i);
            if (key.indexOf(k) == 0) {
                var r = window.localStorage.getItem(window.localStorage.key(i));
                results.push(JSON.parse(r));
            }
        }
        return results;
    };
});
app.controller('FavoritesLegislatorController', function ($scope) {
    $scope.results = $scope.fetch('legislator-');
    $scope.navigateToRoute = function () {

    };
    $scope.navigateToBillRoute = function () {

    };
    $scope.removeFavorite = function (key, index) {
        window.localStorage.removeItem(key);
        $scope.results.splice(index, 1);
    }
});
app.controller('FavoritesBillController', function ($scope) {
    $scope.results = $scope.fetch('bill-');
    $scope.removeFavorite = function (key, index) {
        window.localStorage.removeItem(key);
        $scope.results.splice(index, 1);
    }
});
app.controller('FavoritesCommitteeController', function ($scope) {
    $scope.results = $scope.fetch('committee-');
    $scope.removeFavorite = function (key, index) {
        window.localStorage.removeItem(key);
        $scope.results.splice(index, 1);
    }
});

app.controller('CommitteeController', function ($scope, $http) {
    $scope.results = [];
    $http.get('api.php?submit=true&db=Committees&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        var results = response.data.results;
        results.forEach(function (o) {
            if (window.localStorage.getItem('committee-' + o.committee_id)) {
                o.favorite = true;
            } else {
                o.favorite = false;
            }
        });
        $scope.results = results;
        $scope.itemsPerPage = 10;
    });
    $scope.toggleLocalStorageFavorite = function (committee_id) {
        var r = $scope.results.find(function (o) {
            return o.committee_id === committee_id;
        });
        if (window.localStorage.getItem('committee-' + committee_id)) {
            window.localStorage.removeItem('committee-' + committee_id);
        } else {
            window.localStorage.setItem('committee-' + committee_id, JSON.stringify(r));
        }
        r.favorite = !r.favorite;
    }
});
app.controller('CommitteeHouseController', function () {

});
app.controller('CommitteeSenateController', function () {

});
app.controller('CommitteeJointController', function () {

});


app.controller('BillsController', function BillsController($scope, $http) {
    $scope.results = [];
    $http.get('api.php?submit=true&db=Bills&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        $scope.results = response.data.results;
        $scope.itemsPerPage = 10;
    });
    $scope.showBillDetails = function (bill_id) {
        var result = $scope.results.find(function (o) {
            return o.bill_id === bill_id;
        });
        var b = $scope.bill = result;
        $scope.bill.favorite = window.localStorage.getItem('bill-' + b.bill_id) && true;
        $("#carousel-bills").carousel('next');
    };
    $scope.showPrevTabCarousel = function () {
        $("#carousel-bills").carousel('prev');
    };
    $scope.toggleLocalStorageFavorite = function (bioguideId) {
        if (window.localStorage.getItem('bill-' + bioguideId)) {
            window.localStorage.removeItem('bill-' + bioguideId);
        } else {
            window.localStorage.setItem('bill-' + bioguideId, JSON.stringify($scope.bill));
        }
        $scope.bill.favorite = !$scope.bill.favorite;
    }
});
app.controller('BillsActiveController', function BillsActiveController($scope, $http) {

});
app.controller('BillsNewController', function BillsNewController($scope, $http) {

});

app.controller('LegislatorController', function LegislatorController($scope, $http) {
    $scope.results = [];
    $http.get('api.php?submit=true&db=Legislators&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        $scope.results = response.data.results;
        $scope.itemsPerPage = 10;
    });

    $scope.showLegislatorDetails = function (bioguideId) {
        var result = $scope.results.find(function (o) {
            return (o.bioguide_id === bioguideId);
        });
        var l = $scope.legislator = result;
        $scope.legislator.favorite = window.localStorage.getItem('legislator-' + l.bioguide_id) && true;
        $("#carousel-legislators").carousel('next');
        $http.get('http://congress.api.sunlightfoundation.com/committees?per_page=5&member_ids=' + bioguideId + '&apikey=' + window.API_KEY).then(function (response) {
            if (response.data.results && response.data.results.length > 0) {
                $scope.legislator.committees = response.data.results;
            }
        });
        $http.get('http://congress.api.sunlightfoundation.com/bills?per_page=5&sponsor_id=' + bioguideId + '&apikey=' + window.API_KEY).then(function (response) {
            if (response.data.results && response.data.results.length > 0) {
                $scope.legislator.bills = response.data.results;
            }
        });
    };

    $scope.showPrevTabCarousel = function () {
        $("#carousel-legislators").carousel('prev');
    };

    $scope.toggleLocalStorageFavorite = function (bioguideId) {
        if (window.localStorage.getItem('legislator-' + bioguideId)) {
            window.localStorage.removeItem('legislator-' + bioguideId);
        } else {
            window.localStorage.setItem('legislator-' + bioguideId, JSON.stringify($scope.legislator));
        }
        $scope.legislator.favorite = !$scope.legislator.favorite;
    }
});

app.controller('LegislatorStateController', function LegislatorStateController($scope, $http) {
    var self = this;
    $scope.states = ["Alabama", "Montana", "Alaska", "Nebraska", "Arizona", "Arkansas", "Colorado", "Nevada", "New Hampshire", "California", "New Jersey", "New Mexico", "Connecticut", "New York", "Delaware", "North Carolina", "District Of Columbia", "North Dakota", "Florida", "Ohio", "Georgia", "Oklahoma", "Hawaii", "Oregon", "Idaho", "Pennsylvania", "Illinois", "Rhode Island", "Indiana", "South Carolina", "Iowa", "South Dakota", "Kansas", "Tennessee", "Kentucky", "Texas", "Louisiana", "Utah", "Maine", "Vermont", "Maryland", "Virginia", "Massachusetts", "Washington", "Michigan", "West Virginia", "Minnesota", "Wisconsin", "Mississippi", "Wyoming", "Missouri"];
});

app.controller('LegislatorHouseController', function LegislatorHouseController($scope, $http) {
    var self = this;
});

app.controller('LegislatorSenateController', function LegislatorHouseController($scope, $http) {
    var self = this;
});