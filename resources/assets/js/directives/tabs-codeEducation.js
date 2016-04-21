angular.module('app.directives')
        .directive('tabsCodeEducation',
                function (appConfig) {
                    return {
                        restrict: "A",
                        link: function (scope, element, attr) {
                            $(element).find('a').click(function () {
                                var tabContent = $(element).parent().find('.tab-content'),
                                        a = $(this);
                                $(element).find('.active').removeClass('active');
                                tabContent.find('.active').removeClass('active');
                                tabContent.find('[id=' + a.attr('aria-controls') + ']').addClass('active');
                                a.addClass('active');
                            });
                        }
                    };
                });
