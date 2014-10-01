var fs = require("fs");
console.log("Starting");
// Luodaan tekstitiedosto johon kirjoitetaan teksti Hello World
fs.writeFileSync("write_sync.txt", "Hello Word");
console.log("Finished");

/*
var fs = require("fs");
console.log("Starting");
// Luodaan tekstitiedosto johon kirjoitetaan teksti Hello World
fs.writeFile("write_sync.txt", "Hello Word", function(error) {
    console.log("Written file!");
});

console.log("Finished");
*/