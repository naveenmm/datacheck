//var element="";
function disable(element) {
    document.getElementById(element).disabled = true;
    document.getElementById(element + "_disable").hidden = true;
    document.getElementById(element + "_enable").hidden = false;
}

function enable(element) {
    document.getElementById(element).disabled = false;
    document.getElementById(element + "_disable").hidden = false;
    document.getElementById(element + "_enable").hidden = true;
}

function post_edited() {
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'update.php';
    var mail = document.createElement('input');
    var phone = document.createElement('input');
    var college = document.createElement('input');

    var name = document.createElement('input');
    var collegeid = document.createElement('input');
    name.type = 'hidden';
    name.name = 'name';
    name.value = document.getElementById('name').value;
    collegeid.type = 'hidden';
    collegeid.name = 'collegeid';
    collegeid.value = document.getElementById('collegeid').value;
    mail.type = 'hidden';
    mail.name = 'mail';
    mail.value = document.getElementById('email').value;
    phone.type = 'hidden';
    phone.name = 'phone';
    phone.value = document.getElementById('phone').value;
    college.type = 'hidden';
    college.name = 'college';
    college.value = document.getElementById('college').value;
    /*if (document.getElementById('college')) {
        college.value = document.getElementById('college').value;
    }
    else {
        college.value = "";
    }*/
    form.appendChild(mail);
    form.appendChild(phone)
    form.appendChild(college)
    document.body.appendChild(form);
    form.submit();
}