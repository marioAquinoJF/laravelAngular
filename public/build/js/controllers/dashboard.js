angular.module('app.controllers')
        .controller('DashboardController', ['$scope', '$cookies', 'Project',
            function ($scope, $cookies, Project) {
                $scope.project = {};
                $scope.expectedProgress = function (project) {
                    return 0;
                };
                Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 6
                }, function (data) {
                    $scope.projects = data.data;
                });
            }
        ]);