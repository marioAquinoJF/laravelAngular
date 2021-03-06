angular.module('app.services')
        .service('Project', ['$resource', 'appConfig', '$filter', '$httpParamSerializer',
            function ($resource, appConfig, $filter, $httpParamSerializer) {
                function transformData(data) {
                    if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
                        var o = angular.copy(data);
                        o.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                        return appConfig.utils.transformRequest(o);
                    }
                    return data;
                };
                return $resource(appConfig.baseUrl + 'project/:id',
                        {
                            id: '@id'
                        },
                        {
                            update: {
                                method: 'PUT',
                                transformRequest: transformData
                            },
                            'delete': {
                                method: 'DELETE'
                            },
                            save: {
                                method: 'POST',
                                transformRequest: transformData
                            },
                            query: {
                                isArray: false
                            },
                            get: {
                                method: 'GET',
                                transformResponse: function (data, headers) {
                                    var o = appConfig.utils.transformResponse(data, headers);
                                    if (angular.isObject(o) && o.hasOwnProperty('due_date')) {
                                        var arrayDate = o.due_date.split('-');
                                        var month = parseInt(arrayDate[1] - 1);
                                        o.due_date = new Date(arrayDate[0], month, arrayDate[2]);
                                        //   return $httpParamSerializer(data);
                                    }
                                    return o;
                                }
                            }
                        });
            }]);