angular.module('app.controllers')
        .controller('ClientsDashboardController', ['$scope', '$location', '$routeParams', 'Client',
            function ($scope, $location, $routeParams, Client) {
                $scope.client = {
                    
                };
                $scope.clients = Client.query({
                    orderBy:'created_at',
                    sortedBy:'desc',
                    limit: 15
                });
                $scope.showClient = function(client){
                    $scope.client = client;
                };
            }
        ]);


