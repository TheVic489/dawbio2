document.addEventListener('DOMContentLoaded',  function(){
//el codi que es posarà en marxa quan carregui la meva web

//CREACIÓ D'objectes
var flight={
    airline:"Ryanair",
    number: 545,
    departure:{
        time:"2022-10-04",
        city:"Barcelona"
    },
    fullfligth: function(){
        return this.airline+" " +this.number;           
    }
}

var cat={};
cat.name="Rufus";
cat.species="cat";
cat.age=10;

//canvis de  valors
flight.airline="Vueling";
flight["number"]=789;

//escriure els valors

document.getElementById("objectes").innerHTML=flight.departure.city;
document.getElementById("objectes").innerHTML += "<br>"+flight.fullfligth();
console.log(flight);
console.log(document.getElementById("objectes"));
//var elMeuVol=new Vol();// concepte tradicional d'objecte

//JSON: JavaScript Object Notation--> objecte JS "modificat" a string

var avatar='{"name": "Manz","life":3,"totalLife": 6}';
console.log(avatar);
console.log(typeof avatar);

//JS em dóna dos funcions relacionades amb JSON
//parse
var user=JSON.parse(avatar);//cadena JSON a objecte
console.log(user);
console.log(typeof user);

var myCat=JSON.stringify(cat);//d'objecte passa a JSON
console.log(myCat);
console.log(typeof myCat);

///////Comunicació amb el servidor
document.getElementById("valida").addEventListener("click", function(){
    var name=document.getElementById("myName").value;
    var course=document.getElementById("myCourse").value;
    let user2={ //objecte
      nom: name,
      curs: course  
    };
    console.log(user2);


    //enviar aquest objecte al servidor:
    let xhr=new XMLHttpRequest();
    xhr.open("POST", "./php/server.php");//obrir connexio
    xhr.send(JSON.stringify(user2));//enviament de dades: objeto a JSON antes del envio
    xhr.onload=function(){//esperar a rebre dades

        if (xhr.status != 200) { // analiza el estado HTTP de la respuesta
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // ej. 404: No encontrado
          } else { // muestra el resultado
            //alert(`Hecho, obtenidos ${xhr.response.length} bytes`); // Respuesta del servidor
            //xhr.response es un JSON que viene desde PHP
            let responseServer= JSON.parse(xhr.response);//reconvertirlo/parsearlo a variable JS
            document.getElementById("response").innerHTML= responseServer;
          }



    }
});


});