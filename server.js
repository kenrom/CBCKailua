var connect = require('connect');
connect.createServer(
    connect.static(__dirname)
).listen(8080);

// Put a friendly message on the terminal
console.log("Server running at http://localhost:8080/");