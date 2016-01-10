angular.module('app.controllers')
        .controller('LoginController', ['$scope', 'OAuth', '$location', function ($scope, OAuth, $location) {
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
                                    $location.path('home');
                                }, function (data) {
                                    $scope.error.error = true;
                                    $scope.error.message = data.data.error_description;
                                });
                    }
                };

            }
        ]);