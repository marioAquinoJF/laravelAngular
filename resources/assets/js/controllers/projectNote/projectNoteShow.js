angular.module('app.controllers')
        .controller('ClientShowController', ['$scope', '$location', '$routeParams', 'Client',
            function ($scope, $location, $routeParams, Client) {
                $scope.client = new Client.get({id: $routeParams.id});
                
            }
        ]);


