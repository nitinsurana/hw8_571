var app = angular.module('app', ['angularUtils.directives.dirPagination']);

app.controller('MainController', function MainController() {

});
app.controller('ContentController', function ContentController($scope, $http) {
    var self = this;
    $scope.results = [];
    $scope.states =["Alabama","Montana","Alaska","Nebraska","Arizona","Arkansas","Colorado","Nevada","New Hampshire","California","New Jersey","New Mexico","Connecticut","New York","Delaware","North Carolina","District Of Columbia","North Dakota","Florida","Ohio","Georgia","Oklahoma","Hawaii","Oregon","Idaho","Pennsylvania","Illinois","Rhode Island","Indiana","South Carolina","Iowa","South Dakota","Kansas","Tennessee","Kentucky","Texas","Louisiana","Utah","Maine","Vermont","Maryland","Virginia","Massachusetts","Washington","Michigan","West Virginia","Minnesota","Wisconsin","Mississippi","Wyoming","Missouri"];
    // $scope.page = 1;
    // $scope.itemsPerPage = 10;
    $http.get('api.php?submit=true&db=Legislators&keyword=&chamber=&page=' + $scope.page).then(function (response) {
        $scope.results = response.data.results;
        $scope.itemsPerPage = 10;
    });

    $scope.onTabSelect = function (e) {

    }
});