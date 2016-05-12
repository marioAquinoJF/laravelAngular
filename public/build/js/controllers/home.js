angular.module('app.controllers')
        .controller('HomeController', ['$scope', '$cookies', '$timeout', '$pusher',
            function ($scope, $cookies, $timeout, $pusher) {
                $scope.tasks = [];
                var pusher = $pusher(window.client);
                var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);
                channel.bind('larang\\Events\\TaskWasIncluded',
                        function (data) {
                            if ($scope.tasks.length = 6) {
                                $scope.tasks.splice($scope.tasks.length - 1, 1);
                            }
                            $timeout(function () {
                                $scope.tasks.unshift(data.task);
                            }, 300);
                        }
                );
            }
        ]);