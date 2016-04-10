function http(url, method, data, cb)
{
    $.ajax({
        success: function(data, status, xhr) {
            cb(null, data);
        }, 
        headers: { 
            Accept : "application/json; charset=utf-8",
            "Content-Type": "application/json; charset=utf-8"
        },
        url: url, 
        method: method, 
        data: data,
        dataType: 'json',
        error: function(xhr, status, err) {
            cb(xhr.responseJSON.message);
        }
    });    
}
//# sourceMappingURL=all.js.map
