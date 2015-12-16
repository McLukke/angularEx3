var countryControllers = angular.module('countryControllers', []);

// note 'countries' is now requested as fn param
countryControllers.controller('CountryListCtrl', function($scope, countries) {
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
		// console.log(countries);
		$scope.countries = countries.records;
	});
});

countryControllers.controller('CountryDetailCtrl', function($scope, $routeParams, countries) {
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