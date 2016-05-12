angular.module('app.controllers')
        .controller('ProjectsDashboardController', ['$scope', '$route', 'Notification', 'Project', 'ProjectTask', 'appConfig',
            function ($scope, $route, Notification, Project, ProjectTask, appConfig) {
                $scope.project = {};
                $scope.apagar = !$route.current.$$route.isMember;
                $scope.editar = !$route.current.$$route.isMember;
                $scope.permitions = function (text) {
                    if(!$scope.apagar || !$scope.editar){
                        Notification.error('Você não tem autorização a '+text+'!');
                    }
                };
                Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 15,
                    isMember: $route.current.$$route.isMember
                }, function (data) {
                    $scope.projects = data;
                    $scope.projects.config = appConfig.project;
                    $scope.project = $scope.projects.data[0];

                });
                $scope.showProject = function (project) {
                    $scope.project = project;
                };
                $scope.task = {
                    projectTask: {},
                    project_id: $scope.project.id,
                    status: appConfig.projectTask.status,
                    due_date: {
                        status: {opened: false},
                        open: function ($event) {
                            $scope.task.due_date.status.opened = true;
                        }
                    },
                    start_date: {
                        status: {opened: false},
                        open: function ($event) {
                            $scope.task.start_date.status.opened = true;
                        }
                    },
                    loadTasks: function () {
                        return ProjectTask.query({
                            id: $scope.project.id,
                            orderBy: 'id',
                            sortedBy: 'desc'
                        });
                    },
                    save: function () {
                        if ($scope.projectTaskForm.$valid) {
                            this.projectTask.project_id = $scope.project.id;
                            this.projectTask.id = $scope.project.id;
                            var task = new ProjectTask(this.projectTask);
                            task.$save().then(function () {
                                $scope.project.tasks.data = $scope.task.loadTasks();
                                $scope.task.projectTask = {};
                            });
                        }
                    },
                    getTotalTasks: function () {
                        return $scope.project.tasks ? $scope.project.tasks.data.length : 0;
                    },
                    getTasksCompleted: function () {
                        var tasks = [];
                        if ($scope.project.tasks) {
                            for (var i in $scope.project.tasks.data) {
                                if ($scope.project.tasks.data[i].status === 2) {
                                    tasks.push($scope.project.tasks.data[i]);
                                }
                            }
                        }
                        return tasks;
                    },
                    totalCompleted: 0,
                    totalTasks: 0,
                    getPercentageCompleted: function () {
                        $scope.task.totalCompleted = this.getTasksCompleted().length;
                        $scope.task.totalTasks = this.getTotalTasks();
                        var r = ($scope.task.totalCompleted * 100) / $scope.task.totalTasks;
                        return isNaN(r) ? 0 : r.toFixed(2);
                    }
                };
            }
        ]);
/*
 * TAREFAS
 * 1) verificar se as tasks estão dentro do prazo do projeto
 *      a) quantidade de tarefas dentro do prazo do projeto - estimativa de conclusão.
 *      b) quantidade de tarefas em andamento - total de tempo gasto até o momento (am) e tempo estimado para as suas conclusão
 *      c) quantidate de tarefas concluídas - total de tempo gasto (tt)
 *      d) quantidade de tarefas não iniciadas - tempo estimado para as suas conclusão (tac)
 */