angular.module('app.controllers')
        .controller('ProjectNoteNewController', ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.save = function () {
                    $scope.projectNote.project_id = $routeParams.id;
                    ProjectNote.save({id: $routeParams.id}, $scope.projectNote, function () {
                        $location.path('/project/' + $routeParams.id + '/notes');
                    });
                };
            }
        ]);


