function validateForm() {

    var f_name = document.getElementById("full_name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;
    var profile = document.getElementById("profile").value;

    if (f_name == '') {
        document.getElementById("alertname").innerText = "Full cannot be empty";
        return false;
    }
    if (email == '') {
        document.getElementById("alertemail").innerText = "Email cannot be empty";
        return false;
    }
    if (password == '') {
        document.getElementById("alertpassword").innerText = "password cannot be empty";
        return false;
    } else {

        if (password.length < 8) {
            document.getElementById("alertpassword").innerText = "password should be greater than 8 character";

        }
    }

    if (cpassword == '') {
        document.getElementById("alertcpassword").innerText = "comfirm password cannt be empty";
        return false;
    } else {
        if (cpassword.length < 8) {
            document.getElementById("alertcpassword").innerText = "password should be greater than 8 character";

        }
    }
    if (password != cpassword) {
        alert("password and comfirm password do notmatched");
    }
    if (profile == '') {
        document.getElementById("alertfile").innerText = "You must select the profile picture";

        return false;
    }
    document.getElementById('sign-up').submit();

}