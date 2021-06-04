function showRegisterForm() {
    $('.loginBox').fadeOut('fast', function () {
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Rejestracja');
    });
    $('.error').removeClass('alert alert-danger').html('');

}

function showLoginForm() {
    $('#loginModal .registerBox').fadeOut('fast', function () {
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast', function () {
            $('.login-footer').fadeIn('fast');
        });

        $('.modal-title').html('Logowanie');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function openLoginModal() {
    showLoginForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

// function isEmail(email) {
//     const email_regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     const name_regex = /^[A-Za-z0-9_-]{6,20}$/;
//     const password_regex = /^\w{6,20}$/;
//     var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//     return email_regex.test(email);
//   }

function login() {
    var username = $("#username").val().trim();
    var password = $("#password").val().trim();

    if (username != "" && password != "") {
        $.ajax({
            url: 'phpScripts/checkUser.php',
            type: 'post',
            data: { username: username, password: password },
            success: function (response) {
                if (response == 1) {
                    window.location = "dashboard.php";
                } else if (response == 0){
                    window.location.reload(false);
                }
                else {
                    shakeModal("Zły login lub hasło");
                }
            }
        });
    } else {
        shakeModal("Pola nie mogą być puste");
    }
}

function register() {
    var username = $("#username2").val().trim();
    var password = $("#password2").val().trim();
    var confirm_pass = $("#password_confirmation").val().trim();

    if (username != "" && password != "" && confirm_pass != "") {
        if (password === confirm_pass) {
            $.ajax({
                url: 'phpScripts/checkRegister.php',
                type: 'post',
                data: {username: username, password: password},
                success: function (response) {
                    if (response == 1) {
                        window.location = "user.php";
                    } else {
                        shakeModal("Istnieje taki użytkownik");
                    }
                }
            });
        } else {
            shakeModal("Hasła muszą być identyczne");
        }
    } else {
        shakeModal("Pola nie mogą być puste");
    }
}

function shakeModal(err_code) {
    $('#loginModal .modal-dialog').addClass('shake');
    $('.error').addClass('alert alert-danger').html(err_code);
    $('input[type="password"]').val('');
    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000);
}