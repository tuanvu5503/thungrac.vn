/*=============================== DEFINE FUNCTION   ===============================*/
function showAlert (selector) {
    $(selector).fadeTo(2000, 500).delay(3000).slideUp(1000,function () {
        $("strong.mess").text('');
    });
}

function deleteCookie (cname) {
       document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function setAlert(name) {
    console.log('Ham setAlert nay da thay doi'); 
    content = $.cookie(name);
    deleteCookie(name);
    if (content) {
        $("strong.mess").text(content);
        if (name == 'success') {
            showAlert('#success-alert');
        } else if (name == 'failed') {
            showAlert('#failed-alert');
            $.cookie('failed','');
        }
    }
} 

function set_alert(status, msg) {
    if (status == 1) {
        $("strong.mess").text(msg);
        showAlert('#success-alert');

    } else {
        $("strong.mess").text(msg);
        showAlert('#failed-alert');
    }
} 