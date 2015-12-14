<html ng-app="countryApp">
<?php include('partials/head.html'); ?>
<body>
<div ng-view>
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
			// this only sets fetched values for the current view - what if we need to pass data to another view?
			$scope.countries = data.records;

			// filtering
			// $scope.sortField = "Country";
			// $scope.reverse = true;
		});
	});

	countryApp.controller('CountryDetailCtrl', function($scope, $routeParams, $http) {
		console.log($routeParams);
		$scope.gotCountry = $routeParams.countryName;

		// shouldn't call API multiple times in an App, will change later
		$http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
			console.log(data.records);

			// filter is a function for native js arrays that filters items that pass a truth test
			$scope.country = data.records.filter(function(entry) {
				// truth test for each entry in the array
				return entry.Country === $scope.gotCountry;
			})[0];

			console.log(country);
		});
	});
</script>
</body>
</html>
