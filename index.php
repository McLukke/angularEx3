<html ng-app="countryApp">
<?php include('partials/head.html'); ?>
<body>
<div ng-view>
	Routing<br />Getting started<br /><br />
</div>
<script>
	var countryApp = angular.module('countryApp', ['ngRoute']);

	countryApp.config(function($routeProvider) {
		$routeProvider.
		when('/', {
			templateUrl: 'country-list.php',
			controller: 'CountryListCtrl'
		}).
		when('/test2', {
			templateUrl: 'test2.php',
			controller: 'CountryDetailCtrl'
		}).
		when('/:countryName', {
			templateUrl: 'partials/country-detail.php',
			controller: 'CountryDetailCtrl'
		}).
		otherwise({
			redirectTo: '/'
		});
	});

	countryApp.controller('CountryListCtrl', function($scope, $http) {
		$http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
			$scope.countries = data.records;

			$scope.sortField = "Country";
			$scope.reverse = true;
		});
	});

	countryApp.controller('CountryDetailCtrl', function($scope, $routeParams) {
		console.log($routeParams);
	});
</script>
</body>
</html>
