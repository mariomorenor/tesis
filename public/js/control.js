

console.log('prueba html')

var express = require('express');

var app = express();
var io = require('socket.io')(app.listen(8081));
var five = require("johnny-five");




const {
    Board,
    Thermometer,
} = require("johnny-five");
const board = new Board({
    repl: false,
    port: 'COM3'
});

board.on("ready", () => {
  var relayVentilador = new five.Relay(10);
  var relayFoco = new five.Relay(3);
  var relayMotor = new five.Relay(11);

    var commands = null;


    const thermometer = new Thermometer({
        controller: "DS18B20",
        pin: 2,
        freq: 1000,
        enabled: true
    });

      relayVentilador.on();
      relayFoco.on();



    io.on('connection', function (socket) {

        socket.on('temperatura', function () {
          
            thermometer.on("data", () => {
                const {
                    celsius
                } = thermometer;

                socket.emit('responseTemp', celsius);
            });

        });

        socket.on('stop', function () {
          relayVentilador.on();
          relayFoco.on();
        });

        socket.on('FanOn', function () {
            relayVentilador.off();
        })
        socket.on('FanOff', function () {
            relayVentilador.on();
        })
        socket.on('LuzOn', function () {
            relayFoco.off();
        })
        socket.on('LuzOff', function () {
            relayFoco.on();
        })
        socket.on('motorOn', function () {
            relayMotor.off();
        })
        socket.on('motorOff', function () {
            relayMotor.on();
        })

    })




});
