function Insert(parent, tokenStream){

    insert_data = []
    if(tokenStream.readNextToken().getValue().toLowerCase() != "into"){
        error("Missing into in Insert statement");
    }
    let tableName = tokenStream.readNextToken().getValue()
    
    
    // Param list
    if(tokenStream.readNextToken().getType() != TYPE.OPEN ){
        error("Missaing open paren in Insert statement");
    }

    let layout = []
    while(tokenStream.peekNextToken().getType() != TYPE.CLOSE ){
        layout.push(tokenStream.readNextToken().getValue())

        if(tokenStream.peekNextToken().getType() == TYPE.COMMA ){
            tokenStream.readNextToken()
        }
    }
    tokenStream.readNextToken();

    if(tokenStream.readNextToken().getValue().toLowerCase() != "values"){
        error("Missing values stated in Insert statement");
    }

    // Values
    do{
        let i = 0;
        if(tokenStream.readNextToken().getType() != TYPE.OPEN ){
            error("Missing open paren in Insert statement");
        }

        let data = {}
        while(tokenStream.peekNextToken().getType() != TYPE.CLOSE ){
            data[layout[i]] = tokenStream.readNextToken().getValue();
            i++;

            if(tokenStream.peekNextToken().getType() == TYPE.COMMA ){
                tokenStream.readNextToken()
            }
        }
        tokenStream.readNextToken();
        insert_data.push(data)
        
        has_another = tokenStream.peekNextToken().getType() == TYPE.COMMA;
        if(has_another)
            tokenStream.readNextToken()
    }while(has_another);


    this.execute = () => {
        let table = parent.getTable(tableName);
        if(table == null){
            error("Could not find table, " + tableName);
        }
        table.insert(insert_data);
        table.update();
    }

    this.getTable = (id) => {
        return parent.getTable(id)
    }

    this.addTable = (id, table) => {
        parent.addTable(id, table);
    }
}
