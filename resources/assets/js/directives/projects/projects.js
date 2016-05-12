angular.module('app.directives')
        .directive('projectHomeDashboard',
                [ 'ProjectFile', '$http', '$compile',
                    function ( $http, $compile) {
                        return {
                            restrict: "E",
                            scope:{
                                projects:"@"
                            },
                            link: function (scope, element, attr) {
                                console.log(attr.url);
                             /*   $http.get(attr.url).then(
                                        function (response) {
                                            element.html(response.data);
                                            $compile(element.contents())(scope);
                                        });*/
                            },
                            controller: ['$scope', '$attrs',
                                function ($scope, $attrs) {
                                   
                                    //$scope.projects = $attrs.projects;
                                     console.log($scope.projects );
                                }]
                        };
                    }]);
