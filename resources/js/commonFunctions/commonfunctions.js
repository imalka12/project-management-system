function ajaxRequest(method, url, data, callback)
{
    $.ajax({
        type: method,
        url: url,
        data: data,
        cache: false,
        success: function(data) {
            if (typeof callback === "function") {
                callback(data);
            }
        }
    });
}
