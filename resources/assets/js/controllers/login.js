angular.module('app.controllers')
        .controller('LoginController', ['$scope', 'OAuth', '$location', '$cookies', 'User', function ($scope, OAuth, $location, $cookies, User) {
                $scope.user = {
                    username: '',
                    password: ''
                };
                $scope.error = {
                    message: '',
                    error: false
                };

                $scope.login = function () {
                    if ($scope.loginForm.$valid) {
                        OAuth.getAccessToken($scope.user)
                                .then(function () {
                                    User.authenticated({}, {},
                                            function (data) {
                                                $cookies.putObject('user', data);
                                                $location.path('home/dashboard');
                                            });

                                }, function (data) {
                                    $scope.error.error = true;
                                    $scope.error.message = data.data.error_description;
                                });
                    }
                };

            }
        ]);