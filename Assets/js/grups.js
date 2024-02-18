import * as lib from './lib.js';
class Grup {
    constructor(excel) {
        
        this.excel = excel;
    }

    crearGrup() {
        let numGrups = 3; // Number of groups you want
        let nGrup = Math.ceil((excel.length - 1) / numGrups); // Size of each group, subtract 1 from excel.length to account for the skipped row
    
        let Divtable = document.getElementById('llistatGrups');
        for (let i = 0; i < numGrups; i++) { // Create groups
            let table = lib.crearElement('table', {id: 'grup' + (i + 1),class: 'table-container'},"");
            let tr = document.createElement('tr');
            let th = document.createElement('th');
            th.textContent = 'Grup ' + (i + 1);
            tr.appendChild(th);
            table.appendChild(tr);
    
            // Calculate the start and end indices for each group
            let start = i * nGrup + 1; // Start from 1 to skip the first row
            let end = start + nGrup;
            if (i === numGrups - 1) { // For the last group, make sure to include all remaining elements
                end = excel.length;
            }
    
            // Add elements to the group
            for (let j = start; j < end; j++) {
                let tr = document.createElement('tr');
                let td = document.createElement('td');
                td.textContent = excel[j][0]; // Assuming you want to display the first value of each element
                tr.appendChild(td);
                table.appendChild(tr);
            }
            Divtable.appendChild(table);
        }
    }
}

let excel = JSON.parse(localStorage.getItem('excel'));



$('#crearGrups').on('click', function() {

    let grup = new Grup( excel);
    grup.crearGrup();  

});