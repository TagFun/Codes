// fs = file system
var fs = require("fs");
// Print out that we are starting
console.log("Starting");
// contents muuttujan määrittely
var contents = fs.readFileSync("config.json");
// Tulostetaan ulos muuttujaan tallennettu tiedostonluku komento
console.log("Contents: " + contents);
// Jäsennetään json tiedostossa olevat tiedot 
var config = JSON.parse(contents);
console.log("Config:", config);
console.log("Username: ", config.username);

// Execute here