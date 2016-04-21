angular.module('app.controllers')
        .controller('ProjectsMemberDashboardController', ['$scope', '$cookies', 'Project',
            function ($scope, $cookies, Project) {
                $scope.projects = Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 15
                });
                $scope.project = {};
                $scope.showProject = function (project) {
                    $scope.project = project;
                };



            }
        ]);
