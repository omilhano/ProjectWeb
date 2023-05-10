// Passwrod Verification

function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password != confirmPassword) 
        {
        alert("Passwords do not match.");
        return false;
        } 
    else {
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
    if (passwordPattern.test(password)) 
        {
        return true;
} else {
  alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.");
  return false;
    }
    }
}