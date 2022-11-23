//fent servir només el port 3000
// 'use strict'
// const express = require('express')
// const app=express()
// app.listen(3000, ()=>{
//     console.log('Aquesta és la nostra API-REST que corre en http://localhost:3000')
// })
//generalitzant el port
// 'use strict'
// const express = require('express')
// const app=express()
// const port =process.env.PORT || 3000
// app.listen(port, ()=>{
// console.log(`Aquesta és la nostra API-REST que corre en http://localhost:${port}`)
// })
'use strict'

//importacions i creació de constants per a la seva utilització
const express = require('express')
const bodyParser=require('body-parser')
const app=express()
//si volem mysql/////////////////////////////
//Primer hem d'instal·lar mysql amb npm i -S mysql
//importem mysql
const mysql = require('mysql');
//declarem els paràmetres de connexió
var connection = mysql.createConnection({
    host: 'localhost',
    database: 'test',
    user: 'root',
    password: ''
  });
//////////////////////////////////////

//middleware
//configuració del bodyParser perquè admeti entrades json i
app.use(bodyParser.urlencoded({extended:false}))
app.use(bodyParser.json())

// app.get('/hola',(req,res)=>{
//     //req seria el que entra
//     //res seria la resposta
//     //al nostre cas no ens enviem res. Faig que envïi en json una resposta. Escrivim al navegador:
//     //http://localhost:3001/hola
//     res.send({message:'Hola Mundo'})
// })
// //get amb paràmetre d'entrada
// app.get('/hola/:name',(req,res)=>{
//     //req seria el que entra
//     //res seria la resposta
//     //al nostre cas no ens enviem res. Faig que envïi en json una resposta. Escrivim al navegador:
//     //http://localhost:3001/hola
//     res.send({message:`Hola Mundo ${req.params.name}!`})
// })

//Exemple de rutes per a un començ electrònic
//get sense paràmetres
app.get('/api/product',(req,res)=>{
   res.send(200,{products:[]})
})
//get amb paràmetres, per exemple volem un producte amb una determinada id
app.get('/api/product/:productId',(req,res)=>{

})
//post amb idèntica url que el get 
//ens anem a baixar un programa de testeig d'apis que es diu postman.
//D'aquesta manera provarem les nostres peticions fora del get. Menú Evironement
app.post('/api/product/',(req,res)=>{
    console.log(req.body)//req.body ho puc fer servir gràcies a body-parser
    
    res.status(200).send({message: 'Producte rebut'})
})
//put amb idèntica url que el get corresponent però entra un id, serviria per a actualitzar un determinat producte
app.put('/api/product/:productId',(req,res)=>{

})
//volem esborrar un producte amb una determinada id
app.delete('/api/product/:productId',(req,res)=>{

})

//fem servir la BBDD que tenim

app.post('/api/login', function (req, res) {
    
    console.log("estem a login");
    
    //provem de connectar-nos i capturar possibles errors
    connection.connect(function(err) {
      console.log(err);
      if (err) {
          console.error('Error connecting: ' + err.stack);
          return;
      }
      console.log('Connected as id ' + connection.threadId);
    });

    connection.query('SELECT * FROM users',function(error, results,field){
      
      if (error){
        res.status(400).send({resultats: null})
      }else{
        /*COMPROVACIÓ DE DADES PER CONSOLA DE NODE*/
        //   console.log(results);
        //   results.forEach(result => {
        //     console.log(result.user);
        //   })

        res.status(200).send({resultats: results})
      }

    
       
    });
    connection.end();
  })
app.listen(3001, ()=>{
    console.log('Aquesta és la nostra API-REST que corre en http://localhost:3001')
})
