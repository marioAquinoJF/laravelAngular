angular.module('app.services')
        .service('UserLoggedIn', ['$resource', 'appConfig', function ($resource, appConfig) {
                return $resource(appConfig.baseUrl + 'userloggedin',{get:{isArray: true}});
            }]);