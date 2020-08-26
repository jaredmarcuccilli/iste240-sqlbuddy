
function Create(parent, tokenStream){
    fields = []
    if(tokenStream.readNextToken().getValue().toLowerCase() != "table"){
        error("Missing table in create statement");
    }

    let tableName = tokenStream.readNextToken().getValue()
    if( parent.getTable(tableName) != null ){
        error("Table already created");
        while(tokenStream.peekNextToken().getType() != TYPE.END ){
            tokenStream.readNextToken();
        }
    }


    if(tokenStream.readNextToken().getType() != TYPE.OPEN ){
        error("Missing open paren in create statement");
    }

    while(tokenStream.peekNextToken().getType() != TYPE.CLOSE ){
        let data = {
            'field_name': tokenStream.readNextToken().getValue(),
            'field_type': tokenStream.readNextToken().getValue().toLowerCase()
        }

        if(data.field_type == "varchar"){
            if(tokenStream.readNextToken().getType() != TYPE.OPEN ){
                error("Missing open paren for varchar in create statement");
            }
            
            data['length'] = parseInt(tokenStream.readNextToken().getValue());

            if(tokenStream.readNextToken().getType() != TYPE.CLOSE ){
                error("Missing close paren for varchar in create statement");
            }
        }
        fields.push(data);

        if(tokenStream.peekNextToken().getType() == TYPE.COMMA ){
            tokenStream.readNextToken()
        }
    }
    tokenStream.readNextToken();


    this.execute = () => {
        let table = new Table(tableName, fields , [])
        parent.addTable(tableName, table);

        table.create();
    }


    this.getTable = (id) => {
        return parent.getTable(id)
    }

    this.addTable = (id, table) => {
        parent.addTable(id, table);
    }

    this.removeTable = (id) => {
        return parent.removeTable(id)
    }
}