function callback_date() {
    $.ajax({
        url: '../functions/dateSetting.php',
        type: 'POST',
        data: {date: $(this).val()},
        success: function(response) {
            console.log(response);
        }
    });
}

$(document).ready(function() {
    var date_setting = document.getElementById('date-setting');
    date_setting.addEventListener('change', callback_date);
});