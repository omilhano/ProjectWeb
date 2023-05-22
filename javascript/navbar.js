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