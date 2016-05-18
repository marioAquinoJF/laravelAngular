angular.module('app.services')
        .service('Searches', ['$resource', '$filter','appConfig',
            function ($resource, $filter, appConfig) {
                
                return $resource(appConfig.baseUrl + ':object/search', {
                    object: '@object'
                }, {
                    query:{
                        isArray: false
                    }
                });
            }]);

