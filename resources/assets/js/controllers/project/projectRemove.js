angular.module('app.controllers')
        .controller('ProjectRemoveController', ['$scope', '$location', '$routeParams', 'Project',
            function ($scope, $location, $routeParams, Project) {
                $scope.project = new Project.get({id: $routeParams.id}, function (r) {
                    console.log($scope.project);
                });
                $scope.process = new Array('Iniciado',
                        'Em andamento',
                        'Concluído');
                $scope.status = new Array('Em desenvolvimento',
                        'Entregue');

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


