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
angular.module('countriesFactory', []).factory('countries', function($http) {
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
			url: 'http://www.w3schools.com/angular/customers.php',
			// no need for cacheData
			cache: true
		}).success(callback);
	}

	return {
		list: getData,
		find: function (countryName, callback) {
			getData(function(data) {
				// var theCountry = data.filter(function(entry) {
				var theCountry = data.records.filter(function(entry) {
					return entry.Country === countryName;
				})[0];
				callback(theCountry);
			});
		}
	};
});