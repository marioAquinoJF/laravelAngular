angular.module('app.controllers')
        .controller('ProjectEditController', ['$scope', '$location', '$routeParams', 'Project', 'Client',
            function ($scope, $location, $routeParams, Project, Client) {

                $scope.project = new Project.get({
                    id: $routeParams.id
                }, function (r) {
                    $scope.due_date = $scope.project.due_date.split('-').reverse().join('-');
                    $scope.clients = Client.query(function (cts) {
                        for (var i = 0; i < cts.length; i++) {
                            if (cts[i].id === $scope.project.client['data'].id) {
                                $scope.client = $scope.clients[i];
                                break;
                            }
                        }
                    });
                });

                $scope.update = function () { 
                        $scope.project.owner_id = $scope.project.owner['data'].id;
                        $scope.project.due_date = $scope.due_date.split('-').reverse().join('-');
                        $scope.project.client_id = $scope.client.id;
                        Project.update({id: $routeParams.id}, $scope.project, function (r) {
                            $location.path('/projects');
                        });
                };
            }]);


