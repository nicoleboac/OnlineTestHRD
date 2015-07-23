$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });

$(document).ready(function(){
$('div.navbar-nav li').click(
    function(e)
    {
        $('div.navbar-nav li').removeClass('active');
        $(e.currentTarget).addClass('active');
    }
);
});

function checkPassword(){
	if(document.getElementById('password1').value != document.getElementById('password2').value){
		return false;
	}
}
function checkHash(){
  if(window.location.hash.indexOf(  "#register")!=-1 ){
    $( "#registerArea").toggleClass( "hidden2" );
          $("#registerArea").toggleClass("active");
          $("#logInArea").toggleClass("active");
      $("#logInArea").toggleClass("hidden2");
  }
}
$( ".navbar-nav li" ).click(function() {
  setTimeout(function() {
  	if(window.location.hash == "#register" && $("#registerArea").hasClass("hidden2")){
	       	$( "#registerArea").toggleClass( "hidden2" );
	       	$("#registerArea").toggleClass("active");
	       	$("#logInArea").toggleClass("active");
	  	$("#logInArea").toggleClass("hidden2");

  	}
 }, 100);
  setTimeout(function() {
    if(window.location.hash == "#logIn" && $("#logInArea").hasClass("hidden2")){
	       $( "#registerArea").toggleClass( "hidden2" );
	       	$("#registerArea").toggleClass("active");
	       	$("#logInArea").toggleClass("active");
	  	$("#logInArea").toggleClass("hidden2");
  }
   }, 100);
});

$( "#clickToRegister" ).click(function() {
  setTimeout(function() {
    if(window.location.hash == "#register" && $("#registerArea").hasClass("hidden2")){
          $( "#registerArea").toggleClass( "hidden2" );
          $("#registerArea").toggleClass("active");
          $("#logInArea").toggleClass("active");
      $("#logInArea").toggleClass("hidden2");

    }
 }, 100);
  });
checkHash();

$(function() {
            $( "#dialog-1" ).dialog({
               autoOpen: false,  
            });
         });

$("#dropdown").click(function(){
  $(this).toggleClass("open");
});

function search(){
  var keyword = document.getElementsByClassName("search")[0].value;
  window.location.assign("applicants.php?search="+keyword);

}