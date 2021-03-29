// Show Password function
const showPassword = () => {
    let passwordInput = document.getElementById("passwordInput");
    if(passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function userNameValidation() {
    var valid = true;
    $("#username").removeClass("error-field");
    var UserName = $("#username").val();
    $("#username-info").html("").hide();

    if (UserName.trim() == "") {
        $("#username-info").html("required.").css("color", "#ee0000").show();
        $("#username").addClass("error-field");
        valid = false;
    }
    if (valid == false) {
        $('.error-field').first().focus();
        valid = false;
    }
    return valid;
}
