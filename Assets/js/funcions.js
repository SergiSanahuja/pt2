
var fs = require('fs');
var XLSX = require('xlsx');
var wb = XLSX.utils.book_new();
wb.Props = {
    Title: "FileFomat",
    Subject: "Developer Guide"
};
wb.SheetNames.push("Test Sheet");
var ws_data = [['hello' , 'world']];
var ws = XLSX.utils.aoa_to_sheet(ws_data);
wb.Sheets["Test Sheet"] = ws;
var wbout = XLSX.write(wb, {bookType:'xlsx', type: 'binary'});



function init() {
    $('#afegirForm').click(() => {
        // $('#form')[0].reset();
        $('#divForm').show();
    });
    
    $('#cancelar').click(() => {
        $('#divForm').hide();
    });
}





init();