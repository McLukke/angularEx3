Routing<br />Extracting route params | link views between routes | factories -> service | caching JSON data<br /><br />
<ul>
	<li ng-repeat="country in countries">
		<!-- <a href="/{{country.City}}">{{country.City}}</a> -->
		<a href="#/{{country.Country | encodeURI}}">{{country.Country}}</a>
		<!-- <a href="/{{country.Name}}">{{country.Name}}</a> -->
	</li>
</ul>
