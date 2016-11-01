window.API_KEY = '682b365f52874343b644bc3d6a0149e4';

var app = angular.module('app', ['angularUtils.directives.dirPagination']);

app.controller('MainController', function MainController() {

});
app.controller('LegislatorController',function LegislatorController() {

});

app.controller('LegislatorStateController', function ContentController($scope, $http) {
    var self = this;
    $scope.results = [];
    $scope.states = ["Alabama", "Montana", "Alaska", "Nebraska", "Arizona", "Arkansas", "Colorado", "Nevada", "New Hampshire", "California", "New Jersey", "New Mexico", "Connecticut", "New York", "Delaware", "North Carolina", "District Of Columbia", "North Dakota", "Florida", "Ohio", "Georgia", "Oklahoma", "Hawaii", "Oregon", "Idaho", "Pennsylvania", "Illinois", "Rhode Island", "Indiana", "South Carolina", "Iowa", "South Dakota", "Kansas", "Tennessee", "Kentucky", "Texas", "Louisiana", "Utah", "Maine", "Vermont", "Maryland", "Virginia", "Massachusetts", "Washington", "Michigan", "West Virginia", "Minnesota", "Wisconsin", "Mississippi", "Wyoming", "Missouri"];
    $http.get('api.php?submit=true&db=Legislators&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        $scope.results = response.data.results;
        $scope.itemsPerPage = 10;
    });

    $scope.showLegislatorDetails = function (bioguideId) {
        var result = $scope.results.find(function (o) {
            return (o.bioguide_id === bioguideId);
        });
        var l = $scope.legislator = result;
        $scope.legislator.favourite = window.localStorage.getItem('legislator-'+l.bioguide_id) && true;
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

    $scope.toggleLocalStorageFavourite = function (bioguideId) {
        if (window.localStorage.getItem('legislator-' + bioguideId)) {
            window.localStorage.removeItem('legislator-' + bioguideId);
        } else {
            window.localStorage.setItem('legislator-' + bioguideId, bioguideId);
        }
        $scope.legislator.favourite = !$scope.legislator.favourite;
    }
});

app.controller('LegislatorHouseController',function LegislatorHouseController($scope, $http){
    var self = this;
    $scope.results = [];
    $http.get('api.php?submit=true&db=Legislators&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        $scope.results = response.data.results;
    });

    $scope.showLegislatorDetails = function (bioguideId) {
        var result = $scope.results.find(function (o) {
            return (o.bioguide_id === bioguideId);
        });
        var l = $scope.legislator = result;
        $scope.legislator.favourite = window.localStorage.getItem('legislator-'+l.bioguide_id) && true;
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

    $scope.toggleLocalStorageFavourite = function (bioguideId) {
        if (window.localStorage.getItem('legislator-' + bioguideId)) {
            window.localStorage.removeItem('legislator-' + bioguideId);
        } else {
            window.localStorage.setItem('legislator-' + bioguideId, bioguideId);
        }
        $scope.legislator.favourite = !$scope.legislator.favourite;
    }
});