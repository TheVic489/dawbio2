$(document).ready(function(){

  //accedo a cookie (metodo en el otro script)
  let myCookie= window.opener.getCookie("nombre");
  
  $("#id1").html(myCookie);
  //accedo al index.html
  //let myVariable=window.opener.$("#par2").html();
 
 //accedo a una variable global de script.js
  let  myVariable=window.opener.variable;
  $("#id1").append("<b>"+myVariable+"</b>");

  $("#b1").click(function(){
    window.close();
  })
  
  $("#b2").click(function(){
    window.print();
  })
});
