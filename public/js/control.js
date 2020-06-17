
console.log('prueba html')

var express = require('express');

var app = express();
var io = require('socket.io')(app.listen(8081));
var five = require("johnny-five");
 


const { Board, Thermometer } = require("johnny-five");
const board = new Board({
    repl:false,
    port:'COM3'
});

var relay = new five.Relay(10);

board.on("ready", () => {

  var commands = null;

  const thermometer = new Thermometer({
    controller: "DS18B20",
    pin: 2,
    freq: 1000,
    enabled: true
  });

  





  io.on('connection', function (socket) {
    socket.on('temperatura', function () {
      sensor.on("data", function() {
        socket.emit('peso', this.raw);
      });


      thermometer.on("data", () => {
        const {celsius} = thermometer;
      
       socket.emit('responseTemp', celsius );
      });

      });

      socket.on('stop', function(){
       console.log('detener')
      });

      socket.on('FanOn',function(){
        relay.on();
      })
      socket.on('FanOff',function(){
        relay.off();
      })

    })




});
