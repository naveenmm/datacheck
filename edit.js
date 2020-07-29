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
    var graduation_college = document.createElement('input');
    var post_graduation_college = document.createElement('input');
    mail.type = 'hidden';
    mail.name = 'mail';
    mail.value = document.getElementById('email').value;
    phone.type = 'hidden';
    phone.name = 'phone';
    phone.value = document.getElementById('phone').value;
    graduation_college.type = 'hidden';
    graduation_college.name = 'graduationCollege';
    graduation_college.value = document.getElementById('graduationCollege').value;
    post_graduation_college.type = 'hidden';
    post_graduation_college.name = 'post_graduationCollege';
    post_graduation_college.value = document.getElementById('post_graduationCollege').value;

    form.appendChild(mail);
    form.appendChild(phone)
    form.appendChild(graduation_college)
    form.appendChild(post_graduation_college)
    document.body.appendChild(form);
    form.submit();
}
