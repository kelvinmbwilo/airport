/**
 * Created by kelvin on 1/9/15.
 */
angular.module("airportApp")
//    .run( function($rootScope, $location) {
//
//        // register listener to watch route changes
//        $rootScope.$on( "$routeChangeStart", function(event, next, current) {
//            if (!$rootScope.loggedUser) {
//                // no logged user, we should be going to #login
//                if ( next.templateUrl == "partials/login.html" ) {
//                    // already going to #login, no redirect needed
//                } else {
//                    // not going to #login, we should redirect now
//                    $location.path( "/login" );
//                }
//            }
//        });
//    })
    .config( function($routeProvider){
    $routeProvider.when("/home",{
        templateUrl: '../views/home.html',
        controller: 'homeCtrl'
    });
    $routeProvider.when("/flight",{
        templateUrl: '../views/flights.html',
        controller: 'flightCtrl'
    });

    $routeProvider.when("/destination",{
        templateUrl: '../views/destination.html',
        controller: 'destinationCtrl'
    });

    $routeProvider.when("/timetable",{
        templateUrl: '../views/timetable.html',
        controller: 'timetableCtrl'
    });
    $routeProvider.when("/users",{
        templateUrl: '../views/users.html',
        controller: 'usersCtrl'
    });

    $routeProvider.otherwise({
        redirectTo: '/flight'
    });



});