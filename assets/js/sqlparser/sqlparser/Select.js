
function Select(parent, tokenStream){
    
    let feilds = [];
    let tableName;
    let statmentTree = null
    let where = true;

    this.execute = () => {
        let headers = feilds.slice();
        if( headers.includes("*") ){
            headers = parent.getTable(tableName).getHeaders();
        }

        let fromTable = parent.getTable(tableName); 
        let selectTable = fromTable.union(new Table('Output', headers, []));

        if( !where ){
            selectTable.update();
            return;
        }

        let finalTable = new Table("Output", headers, [])

        if( statmentTree ){
            let parent = statmentTree;
            do{
                let table = null
                if( parent.comp == "=" ){
                    let data = {}
                    data[parent.id] = parent.value;
                    table = new Table("Output", [{'field_name': parent.id}], [data]);
                    finalTable = finalTable.union(selectTable.intersection(table));
                }
                
            } while(parent.and != null && parent.or != null);
            finalTable.update();
        }
        
    }

    this.getTable = (id) => {
        return parent.getTable(id);
    }

    this.addTable = (id, table) => {
        parent.addTable(id, table);
    }  
    
    // Constructor 

    do{
        if(tokenStream.peekNextToken().getType() == TYPE.COMMA ){
            tokenStream.readNextToken();
        }

        feilds.push(tokenStream.readNextToken().getValue())
    }
    while(tokenStream.peekNextToken().getType() == TYPE.COMMA );

    if(tokenStream.readNextToken().getValue().toLowerCase() != "from"){
        error("Missing into in Insert statement");
    }
    tableName = tokenStream.readNextToken().getValue();

    if(tokenStream.peekNextToken().getValue().toLowerCase() != "where" ){
        where = false;
        return;
    }
    tokenStream.readNextToken();

    statmentTree = {}
    let parent_ = statmentTree;
    do {
        let token = tokenStream.readNextToken();

        if(token.getValue().toLowerCase() == "and"){
            parent_.and = {}
            parent_ = parent_.and;
        }
        else if(token.getValue().toLowerCase() == "or"){
            parent_.or = {}
            parent_ = parent_.or;
        }

        parent_.id = token.getValue();
        parent_.comp = tokenStream.readNextToken().getValue();
        parent_.value = tokenStream.readNextToken().getValue();

    } while(tokenStream.peekNextToken() != null && 
        (tokenStream.peekNextToken().getValue().toLowerCase() == "and" || 
        tokenStream.peekNextToken().getValue().toLowerCase() == "or") );

}