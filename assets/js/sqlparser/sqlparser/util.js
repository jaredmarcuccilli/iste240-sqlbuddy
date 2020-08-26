function isLetter(c) {
    return c.toLowerCase() != c.toUpperCase();
}

function isNumber(c){
    return Number.isInteger(parseInt(c)) || c == '.';
}

function error(message){
    console.log(message)
}