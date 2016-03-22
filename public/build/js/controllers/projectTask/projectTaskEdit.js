angular.module('app.controllers')
        .controller('ProjectTaskEditController', ['$scope', '$location', '$routeParams', 'ProjectTask',
            function ($scope, $location, $routeParams, ProjectTask) {

                $scope.projectTask = new ProjectTask.get({
                    id: $routeParams.id,
                    idNote: $routeParams.idTask
                });

                $scope.save = function () {
                    if ($scope.projectTaskForm.$valid) {
                        ProjectTask.update({
                            id: $routeParams.id,
                            idNote: $scope.projectTask.id
                        }, $scope.projectTask, function () {
                            $location.path('/project/' + $routeParams.id + '/tasks');
                        });
                    }
                };

            }]);


