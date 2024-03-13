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

            let numGrups = document.getElementById('numDeUsersXGrup').value; // Number of groups you want
            this.excel = this.excel.filter((index) => index[0] != "Nombre");  
            this.llista= lib.shuffleArray(this.excel);
            localStorage.setItem('Grups', JSON.stringify(this.llista));
            this.mostrarGrups(numGrups);
        }


        mostrarGrups(numGrups){
            let llista = [];   
            let contador = 0         
            if(localStorage.getItem('Grups') != null){
                llista = JSON.parse(localStorage.getItem('Grups'));
            }else{
                return;
            }
            if(numGrups == undefined){
                numGrups = 3;
            }

            let nGrup =Math.floor(llista.length / numGrups); // Size of each group, subtract 1 from excel.length to account for the skipped row

            if (numGrups > llista.length || numGrups <= 0) {
                alert('El num de grups no pot ser inferior a 1 ni superior al nombre d\'usuaris.');
                return;
            }

            let resto = llista.length % numGrups;


            let tableContainer = document.getElementById('llistatGrups');
            tableContainer.innerHTML = "";
            for (let i = 0; i < numGrups; i++) { // Create Grups
                let table = lib.crearElement('div',{class:'Grupos col-3',id:'grup'+i},"");
                let tr = lib.crearElement('div',{class:'fila col-3 nGrup',},'Grup' + (i + 1));
                table.addEventListener('drop', drop);
                table.addEventListener('dragover', allowDrop);
                table.appendChild(tr);
                tableContainer.appendChild(table);

                let alXGrup;

                if(resto > 0){
                    alXGrup = nGrup + 1;
                    resto--;
                } else {
                    alXGrup = nGrup;
                }

                for (let j = 0; j < alXGrup; j++) { //Afegir usuaris
                    let tr = lib.crearElement('div',{class:'fila col-3',draggable:'true',id:'usuari'+contador++},'');
                    tr.textContent = llista[0][0]; // Assuming you want to display the first value of each element
                    tr.addEventListener('dragstart', drag);
                    table.appendChild(tr);
                    llista = llista.slice(1);
                }
            }
        }


    }

let excel = JSON.parse(localStorage.getItem('excel'));

window.onload = function() {
    let grup = new Grup(excel);
    grup.mostrarGrups();

}

    
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.currentTarget.appendChild(document.getElementById(data));
}

function allowDrop(ev) {
    ev.preventDefault();
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