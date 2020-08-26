
function Drop(parent, tokenStream){
    if(tokenStream.readNextToken().getValue().toLowerCase() != "table"){
        error("Missing table in drop statement");
    }

    let tablename = tokenStream.readNextToken().getValue();

    this.execute = () => {
        this.removeTable(tablename);
    }

    this.getTable = (id) => {
        return parent.getTable(id)
    }

    this.removeTable = (tablename) => {
        return parent.removeTable(tablename)
    }

    this.addTable = (id, table) => {
        parent.addTable(id, table);
    }
}


