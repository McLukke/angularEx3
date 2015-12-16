// making our own custom filters
angular.module('encodeURI', []).filter('encodeURI', function() {
	return window.encodeURI;
});
