
 // carousel 
 $(document).ready(function(){
 $('.carousel.carousel-slider').carousel({
    fullWidth: true,
    indicators: true
  });
});

 

// slidnav , slect . dropdown
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

// modal
 $(document).ready(function(){
    $('.modal').modal();

    $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });
  });

// editcardapio
function editcardapio(str) {
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
  xhttp.open("GET", "/listar?categoria="+str, true);
  xhttp.send();
}


 // get pizzaz
function showCodigo(str) {
  console.log(str);
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



// alert exluir
 function Deletar(str) {
        function alert(){   
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

        xhttp.open("GET", "/excluir?urlimg="+str, true);
        xhttp.send();
}
var con = confirm("Deseja Excluir este item!");
if(con == true){
 alert();
}else{
  return false;
}
}


// get pizzaz by id
function Pizza(str){

var xhttp;    
  if (str == "") {
    document.getElementById("pizzaid").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pizzaid").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/listarid?id="+str, true);
  xhttp.send();

}



