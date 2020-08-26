
function Program(){
    let statementList = [];
    this.tables = {}

    this.run = (tokenStream) => {
        while(!tokenStream.isEmpty()){
            token = tokenStream.readNextToken();

            if( token.getValue().toLowerCase() == "select"){
                statementList.push(new Select(this, tokenStream));
            }
            else if( token.getValue().toLowerCase() == "create"){
                statementList.push(new Create(this, tokenStream));
            }
            else if( token.getValue().toLowerCase() == "insert"){
                statementList.push(new Insert(this, tokenStream));
            }
            else if( token.getValue().toLowerCase() == "drop"){
                console.log("here");
                statementList.push(new Drop(this, tokenStream));
            }

            let end = tokenStream.readNextToken();
            if( end == null || end.getType() != TYPE.END) {
                error('Missing ; at end of statement');
                break;
            }
        }
    }


    this.execute = () => {
        for(let statement of statementList){
            statement.execute();
        }
        statementList = [];
    }

    this.getTable = (id) => {
        if(this.tables[id.toLowerCase()] == null){
            error("Table not found, " + id);
            return null;
        }
        return this.tables[id.toLowerCase()];
    }


    this.removeTable = (id) => {
        if(this.tables[id.toLowerCase()] == null){
            error("Table not found, " + id);
        }
        this.tables[id.toLowerCase()].delete();
        this.tables[id.toLowerCase()] = null;
    }
    this.addTable = (id, table) => {
        this.tables[id.toLowerCase()] = table;
    }
}
