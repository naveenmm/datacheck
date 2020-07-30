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
    graduation_college.type = 'hidden';
    graduation_college.name = 'graduationCollege';
    if (document.getElementById('graduationCollege')) {
        graduation_college.value = document.getElementById('graduationCollege').value;
    }
    else {
        graduation_college.value = "";
    }

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

function display_details() {
    //document.getElementById('details_confirm').innerHTML="email:"+document.getElementById('email').value;
    if (!document.getElementById('graduationCollege')) {
        var grad = "nil";
    }
    else {
        var grad = document.getElementById('graduationCollege').value;
    }
    if (!document.getElementById('post_graduationCollege')) {
        var postgrad = "nil";
    }
    else {
        var postgrad = document.getElementById('post_graduationCollege').value;
    }
    var details = "Name:" + document.getElementById('name').value + "\nCollegeid:" + document.getElementById('collegeid').value + "\nEmail:" + document.getElementById('email').value + "\nPhone:" + document.getElementById('phone').value + "\nGraduation College:" + grad + "\nPOST-Graduation College:" + postgrad;
    document.createTextNode(details);
    //document.getElementById('details_confirm').appendChild(document.createTextNode("Name:"+document.getElementById('name').value));
    //document.getElementById('details_confirm').appendChild(document.createTextNode("\nCollegeid:"+document.getElementById('collegeid').value));
    //document.getElementById('details_confirm').innerHTML(details);
}