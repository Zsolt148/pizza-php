//Ajax
function sendAjaxReq(url, input, callback) {
    $.ajax({
        url: url,
        type: "post",
        data: {data:input},
        dataType: 'JSON',
        beforeSend: function() {
        },
        success: function() {
        },
    }).done(function(resp) {
        callback(resp);
    });
}