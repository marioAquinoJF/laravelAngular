angular.module('app.controllers')
        .controller('ProjectShowController', ['$scope', '$routeParams', 'Project',
            function ($scope, $routeParams, Project) {
                $scope.process = new Array('Iniciado',
                        'Em andamento',
                        'Concluído');
                $scope.status = new Array('Em desenvolvimento',
                        'Entregue');
                $scope.project = new Project.get({
                    id: $routeParams.id
                }, function (r) {
                    $scope.project.due_date = r.due_date.split('-').reverse().join('-');
                });

            }
        ]);


