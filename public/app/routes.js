var app = angular.module('main-App',
    [
        'ngRoute',
        'crumble',
        'ngSanitize',
        'angularUtils.directives.dirPagination',
        'ngLoadingSpinner'
    ]
);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'templates/home',
                label: 'Home'
            })
            .when('/books', {
                templateUrl: 'templates/books',
                controller: 'BooksController',
                label: 'Books'
            })
            .when('/books/add', {
                templateUrl: 'templates/addBook',
                controller: 'BooksController',
                label: 'Add book'
            })
            .when('/books/show/:id', {
                templateUrl: 'templates/show_book',
                controller: 'BooksController',
                label: 'Show {{book.title}}'
            })
            .when('/books/edit/:id', {
                templateUrl: 'templates/edit_book',
                controller: 'BooksController',
                label: 'Edit {{book.title}}'
            })
            .otherwise('/books');
}]);