var variable="Hola";
$(document).ready(function(){
    
  
  obrirFinestra();
  

//DOM

//ELS NODES pares
 
  // $("span").parent().css({"color": "deeppink","border":"5px solid"});//apliquem estil només al pare de tots els span
  // console.log($("span").parent());//tot: array de dues posicions
  // console.log($("span").parent().eq(2));//p que ocupa la posicio 1
 
 //exemple 2
//  $("span").parents().css({"color": " blue","border":"5px solid"});//apliquem estil a tots els que li envolten
//  console.log($("span").parents());//tot: array de dues posicions
//  console.log($("span").parents().eq(2));//p que ocupa la posicio 1
 
 //exemple 3
//  $("span").parentsUntil("div").append("**********EXEMPLE 3***************");//apliquem estil fins al primer div
//  console.log($("span").parentsUntil("div"))

 //ELS NODES fills

 //exemple 4
 //$(".ancestors").children().prepend("EXEMPLE 4");

 //exemple 5
 //$(".ancestors").children("div:first").css({"color": "green","border":"2px solid"});

 //ELS NODES germans

 //exemple 6
 //$("#id0").siblings().css({"color": "red","border":"2px solid"});//germans a la mateixa alçada
 //$("h2").siblings("p").css({"color": "green","border":"2px solid red"});//germans d'h2 però que siguin paràgrafs p
 
 //exemple 7
 //$("h2").next().css({"color": "blue","border":"2px solid red"});//el següent germà
 //$("h2").next().text("eoeoeoeo");//el següent germà, li faig canvi de text
 //$("h2").nextAll().css({"color": "red","border":"5px solid"});//els següents germans
 //$("#p2").nextUntil("h3").css({"color": "gray","border":"2px solid red"});//else següents germans fins a l'h3

 //RECERCA DE NODES

 //$("p").first().css({"color": "red","border":"2px solid"});//el primer paràgraf
 //$("p").last().css({"color": "red","border":"2px solid"});//el darrer paràgraf
 //$("div").eq(2).css({"color": "red","border":"2px solid red"});//el div en la posició 1 de l'array de divs
 //$("div").filter(".ancestors").css({"color": "red","border":"2px solid red"});


});

function getCookie(name) {
  var match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
  if (match) return match[2];
  return null;
}

function obrirFinestra(){
//FINESTRES POP UP
  if(confirm("Estàs segur que vols obrir la finestra?")){
  //  //Obrim una finestra amb una pàgina web i configurem algunes opcions
     // window.open("http://www.google.es", "_blank","top=100,left=800,width=300,height=300");
     document.cookie="nombre=Pere Garcia";
     window.open("./popup/anotherPage.html");
   }else{
      alert("No he obert la finestra");
   }
}