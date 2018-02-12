var forms = document.querySelectorAll('.validate');
for (var i = 0; i < forms.length; i++) {
    forms[i].setAttribute('novalidate', true);
}

var hasError = function (field) {

    if (field.disabled || field.type == 'file' || field.type == 'reset' || field.type == 'submit' || field.type == 'button') return false;

    if (field.name == 'inputConfirmPassword' && field.value != document.querySelector('input[name="inputPassword"]').value) return true;

    return !field.validity.valid;
};

var showError = function(field) {
    field.classList.add('error');

    var id = field.id || field.name;
    if (!id) return;

    var message = field.form.querySelector('.error-message#error-for-'+id);
    if(!message) {
        console.error("Create a <div> element with your message. Ex: <div class=\"error-message not-visible\" id=\"error-for-inputUsername\">Please choose a username.</div>")
    }

    message.classList.remove('hidden');
    message.classList.add('visible');
}

var removeError = function (field) {

    field.classList.remove('error');

    var id = field.id || field.name;
    if (!id) return;

    var message = field.form.querySelector('.error-message#error-for-' + id + '');
    if (!message) return;

    message.classList.remove('visible');
    message.classList.add('hidden');

}

document.addEventListener('blur', function (ev) {

    if (!event.target.form.classList.contains('validate')) return;

    if (hasError(ev.target)) {
        showError(ev.target);
        return;
    }

    removeError(ev.target);
}, true);

document.addEventListener('submit', function (event) {

    if (!event.target.classList.contains('validate')) return;

    var fields = event.target.elements;

    var hasErrors = false;
    for (var i = 0; i < fields.length; i++) {
        if (hasError(fields[i])) {
            showError(fields[i]);
            hasErrors = true;
        }
    }

    if (hasErrors) {
        event.preventDefault();
    }

}, false);