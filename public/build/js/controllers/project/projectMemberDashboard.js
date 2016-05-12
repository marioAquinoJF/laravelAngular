angular.module('app.controllers')
        .controller('ProjectsMemberDashboardController', ['$scope', '$cookies', '$rootScope', 'Project','appConfig',
            function ($scope, $cookies, $rootScope, Project, appConfig) {
                Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 15,
                    isMember: $scope.isMember
                }, function (data) {
                    $scope.projects = data;
                    $scope.projects.config = appConfig.project;
                });
                $scope.project = {};
                $scope.showProject = function (project) {
                    $scope.project = project;
                };
                $scope.isMember = true;
               
            }
        ]);
