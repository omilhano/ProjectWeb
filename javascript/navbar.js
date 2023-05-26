//escrever no html file para garantir que funciona

$(document).ready(function() {
    let $menu = $('#menu-icon'); // Select menu-icon element
    let $navbar = $('.navbar'); // Select navbar element
  
    $menu.on('click', function() { // When menu-icon is clicked function() {...} activated
      $menu.toggleClass('bx-x'); //adiciona class ".bx-x" q é um "X"
      $navbar.toggleClass('open');//adiciona class ".open" q va ativar o css q traz o dropddown da direita
    });
  });
  //Quando voltamos a clicar no menu-item ambas as classes são removidas

  // Get the modal
var modal = document.getElementById("file_modal");

// Get the button that opens the modal
var btn = document.getElementById("login-button");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
// Checks if password corresponds to the user
function checkPassword() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (password === "mypassword") {
        // correct password, do something
    } else {
        // incorrect password, update error message
        var errorElement = document.getElementById("password-error");
        errorElement.textContent = "Incorrect password. Please try again.";
    }
}
// This part removes the text from the modal when it gets closed
$('#password-error').text('');

$(".close").click(function() {
    $('#password-error').text('');
    $("#file_modal").css("display", "none");
});
document.getElementById("close-modal").addEventListener("click", function() {
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
});