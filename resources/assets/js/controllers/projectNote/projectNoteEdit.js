angular.module('app.controllers')
        .controller('ProjectNoteEditController', ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                //   $scope.projectNote;         
                $scope.projectNote  = new ProjectNote.get({
                    id: $routeParams.id,
                    idNote: $routeParams.idNote
                });
                console.log($scope.projectNote );
                $scope.save = function () {
                    if ($scope.projectNoteForm.$valid) {
                        ProjectNote.update({
                            id: $routeParams.id,
                            idNote: $scope.projectNote.id
                        }, $scope.projectNote, function () {
                            $location.path('/project/' + $routeParams.id + '/notes');
                        });
                    }
                };

            }]);


