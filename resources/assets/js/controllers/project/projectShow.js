angular.module('app.controllers')
        .controller('ProjectShowController', ['$scope', '$routeParams', 'Project', 'appConfig',
            function ($scope, $routeParams, Project, appConfig) {
               $scope.project = new Project.get({id: $routeParams.id},
                                function (data) {
                                    $scope.project = data;
                                    $scope.clientSelected = data.client.data;                                    
                                    $scope.status = appConfig.project.getStatus(data.status);
                                });
                                for(var i = 0; i< 3;i++){
                    Project.query();
                }
            }
        ]);


