var fs = require("fs");
var config = JSON.parse(fs.readFileSync("config.json"));
var host = config.host;
var port = config.port;

// Uusi tapa
var express = require('express');
var app = express();

/* Vanha tapa
var express = express.createServer(); */

var router = express.Router();
app.use(express.static(__dirname + "/public"));

app.get("/", function(request, response) {
    response.send("Hello");
});

app.get("/hello/:text", function(request, response) {
    response.send("Hello " + request.params.text);
});

app.listen(port, host);