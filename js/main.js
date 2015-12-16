// js goes here
var countryApp = angular.module('countryApp', [
	'ngRoute',
	'countryControllers',
	'countriesFactory',
	'encodeURI'
]);

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