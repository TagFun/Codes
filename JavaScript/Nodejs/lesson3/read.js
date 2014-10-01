/*
var fs = require("fs");
console.log("Starting");
fs.readFile("sample.txt", function (error, data) {
    console.log("Contents: " + data);
});

console.log("Carry on executing");
*/ 

// fs = file system
var fs = require("fs");
console.log("Starting");
// luetaan tekstitiedosto, joka on syötetty funktioon
var content = fs.readFileSync("sample.txt");
// tulostetaan ulos
console.log("Contents: " + content);
console.log("Carry on executing");