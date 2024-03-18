import * as lib from './lib.js';
class Grup {
    excel = [];

    constructor(excel) {
        
        this.excel = excel;
    }

    
    
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
                    tr.textContent = llista[0].nom; // Assuming you want to display the first value of each element
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

async function enviar(data, accio){
    return $.ajax({
        url: './grups.php', // Fitxer controlador per afegir a la BD
        method: 'POST',
        data: {data: JSON.stringify(data), accio:accio},
        // success: function (response) {
        //     return response;
        // },
        error: function () {
            alert('There was a problem saving the data');
        }
    });
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

$('#crearGrups').on('click', async function() {

    let llistaUsers = JSON.parse(await enviar([], 'getUsuaris'));
   
    let grup = new Grup(llistaUsers);

    grup.crearGrup();


});