angular.module('app.controllers')
        .controller('ProjectTaskNewController', ['$scope', '$location', '$routeParams', 'ProjectTask',
            function ($scope, $location, $routeParams, ProjectTask) {
                $scope.project_id = $routeParams.id;
                $scope.projectTask = new ProjectTask({id: $routeParams.id});
                $scope.save = function () {
                    $scope.projectTask.project_id = $scope.project_id;
                    $scope.projectTask.$save().then(
                            function () {
                                $location.path('/project/' + $routeParams.id + '/tasks');
                            });

                };
                
            }

        ]);


