angular.module('app.services')
        .service('Client', ['$resource', 'appConfig', function ($resource, appConfig) {
                return $resource(appConfig.baseUrl + 'client/:id', {id: '@id'}, {
                    query: {isArray: true},
                    update: {method: 'PUT'}
                });
            }]);