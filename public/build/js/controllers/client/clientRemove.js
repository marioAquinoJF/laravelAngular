angular.module('app.controllers')
        .controller('ClientRemoveController', ['$scope', '$location', '$routeParams', 'Client',
            function ($scope, $location, $routeParams, Client) {
                $scope.client = new Client.get({id: $routeParams.id});
                $scope.remove = function () {
                    console.log($scope.client.$delete());
                    $scope.client.$delete().then(
                            function (response) {
                               $location.path('/clients');
                            },
                            function (response) {
                                console.log(response);
                            }
                    );
                };
            }
        ]);


