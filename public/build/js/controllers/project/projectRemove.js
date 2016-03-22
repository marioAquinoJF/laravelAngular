angular.module('app.controllers')
        .controller('ProjectRemoveController', ['$scope', '$location', '$routeParams', 'Project', 'appConfig',
            function ($scope, $location, $routeParams, Project, appConfig) {
                $scope.project = new Project.get({id: $routeParams.id},
                        function (data) {
                            $scope.project = data;
                            $scope.clientSelected = data.client.data;
                            $scope.status = appConfig.project.getStatus(data.status);
                        });

                $scope.remove = function () {
                    $scope.project.$delete({
                        id: $routeParams.id
                    }).then(
                            function () {
                                $location.path('/projects');
                            }
                    );
                };
            }
        ]);


