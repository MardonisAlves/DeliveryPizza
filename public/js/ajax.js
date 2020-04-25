
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

  /* GET CAIZONE BY CODIGO*/
 /*$(document).ready(function(){
    $("codigo").change(function(){
    	
    	  event.preventDefault();

    	var formValues = $(this).serialize();
        $.get("/caizone",formValues , function(data){
            // Display the returned data in browser
            $("#result").html(data);
        });
    });
});
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


