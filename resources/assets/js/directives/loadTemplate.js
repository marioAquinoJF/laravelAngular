angular.module('app.directives')
        .directive('loadTemplate',
                ['$http', 'OAuth', '$compile',
                    function ($http, OAuth, $compile) {
                        return {
                            restrict: "E",
                            link: function (scope, element, attr) {
                                scope.$on('$routeChangeStart',
                                        function (event, next, current) {
                                            if (OAuth.isAuthenticated()) {
                                                if (next.$$route.originalPath != '/login' &&
                                                        next.$$route.originalPath != '/logout') {
                                                    if (!scope.isTemplateLoaded) {
                                                        scope.isTemplateLoaded = true;
                                                        $http.get(attr.url).then(
                                                                function (response) {
                                                                    element.html(response.data);
                                                                    $compile(element.contents())(scope);
                                                                });
                                                    }
                                                    return;
                                                } 
                                            }
                                            resetTemplate();
                                            function resetTemplate() {
                                                scope.isTemplateLoaded = false;
                                                element.html('');
                                            }

                                        });
                            }
                        };
                    }]);
