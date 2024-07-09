function validateFormSignIn() {
    var userEmail = document.getElementById("signInEmail").value;
    var userPassword = document.getElementById("signInPassword").value;

    var emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(userEmail)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Add any additional validation logic for sign-in if needed

    return true;
}

function validateFormSignUp() {
    var userFullName = document.getElementById("fullName").value;
    var userEmail = document.getElementById("signUpEmail").value;
    var userPassword = document.getElementById("signUpPassword").value;
    var userConfirmPassword = document.getElementById("confirmPassword").value;

    var nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(userFullName)) {
        alert("Name should contain only letters.");
        return false;
    }

    var emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(userEmail)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (userPassword !== userConfirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
