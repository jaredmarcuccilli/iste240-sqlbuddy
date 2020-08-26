
TYPE = {
    ID_OR_KEYWORD: 0,
    SELECT_ALL: 1,
    STRING: 2,
    END: 3,
    OPEN: 4,
    CLOSE: 5,
    COMMA: 6,
    NUMBER: 7,
    EQUAL: 8,
}

function Token(value, type){
    this.getType = () => {
        return type;
    }
    this.getValue = () =>{ 
        return value;
    }
}

function reserved(c) {
    return [
        ';', 
        '(', 
        ')', 
        ',',
        '=',
        '*'
    ].includes(c);
}

function Parser(text) {
    let stream = [];
    let index = 0;

    let i = 0;
    while(i < text.length ){
        c = text.charAt(i);
        token = "";

        if(isLetter(c)){
            while( (isLetter(c) || isNumber(c) ) &&  !reserved(c) ){
                token += c;
                i++;
                c = text.charAt(i);
            }
            stream.push(new Token(token, TYPE.ID_OR_KEYWORD));
            i--;
        }
        else if(isNumber(c)){
            while( isNumber(c) ){
                token += c;
                i++;
                c = text.charAt(i);
            }
            stream.push(new Token(token, TYPE.NUMBER));
            i--;
        }
        else if(c == "\""){
            i++;
            c = text.charAt(i);
            while( c != "\"" ){
                token += c;
                i++;
                c = text.charAt(i);
            }
            stream.push(new Token(token, TYPE.STRING));
        }
        else if(c == "*"){
            token += c;
            stream.push(new Token(token, TYPE.SELECT_ALL));
        }
        else if(c == "="){
            token += c;
            stream.push(new Token(token, TYPE.EQUAL));
        }
        else if(c == ";"){
            token += c;
            stream.push(new Token(token, TYPE.END));
        }
        else if(c == "("){
            token += c;
            stream.push(new Token(token, TYPE.OPEN));
        }
        else if(c == ")"){
            token += c;
            stream.push(new Token(token, TYPE.CLOSE));
        }
        else if(c == ","){
            token += c;
            stream.push(new Token(token, TYPE.COMMA));
        }

        i++;
    }

    this.readNextToken = () => {
        index++;
        return stream[index - 1];
    }

    this.peekNextToken = () => {
        return stream[index];
    }
    
    this.isEmpty = () => {
        return index >= stream.length;
    }

}

