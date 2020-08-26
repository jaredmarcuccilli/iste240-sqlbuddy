function Table(id, headers, data) {
    console.log(id, headers, data)
    
    this.is = (id) => {
        return id.toLowerCase() == this.id.toLowerCase();
    }

    this.create = () => {
        let tables = document.getElementById("Tables");
        let value = document.createElement("div");
        let header = document.createElement("h2");
        let table = document.createElement("table");
        let table_headers = document.createElement("tr");

        value.id = id.toLowerCase();
        header.innerHTML = id;
        table.className = "sqlTable";


        value.appendChild(header);

        for( let header of headers ){
            let column =  document.createElement("th");
            if(header.field_name == null){
                column.innerHTML = header;
            }
            else{
                column.innerHTML = header.field_name;
            }
            table_headers.appendChild(column);
        }

        for( let d of data ){
            let column =  document.createElement("td");
            column.innerHTML = header.field_name;
            table.appendChild(column);
        }

        table.appendChild(table_headers);
        value.append(table);
        tables.appendChild(value);
    }

    this.insert = (data_) => {
        for( let d of data_ ){
            data.push(d);
        }
    }
    
    this.delete = () => {
        value = document.getElementById(id.toLowerCase());
        value.innerHTML = "";
    }
    
    this.update = () => {
        let value;
        if(id == "Output"){
            value = document.getElementById("OutputView");
        }
        else{
            value = document.getElementById(id.toLowerCase());
        }
        
        let header = document.createElement("h2");
        let table = document.createElement("table");
        let table_headers = document.createElement("tr");
        value.innerHTML = ""

        header.innerHTML = id;
        table.className = "sqlTable";


        value.appendChild(header);

        for( let header of headers ){
            let column =  document.createElement("th");
            if(header.field_name == null){
                column.innerHTML = header;
            }
            else{
                column.innerHTML = header.field_name;
            }
            table_headers.appendChild(column);
        }


        table.appendChild(table_headers);
        for( let d of data ){
            let row = document.createElement("tr");
            for( let header of headers ){
                let column =  document.createElement("td");
                
                if(header.field_name == null){
                    column.innerHTML = d[header];
                }
                else{
                    column.innerHTML = d[header.field_name];
                }
                table_headers.appendChild(column);
                row.appendChild(column);
            }
            table.appendChild(row);
        }
        value.append(table);
    }

    this.union = (table) => {
        let mergeData = data;
        for (let d of table.getData()) {
            mergeData.push(d);
        }
        
        return new Table(table.getId(), table.getHeaders(), mergeData)
    }

    this.intersection = (table) => {
        let mergeData = [];

        for (let d of table.getData()) {
            let found = false;
            for( let d_ of data ){
                let valid = true;
                for( let attr of Object.keys(d) ){
                    if( d[attr] == d_[attr] ){
                        continue
                    }
                    valid = false;
                }
                if( valid ){
                    mergeData.push(d_)
                }
            }
        }

        return new Table(table.getId(), headers, mergeData)
    }

    this.getId = () => {
        return id;
    }

    this.getHeaders = () => {
        return headers;
    }
    
    this.getData = () => {
        return data;
    }
}