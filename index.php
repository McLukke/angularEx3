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

	// // instead of calling same API multiple times in each view use factory
	// // use 'factory' on the ng-app, service is 'countries' that can be called elsewhere
	// countryApp.factory('countries', function($http) {
	// 	return {
	// 		// 'list' each country
	// 		list: function (callback) {
	// 			$http.get('http://www.w3schools.com/angular/customers.php').success(callback);
	// 		},
	// 		find: function (countryName, callback) {
	// 			// but we're still calling the same API twice
	// 			$http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
	// 				var theCountry = data.records.filter(function(entry) {
	// 					return entry.Country === countryName;
	// 				})[0];
	// 				callback(theCountry);
	// 			});
	// 		}
	// 	};
	// });

	// to NOT call the API twice
	countryApp.factory('countries', function($http) {
		var cachedData;

		// function getData(callback) {
		// 	if (cachedData) {
		// 		callback(cachedData);
		// 	} else {
		// 		$http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
		// 			cachedData = data.records;
		// 			callback(cachedData);
		// 		});
		// 	}
		// }

		// using $http's own cached option
		function getData(callback) {
			$http({
				method: 'GET',
				url: 'countries.json',
				// no need for cacheData
				cache: true
			}).success(callback);
		}

		return {
			list: getData,
			find: function (countryName, callback) {
				getData(function(data) {
					var theCountry = data.filter(function(entry) {
						return entry.Country === countryName;
					})[0];
					callback(theCountry);
				});
			}
		};
	});


	// note 'countries' is now requested as fn param
	countryApp.controller('CountryListCtrl', function($scope, countries) {
		// $http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
		// 	// this only sets fetched values for the current view - what if we need to pass data to another view?
		// 	$scope.countries = data.records;

		// 	// filtering
		// 	// $scope.sortField = "Country";
		// 	// $scope.reverse = true;
		// });


		// using factory service
		// on the injected 'countries' object, invoke list fn, pass in 'callback'
		countries.list(function(countries) {
			$scope.countries = countries;
		});
	});

	countryApp.controller('CountryDetailCtrl', function($scope, $routeParams, countries) {
		// console.log($routeParams);
		// $scope.gotCountry = $routeParams.countryName;

		// // shouldn't call API multiple times in an App, will change later
		// $http.get('http://www.w3schools.com/angular/customers.php').success(function(data) {
		// 	console.log(data.records);

		// 	// filter is a function for native js arrays that filters items that pass a truth test
		// 	$scope.country = data.records.filter(function(entry) {
		// 		// truth test for each entry in the array
		// 		return entry.Country === $scope.gotCountry;
		// 	})[0];

		// // 	console.log(country);
		// // });


		// using factory service
		countries.find($routeParams.countryName, function(theCountry) {
			console.log(theCountry);
			$scope.country = theCountry;
		});
	});
</script>
</body>
</html>
