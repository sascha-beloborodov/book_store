
function addTokens(data) {
    data = data || {};
    data.csrf_name = $('#csrf_name').val();
    data.csrf_value = $('#csrf_value').val();
    return data;
}

function updateTokens(response) {
    if (response.csrf_name != undefined &&
        response.csrf_value != undefined)
    {
        $('#csrf_name').val(response.csrf_name);
        $('#csrf_value').val(response.csrf_value);
    }
}