import * as lib from './lib.js';
class Grup {
    excel = [];

    constructor(excel) {
        
        this.excel = excel;
    }

   
        // crearGrup() {
        //     let numGrups = 3; // Number of groups you want
        //     let nGrup = Math.ceil((excel.length - 1) / numGrups); // Size of each group, subtract 1 from excel.length to account for the skipped row
        
        //     let tableContainer = document.getElementById('llistatGrups');
        //     for (let i = 0; i < numGrups; i++) { // Create groups
        //         let table = lib.crearElement('div',{class:'Grupos col-3',id:'grup'+i},"");
        //         let tr = lib.crearElement('div',{class:'fila col-3 nGrup'},'Grup' + (i + 1));
        //         table.appendChild(tr);
        //         tableContainer.appendChild(table);
        
        //         // Calculate the start and end indices for each group
        //         let start = i * nGrup + 1; // Start from 1 to skip the first row
        //         let end = start + nGrup;
        //         if (i === numGrups - 1) { // For the last group, make sure to include all remaining elements
        //             end = excel.length;
        //         }
        
        //         // Add elements to the group
        //         for (let j = start; j < end; j++) {
        //             let tr = lib.crearElement('div',{class:'fila col-3'},'');
        //             tr.textContent = excel[j][0]; // Assuming you want to display the first value of each element
        //             table.appendChild(tr);
        //         }
        //     }

        //     tableContainer.appendChild(table);
        // }
    
    
        crearGrup(){
            this.excel = this.excel.filter((index) => index[0] != "Nombre");  
            this.temp = lib.shuffleArray(this.excel);
            localStorage.setItem('Grups', JSON.stringify(this.temp));
            this.mostrarGrups();
        }


        mostrarGrups(){
            
            
            if(localStorage.getItem('Grups') != null){
                this.temp = JSON.parse(localStorage.getItem('Grups'));
            }else{
                return;
            }
            let numGrups = 4; // Number of groups you want
            let nGrup = Math.ceil((this.temp.length) / numGrups); // Size of each group, subtract 1 from excel.length to account for the skipped row

            let tableContainer = document.getElementById('llistatGrups');
            tableContainer.innerHTML = "";
            for (let i = 0; i < numGrups; i++) { // Create Grups
                let table = lib.crearElement('div',{class:'Grupos col-3',id:'grup'+i},"");
                let tr = lib.crearElement('div',{class:'fila col-3 nGrup'},'Grup' + (i + 1));
                table.appendChild(tr);
                tableContainer.appendChild(table);

                for (let j = 0; j < nGrup; j++) { //Afegir usuaris
                    let tr = lib.crearElement('div',{class:'fila col-3'},'');
                    tr.textContent = this.temp[j][0]; // Assuming you want to display the first value of each element
                    table.appendChild(tr);
                    this.temp = this.temp.filter((index) => index[0] != this.temp[j][0]);
                }
            }
        }


    }

let excel = JSON.parse(localStorage.getItem('excel'));

window.onload = function() {
    let grup = new Grup(excel);
    grup.mostrarGrups();
}

$('#crearGrups').on('click', function() {

    let grup = new Grup(excel);
    
    if(localStorage.getItem('Grups') != null){
        localStorage.removeItem('Grups');
        grup.crearGrup();  
    }else{
        grup.crearGrup(); 
    }


});