
 // carousel 
 $(document).ready(function(){
 $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
});

 $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    });
       
    /* select new user*/
    $('select').formSelect();
    /*dropdown*/
    $(".dropdown-trigger").dropdown();
    /*navAdmin*/
    $('.sidenav').sidenav();
    });




 $(document).ready(function(){
  $('.sidenav').sidenav();
});

 $(document).ready(function(){
    $('.modal').modal();
  });

  $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });

/*
		GET CARDAPIO BY CODIGO
*/
function showCodigo(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/caizone?q="+str, true);
  xhttp.send();
}


