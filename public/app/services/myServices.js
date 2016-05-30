app.factory('dataFactory', function ($http) {

    var myService = {
        currentPage: 1,
        countPerPage: 5,
        searchTitle: '',
        searchAuthor: '',
        sortType: 'title',
        withSort: false,
        sortReverse: false,
        book: {},
        userId: undefined,
        getBook: function () {
            return this.book.id ? this.book : undefined;
        },
        successMessages: [],
        errorMessages: [],
        httpRequest: function (url, method, params, dataPost) {
            
            var passParameters = {};
            passParameters.url = url;

            if (method == 'POST' || method == 'PUT' || method == 'DELETE') {
                dataPost = addTokens(dataPost);
            }

            if (typeof method == 'undefined') {
                passParameters.method = 'GET';
            } else {
                passParameters.method = method;
            }

            if (typeof params != 'undefined') {
                passParameters.params = params;
            }

            if (typeof dataPost != 'undefined') {
                passParameters.data = dataPost;
            }

            var promise = $http(passParameters).then(function (response) {
                updateTokens(response.data);
                return response.data;
            }, function (response) {
                updateTokens(response.data);
                console.warn('An error occured while processing your request.');
                return response.data;
            });
            return promise;
        }
    };
    return myService;
});

