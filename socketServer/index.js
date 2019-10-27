var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var pg = require('pg');


const config = {
  user: 'postgres',
  database: 'postgres',
  password: '123',
  port: 5432
};

var pool = new pg.Pool(config);



app.get('/', function(req, res){
  res.sendFile(__dirname + '/index.html');
});

io.on('connection', function(socket){
    console.log('a user connected');
    
    //Adicionando pedido na cozinha
    socket.on('add pedido', function(msg){
      pool.connect(function(err, client, done) {
        if (err) {
          return console.error('error fetching client from pool', err);
        }
        
        client.query('insert into tb_pedido_cozinha values (default,$1,$2,$3,null,$4) returning ci_pedido_cozinha',[msg.cd_produto,msg.cd_mesa,new Date(),msg.ds_observacao], function(err, result) {
          done();
          if (err) {
            return console.error('error running query', err);
          }
          msg.ci_pedido_cozinha = result.rows[0].ci_pedido_cozinha;
          msg.dt_inicio = new Date();
          io.emit('add pedido', msg);        
        });
    
      });  
        
      });

      socket.on('pedido feito', function(ci_pedido_cozinha){
        pool.connect(function(err, client, done) {
          if (err) {
            return console.error('error fetching client from pool', err);
          }
          
          client.query('update tb_pedido_cozinha values set dt_fim = $1 where ci_pedido_cozinha = $2 ',[new Date(),ci_pedido_cozinha], function(err, result) {
            done();
            if (err) {
              return console.error('error running query', err);
            }            
            io.emit('pedido feito', ci_pedido_cozinha);        
          });
      
        });  
          
        });


  
});

http.listen(3000, function(){
  console.log('listening on *:3000'); 


});


