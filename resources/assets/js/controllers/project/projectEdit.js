angular.module('app.controllers')
        .controller('ProjectEditController',
                ['$scope', '$location', '$routeParams', '$cookies', 'Project', 'Client', 'appConfig',
                    function ($scope, $location, $routeParams, $cookies, Project, Client, appConfig) {

                        Project.get({id: $routeParams.id},
                                function (data) {
                                    $scope.project = data;
                                    $scope.clientSelected = data.client.data;
                                });
                        $scope.due_date =
                                {
                                    status:
                                            {opened: false}
                                };
                        $scope.open = function ($event) {
                            $scope.due_date.status.opened = true;
                        };
                        $scope.status = appConfig.project.status;
                        $scope.update = function () {
                            if ($scope.projectForm.$valid) {
                                $scope.project.owner_id = $cookies.getObject('user').id;
                                Project.update({id: $scope.project.id}, $scope.project,
                                        function () {
                                            $location.path('/projects');
                                        });

                            }
                        };
                        $scope.formateName = function (model) {
                            if (model) {
                                return model.name;
                            }
                            return '';
                        };
                        $scope.getClients = function (name) {
                            return Client.query({
                                search: name,
                                searchFields: 'name:like'
                            }).$promise;
                        };
                        $scope.selectClient = function (item) {
                            $scope.project.client_id = item.id;
                        };

                    }]);


