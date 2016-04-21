angular.module('app.directives')
        .directive('memberRestrictions',
                ['$compile',
                    function (appConfig) {
                        return {
                            restrict: "A",
                            scope: {
                                isMember: "@isMember",
                                ngHref: "@ngHref"
                            },
                            link: function (scope, element, attr) {
                                console.log(scope.ngHref);
                                if (scope.isMember) {
                                    scope.ngHref = '';
                                    console.log(scope.ngHref);
                                }
                            }
                        };
                    }]);
