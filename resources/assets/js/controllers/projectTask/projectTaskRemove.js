angular.module('app.controllers')
        .controller('ProjectTaskRemoveController', ['$scope', '$location', '$routeParams', 'ProjectTask',
            function ($scope, $location, $routeParams, ProjectTask) {
                $scope.projectTask = new ProjectTask.get({id: $routeParams.id, idNote: $routeParams.idNote});
                console.log($scope.projectTask);
                $scope.remove = function () {
                    $scope.projectTask.$delete({
                        id: $routeParams.id,
                        idNote: $scope.projectTask.id
                    }).then(
                            function () {
                                $location.path('/project/' + $routeParams.id + '/tasks');
                            }
                    );
                };
            }
        ]);


