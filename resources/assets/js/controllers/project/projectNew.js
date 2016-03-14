angular.module('app.controllers')
        .controller('ProjectNewController', ['$scope', '$location', '$routeParams', 'Project', 'Client', 'UserLoggedIn',
            function ($scope, $location, $routeParams, Project, Client, UserLoggedIn) {
                $scope.clients = Client.query();
                // $scope.client = null;
                $scope.owner_id = null;
                $scope.project = {};
                $scope.project.progress = 0;
                $scope.project.status = 0;
                UserLoggedIn.get(function (user) {
                    $scope.project.owner_id = user.userId;
                });
                $scope.save = function () {
                    if ($scope.project.owner_id && $scope.client.id) {                        
                        $scope.project.due_date = $scope.due_date.split('-').reverse().join('-');
                        $scope.project.client_id = $scope.client.id;
                        Project.save({}, $scope.project, function () {
                            $location.path('/projects');
                        });
                    }
                };
            }
        ]);


