angular.module('app.controllers')
        .controller('ProjectNoteNewController', ['$scope', '$location', '$routeParams', 'ProjectNote',
            function ($scope, $location, $routeParams, ProjectNote) {
                $scope.project_id = $routeParams.id;
                
                $scope.projectNote = new ProjectNote({id: $routeParams.id});
                $scope.save = function () {
                    $scope.projectNote.project_id = $scope.project_id;
                    $scope.projectNote.$save().then(
                            function () {
                                $location.path('/project/' + $routeParams.id + '/notes');
                            });

                };
                $scope.formateName = function (id) {
                    if(id){
                        for(var i in $scope.clients){
                            if($scope.clients[i].id == id){
                                return $scope.clients[i].name;
                            }
                        }
                    }
                    return 'erro';
                };
            }

        ]);


