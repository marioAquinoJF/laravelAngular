<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @if(Config::get('app.debug'))
        <link href="{{ asset('build/css/vendor/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{ asset('build/css/flaticon.css')}}" rel="stylesheet">
        <link href="{{ asset('build/css/components.css')}}" rel="stylesheet">
         <link href="{{ asset('build/css/vendor/angular-ui-notification.css')}}" rel="stylesheet">
        <link href="{{ asset('build/css/app.css')}}" rel="stylesheet">

        @else
        <link href="{{ elixir('css/all.css')}}" rel="stylesheet">
        @endif


        <!-- Fonts -->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


    <load-template url="build/views/templates/menu.html"></load-template>
    
    <!-- Scripts -->
    <div ng-view></div>

    @if(Config::get('app.debug')) 
    <script src="{{ asset('build/js/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-route.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-resource.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-messages.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/navbar.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/ng-file-upload.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/dirPagination.js')}}"></script>
    <script src="{{ asset('build/js/vendor/pusher.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/pusher-angular.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-ui-notification.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-strap.min.js')}}"></script>
     <script src="{{ asset('build/js/vendor/angular-strap.tpl.min.js')}}"></script>
    <!-- OAuth2 -->
    <script src="{{ asset('build/js/vendor/angular-cookies.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/query-string.js')}}"></script>
    <script src="{{ asset('build/js/vendor/angular-oauth2.min.js')}}"></script>
    <script src="{{ asset('build/js/vendor/http-auth-interceptor.js')}}"></script>
     <script src="{{ asset('build/js/vendor/moment-with-locales.min.js')}}"></script>
     <script src="{{ asset('build/js/vendor/angular-momentjs.min.js')}}"></script>
    <!-- APP -->
    <script src="{{ asset('build/js/app.js')}}"></script>

    <!-- Controllers -->
    <script src="{{ asset('build/js/controllers/menuController.js')}}"></script>
    <script src="{{ asset('build/js/controllers/dashboard.js')}}"></script>
    <script src="{{ asset('build/js/controllers/login.js')}}"></script>
    <script src="{{ asset('build/js/controllers/loginModal.js')}}"></script>
    <script src="{{ asset('build/js/controllers/home.js')}}"></script>
    <!-- Clients -->
    <script src="{{ asset('build/js/controllers/client/clientDashboard.js')}}"></script>
    <script src="{{ asset('build/js/controllers/client/clientList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/client/clientNew.js')}}"></script>
    <script src="{{ asset('build/js/controllers/client/clientEdit.js')}}"></script>
    <script src="{{ asset('build/js/controllers/client/clientRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/client/clientShow.js')}}"></script>
    <!-- Project Note -->
    <script src="{{ asset('build/js/controllers/projectNote/projectNoteList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectNote/projectNoteNew.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectNote/projectNoteEdit.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectNote/projectNoteRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectNote/projectNoteShow.js')}}"></script>
    <!-- Project -->
    <script src="{{ asset('build/js/controllers/project/projectDashboard.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectMember/projectMemberRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectNew.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectEdit.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectShow.js')}}"></script> 
    <!-- Project File-->
    <script src="{{ asset('build/js/controllers/projectFile/projectFileList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectFile/projectFileNew.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectFile/projectFileEdit.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectFile/projectFileRemove.js')}}"></script>
    <!--<script src="{{ asset('build/js/controllers/project/projectShow.js')}}"></script--> 

    <!-- Project Task-->
    <script src="{{ asset('build/js/controllers/projectTask/projectTaskList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectTask/projectTaskNew.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectTask/projectTaskEdit.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectTask/projectTaskRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectTask/projectTaskShow.js')}}"></script>

    <!-- Project Member-->
    <script src="{{ asset('build/js/controllers/projectMember/projectMemberList.js')}}"></script>
    <script src="{{ asset('build/js/controllers/projectMember/projectMemberRemove.js')}}"></script>
    <script src="{{ asset('build/js/controllers/project/projectMemberDashboard.js')}}"></script>

    <!-- Directives -->
    <script src="{{ asset('build/js/directives/projectFileDownload.js')}}"></script>
    <script src="{{ asset('build/js/directives/login.js')}}"></script>
    <script src="{{ asset('build/js/directives/loadTemplate.js')}}"></script>
    <script src="{{ asset('build/js/directives/menu-actived.js')}}"></script>
    <script src="{{ asset('build/js/directives/tabs-codeEducation.js')}}"></script>
    <script src="{{ asset('build/js/directives/memberRestrictions.js')}}"></script>
    <script src="{{ asset('build/js/directives/memberRestrictions.js')}}"></script>
    <script src="{{ asset('build/js/directives/projects/projects.js')}}"></script>
    <!-- Filters -->
    <script src="{{ asset('build/js/filters/date-br.js')}}"></script>
    <!-- Services -->
    <script src="{{ asset('build/js/services/url.js')}}"></script>
    <script src="{{ asset('build/js/services/client.js')}}"></script>
    <script src="{{ asset('build/js/services/projectNote.js')}}"></script>
    <script src="{{ asset('build/js/services/project.js')}}"></script>
    <script src="{{ asset('build/js/services/user.js')}}"></script>
    <script src="{{ asset('build/js/services/projectFile.js')}}"></script>
    <script src="{{ asset('build/js/services/projectTask.js')}}"></script>
    <script src="{{ asset('build/js/services/projectMember.js')}}"></script>
    <script src="{{ asset('build/js/services/oauthFixInterceptor.js')}}"></script>

    @else

    <script src="{{ elixir('js/all.js')}}"></script>
    @endif

</body>
</html>
