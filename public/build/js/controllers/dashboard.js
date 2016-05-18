angular.module('app.controllers')
        .controller('DashboardController',
                ['$scope', '$cookies', '$timeout', '$pusher', 'Project', 'ProjectTask', 'appConfig', '$moment', 'Searches',
                    function ($scope, $cookies, $timeout, $pusher, Project, ProjectTask, appConfig, $moment, Searches) {
                        $scope.project = {};
                        $scope.projects = [];
                        $scope.tasks = [];
                        $scope.config = appConfig.project;
                        $scope.configTask = appConfig.projectTask;

                        $scope.items = [{
                                id: 1,
                                label: 'aLabel',
                                subItem: {name: 'aSubItem'}
                            }, {
                                id: 2,
                                label: 'bLabel',
                                subItem: {name: 'bSubItem'}
                            }];
                        $scope.selected = $scope.items[0];
                        Project.query({
                            orderBy: 'created_at',
                            sortedBy: 'desc',
                            limit: 6
                        }, function (data) {
                            $scope.projects = data.data;
                            $scope.selected = $scope.projects[0];
                        });

                        $scope.loadTasks = function () {
                            return Searches.query({
                                object: 'task',
                                orderBy: 'updated_at',
                                sortedBy: 'desc',
                                limit: 6
                            }, function (data) {
                                $scope.tasks = data.data;
                                console.log(data);
                            });
                        };
                        $scope.loadTasks();

                        var pusher = $pusher(window.client);
                        var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);
                        channel.bind('larang\\Events\\TaskWasIncluded',
                                function (data) {
                                    if ($scope.tasks.length == 6) {
                                        $scope.tasks.splice($scope.tasks.length - 1, 1);
                                    }
                                    $timeout(function () {
                                        $scope.tasks.unshift(data.task);
                                    }, 500);
                                }
                        );

                        channel.bind('larang\\Events\\TaskWasUpdated',
                                function (data) {
                                    if ($scope.tasks.length == 6) {
                                        $scope.tasks.splice($scope.tasks.length - 1, 1);
                                    }
                                    $timeout(function () {
                                        $scope.addTask(data.task);
                                    }, 500);
                                }
                        );
                        $scope.addTask = function (task) {
                            if ($scope.tasks.length == 6) {
                                $scope.tasks.splice($scope.tasks.length - 1, 1);
                            }
                            $timeout(function () {
                                $scope.tasks.unshift(task);
                            }, 500);
                        };
                        $scope.progress = {
                            projectStartDate: '',
                            projectDueDate: '',
                            taskTime: 1, // default time as days to finish a task
                            getTotalTasks: function (tasks) {
                                return tasks.length;
                            },
                            getTasksCompleted: function (tasks) {
                                var tasksCompleted = [];
                                if (tasks) {
                                    for (var i in tasks) {
                                        if (tasks[i].status == 2) {
                                            tasksCompleted.push(tasks[i]);
                                        }
                                    }
                                }
                                return tasksCompleted;
                            },
                            getPercentageCompleted: function (tasks, projectStatus) {
                                var r = (this.getTasksCompleted(tasks).length * 100) / this.getTotalTasks(tasks);
                                return isNaN(r) || r == 0 || projectStatus == 1 ? 0 : r.toFixed(0);
                            },
                            getTotalProjectTime: function (projectStartDate, projectDueDate) {
                                var start = $moment(projectStartDate); //start date
                                var end = $moment(projectDueDate); // end date
                                var interval = $moment.duration(end.diff(start));
                                return interval.asDays();
                            },
                            getElapsedTimeOfProject: function (project) {
                                if (project.status == 1) {
                                    return 0;
                                }
                                var now = $moment($moment().format("YYYY-MM-DD")); //now date
                                var end = (project.status == 3 ? $moment(project.updated_at.date.split(" ")[0]) : $moment(project.due_date)); // end date
                                var interval = $moment.duration(end.diff(now));
                                return interval.asDays() > 0 ? "+" + interval.asDays() : interval.asDays();
                            },
                            getPercentageOfElapsedTime: function (project) {
                                var r = (this.getElapsedTimeOfProject(project.created_at.date.split(' ')[0], new Date())) * 100 / this.getTotalProjectTime(project.created_at.date.split(' ')[0], project.due_date);
                                if (project.status == 2) {
                                    return r.toFixed(0);
                                } else {
                                    return isNaN(r) || r == 0 || project.status == 1 ? 0 : 100;
                                }

                            }
                        };
                    }
                ]);

/*
 * Regras:
 *  1) para projetos não iniciados, apresnta-se a estimativa de tempo total para o projeto
 *  2) para projetos iniciados, apresenta-se a data final do projeto e o tempo restante em dias (dentro do prazo) 
 *                              ou o tempo de atrazo na entrega (fora do prazo) 
 *  3) para projetos concluídos, apresenta-se a data de término e o tempo total do projeto
 *  
 *  Conceitos:
 *  a) Progresso: é a conclusão de tarefas do projeto, relacionado ao tempo de execução do projeto;
 *  b) Progresso esperado: é a diferença entre o concluído e o esperado dentro do tempo total do projeto;
 *  tempo transcorrido (data de início à data atual) e o prazo de entrega (data de início até data de entrega = 100%).
 */