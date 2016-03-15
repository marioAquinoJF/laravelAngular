angular.module('app.controllers')
        .controller('ProjectNoteNewController', ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.project_id = $routeParams.id;
                $scope.save = function () {
                    $scope.projectNote.project_id = $scope.project_id;
                    ProjectNote.save(
                            {id: $routeParams.id}, $scope.projectNote, 
                    function () {
                        $location.path('/project/' + $routeParams.id + '/notes');
                    });
                };
            }
        ]);


