// var testFunction  = function() {
//   alert('testing');
// }

// window.testFunction = testFunction;

function ajaxRequest(method, url, data, onSuccess, onError) {
    var jqXhr = $.ajax({
        type: method,
        url: url,
        data: data,
        cache: false,
        success: function (data) { // catch all success
            if (typeof onSuccess === "function") {
                onSuccess(data);
            }
        },
        error: function(jqXhr, errorText, error) { // catch all errors
            if(typeof onError === 'function') {
                onError(error);
            }
        }
    });
}

window.ajaxRequest = ajaxRequest;