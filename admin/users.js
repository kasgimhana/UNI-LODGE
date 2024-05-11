let add_new_user_form = document.getElementById('add-new-user-form');

        add_new_user_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_new_user()
        });

function add_new_user() {
    let data = new FormData();

    data.append('name', add_new_user_form.elements['name'].value);
    data.append('email', add_new_user_form.elements['email'].value);
    data.append('phone_number', add_new_user_form.elements['phone_number'].value);
    data.append('secondary_phone_number', add_new_user_form.elements['secondary_phone_number'].value);
    data.append('address', add_new_user_form.elements['address'].value);
    data.append('password', add_new_user_form.elements['password'].value);
    data.append('confirm_password', add_new_user_form.elements['confirm_password'].value);
    data.append('role', add_new_user_form.elements['role'].value);
    data.append('register', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);

    xhr.onload = function() {
        if (this.responseText == 'password_mismatch') {
            alert("Error", "Password Mismatch", "danger");
        } else if (this.responseText == 'already_exits') {
            alert("Error", "User Already Registered", "danger");
        } else if (this.responseText == '1') {
            alert("Success", "User registered successfully", "success");
    
            var modalReference = document.getElementById('addUserModal');
            var modal = bootstrap.Modal.getInstance(modalReference);
            modal.hide();
            add_new_user_form.reset();
            get_all_users();
        } else {
            alert("Error", "Server Error (Registration Failed)", "danger");
        }
    }
    xhr.send(data);
};


function get_all_users() {
    let xhr = new  XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('users-data').innerHTML = this.responseText;
    }
    xhr.send('get_all_users');
}  

 window.onload = function() {
            get_all_users('get_all_users');
        }