angular.module('app.controllers')
        .controller('ProjectsMemberDashboardController', ['$scope', '$cookies', '$rootScope', 'Project',
            function ($scope, $cookies, $rootScope, Project) {
                $scope.projects = Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 15,
                    isMember: true
                });
                $scope.project = {};
                $scope.showProject = function (project) {
                    $scope.project = project;
                };
                $scope.isMember = true;

            }
        ]);
