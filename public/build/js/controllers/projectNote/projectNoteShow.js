angular.module('app.controllers')
        .controller('ProjectNoteShowController', ['$scope', '$routeParams', 'ProjectNote',
            function ($scope, $routeParams, ProjectNote) {
                $scope.projectNote  = new ProjectNote.get({
                    id: $routeParams.id,
                    idNote: $routeParams.idNote
                });
                
            }
        ]);


