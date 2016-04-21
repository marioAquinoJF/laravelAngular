var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'http-auth-interceptor',
    'app.controllers', 'app.services', 'app.directives',
    'app.filters', "ui.bootstrap.typeahead", "ui.bootstrap.modal", "ui.bootstrap.tabs",
    "ui.bootstrap.tpls", "ui.bootstrap.datepicker", 'ui.bootstrap.dropdown', 'mgcrea.ngStrap.navbar',
    "ngFileUpload", 'angularUtils.directives.dirPagination', 'pusher-angular']);

angular.module('app.controllers', ['ngMessages']);
angular.module('app.filters', []);
angular.module('app.directives', []);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', ['$httpParamSerializerProvider',
    function ($httpParamSerializerProvider) {
        var config = {
            baseUrl: 'http://larangular/',
            pusherKey: 'fef457291540797a0997',
            urls: {
                projectFile: 'project/{{id}}/file/{{idFile}}'
            },
            project:
                    {
                        status: [
                            {value: 1, label: 'Não iniciado'},
                            {value: 2, label: 'Iniciado'},
                            {value: 3, label: 'concluído'}
                        ],
                        getStatus: function (value) {
                            for (var i in this.status) {
                                if (this.status[i].value == value) {
                                    return this.status[i].label;
                                }
                            }
                        }
                    },
            projectTask:
                    {
                        status: [
                            {value: 1, label: 'Incompoleta'},
                            {value: 2, label: 'Completa'}
                        ]
                    },
            utils: {
                transformRequest: function (data) {
                    if (angular.isObject(data)) {
                        return $httpParamSerializerProvider.$get()(data);
                    }
                    return data;
                },
                transformResponse: function (data, headers) {
                    var headersGetter = headers();
                    if (headersGetter['content-type'] == 'application/json' ||
                            headersGetter['content-type'] == 'text/json') {
                        var dataJson = JSON.parse(data);
                        if (dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1) {
                            dataJson = dataJson.data;
                        }
                        return dataJson;
                    }
                    return data;
                }
            }
        };
        return {
            config: config,
            $get: function () {
                return config;
            }
        };
    }]);
app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        $httpProvider.interceptors.splice(0, 1);
        $httpProvider.interceptors.splice(0, 1);
        $httpProvider.interceptors.push('oauthFixInterceptor');
        $routeProvider
                .when('/login', {
                    templateUrl: 'build/views/login.html',
                    controller: 'LoginController'
                })
                .when('/logout', {
                    resolve: {
                        logout: ['$location', 'OAuthToken',
                            function ($location, OAuthToken) {
                                OAuthToken.removeToken();
                                $location.path('/login');
                            }]
                    }
                })
                .when('/home', {
                    templateUrl: 'build/views/home.html',
                    controller: 'HomeController'
                })
                .when('/home/dashboard', {
                    templateUrl: 'build/views/dashboard.html',
                    controller: 'DashboardController',
                    title: 'Dashboard'
                })
                .when('/clients/dashboard', {
                    templateUrl: 'build/views/client/dashboard.html',
                    controller: 'ClientsDashboardController',
                    title: 'Clientes'
                })
                .when('/clients', {
                    templateUrl: 'build/views/client/list.html',
                    controller: 'ClientListController',
                    title: 'Clientes'
                })
                .when('/client/new', {
                    templateUrl: 'build/views/client/new.html',
                    controller: 'ClientNewController'
                })
                .when('/client/:id/edit', {
                    templateUrl: 'build/views/client/edit.html',
                    controller: 'ClientEditController'
                })
                .when('/client/:id/remove', {
                    templateUrl: 'build/views/client/remove.html',
                    controller: 'ClientRemoveController'
                })
                .when('/client/:id/show', {
                    templateUrl: 'build/views/client/show.html',
                    controller: 'ClientShowController'
                })
                .when('/project/:id/notes', {
                    templateUrl: 'build/views/projectNote/list.html',
                    controller: 'ProjectNoteListController'
                })
                .when('/project/:id/note/new', {
                    templateUrl: 'build/views/projectNote/new.html',
                    controller: 'ProjectNoteNewController'
                })
                .when('/project/:id/note/:idNote/edit', {
                    templateUrl: 'build/views/projectNote/edit.html',
                    controller: 'ProjectNoteEditController'
                })
                .when('/project/:id/note/:idNote/remove', {
                    templateUrl: 'build/views/projectNote/remove.html',
                    controller: 'ProjectNoteRemoveController'
                })
                .when('/project/:id/note/:idNote/show', {
                    templateUrl: 'build/views/projectNote/show.html',
                    controller: 'ProjectNoteShowController'
                })
                .when('/project/:id/file/new', {
                    templateUrl: 'build/views/projectFile/new.html',
                    controller: 'ProjectFileNewController'
                })
                .when('/project/:id/files', {
                    templateUrl: 'build/views/projectFile/list.html',
                    controller: 'ProjectFileListController'
                })
                .when('/project/:id/file/:idFile/edit', {
                    templateUrl: 'build/views/projectFile/edit.html',
                    controller: 'ProjectFileEditController'
                })
                .when('/project/:id/file/:idFile/remove', {
                    templateUrl: 'build/views/projectFile/remove.html',
                    controller: 'ProjectFileRemoveController'
                })
                .when('/projects/dashboard', {
                    templateUrl: 'build/views/project/dashboard.html',
                    controller: 'ProjectsDashboardController',
                    title: 'Projetos'
                })
                .when('/projects/member/dashboard', {
                    templateUrl: 'build/views/project/dashboard.html',
                    controller: 'ProjectsMemberDashboardController',
                    title: 'Membro em Projetos'
                })
                .when('/projects', {
                    templateUrl: 'build/views/project/list.html',
                    controller: 'ProjectListController',
                    title: 'Projetos'
                })
                .when('/project/new', {
                    templateUrl: 'build/views/project/new.html',
                    controller: 'ProjectNewController'
                })
                .when('/project/:id/edit', {
                    templateUrl: 'build/views/project/edit.html',
                    controller: 'ProjectEditController'
                })
                .when('/project/:id/remove', {
                    templateUrl: 'build/views/project/remove.html',
                    controller: 'ProjectRemoveController'
                })
                .when('/project/:id/show', {
                    templateUrl: 'build/views/project/show.html',
                    controller: 'ProjectShowController'
                })
                .when('/project/:id/tasks', {
                    templateUrl: 'build/views/projectTask/list.html',
                    controller: 'ProjectTaskListController'
                })
                .when('/project/:id/task/new', {
                    templateUrl: 'build/views/projectTask/new.html',
                    controller: 'ProjectTaskNewController'
                })
                .when('/project/:id/task/:idTask/edit', {
                    templateUrl: 'build/views/projectTask/edit.html',
                    controller: 'ProjectTaskEditController'
                })
                .when('/project/:id/task/:idTask/remove', {
                    templateUrl: 'build/views/projectTask/remove.html',
                    controller: 'ProjectTaskRemoveController'
                })
                .when('/project/:id/task/:idTask/show', {
                    templateUrl: 'build/views/projectTask/show.html',
                    controller: 'ProjectTaskShowController'
                })
                .when('/project/:id/members', {
                    templateUrl: 'build/views/projectMember/list.html',
                    controller: 'ProjectMemberListController'
                })
                .when('/project/:id/member/:idMember/remove', {
                    templateUrl: 'build/views/projectMember/remove.html',
                    controller: 'ProjectMemberRemoveController'
                });
        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'app02',
            clientSecret: 'secret',
            grantPath: 'oauth/access_token'
        });
        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });
    }]);

app.run(['$rootScope', '$location', '$modal', '$cookies', '$pusher', 'httpBuffer', 'OAuth', 'appConfig',
    function ($rootScope, $location, $modal, $cookies, $pusher, httpBuffer, OAuth, appConfig) {
        $rootScope.$on('pusher-build', function (event, data) {
            
            if (data.next.$$route.originalPath != '/login') {
                
                if (OAuth.isAuthenticated()) {
                  //  console.log($cookies.getObject('user').id);
                    if (!window.client) {
                 /*       Pusher.log = function (message) {
                            if (window.console && window.console.log) {
                                window.console.log(message);
                            }
                        };
                        window.client = new Pusher(appConfig.pusherKey);
                        var pusher = $pusher(window.client);
                        var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);

                        channel.bind('larang\Events\TaskWasIncluded',
                                function (data) {
                                    console.log(data);
                                }
                        );*/
                    }
                }
            }
        });
        $rootScope.$on('pusher-destroy', function (event, data) {
         /*   if (data.next.$$route.originalPath != '/login') {
                if (window.client) {
                    window.client.disconnect();
                    window.client = null;
                }
            }*/
        });
        $rootScope.$on('$routeChangeStart',
                function (event, next, current) {
                    if (next.$$route.originalPath != '/login') { // verifica se a rota é a do login
                        if (!OAuth.isAuthenticated()) {
                            $location.path('/login');
                        }
                    }
                    $rootScope.$emit('pusher-build', {next: next});
                    $rootScope.$emit('pusher-destroy', {next: next});
                });
        $rootScope.$on('$routeChangeSuccess',
                function (event, current, previus) {
                    $rootScope.pageTitle = current.$$route.title;
                });
        $rootScope.$on('oauth:error', function (event, data) {
            // Ignore `invalid_grant` error - should be catched on `LoginController`.
            if ('invalid_grant' === data.rejection.data.error) {
                return;
            }

            // Refresh token when a `access_denied` error occurs.
            if ('access_denied' === data.rejection.data.error) {
                httpBuffer.append(data.rejection.config, data.deferred);
                if (!$rootScope.loginModalOpened) {
                    var modalInstance = $modal.open({
                        templateUrl: 'build/views/templates/loginModal.html',
                        controller: 'LoginModalController'
                    });
                    $rootScope.loginModalOpened = true;
                }
                return;
            }

            // Redirect to `/login` with the `error_reason`.
            return $location.path('/login');
        });
    }]);