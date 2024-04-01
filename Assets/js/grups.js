import * as lib from './lib.js';
class Grup {
    excel = [];

    constructor(excel) {
        
        this.excel = excel;
    }

        crearGrup(){

            let numGrups = document.getElementById('numDeUsersXGrup').value; // Number of groups you want
            this.excel = this.excel.filter((index) => index[0] != "Nombre" + index[1] != "Apellidos");  
            this.llista= lib.shuffleArray(this.excel);
            this.guardarGrups(numGrups);
        }

        guardarGrups(numGrups){

            enviar([], 'eliminarGrups'); // Eliminar grups de la BD
            let nGrup =Math.floor(this.llista.length / numGrups); // Size of each group, subtract 1 from excel.length to account for the skipped row
            let resto = this.llista.length % numGrups;
            
            for (let i = 0; i < numGrups; i++) { // Create Grups
                let alXGrup;
            
                if(resto > 0){
                    alXGrup = nGrup + 1;
                    resto--;
                } else {
                    alXGrup = nGrup;
                }

                enviar(["Grup"+(i+1), "Grup"+(i+1)+"@gmail.com","Grup"+(i+1)] , 'crearGrup'); // Afegir grup a la BD
        
                for (let j = 0; j < alXGrup; j++) { //Afegir usuaris
                    enviar(["Grup"+(i+1),this.llista[0].id], 'afegirUsuari'); // Afegir usuari a la BD
                    this.llista = this.llista.slice(1);
                }
            }

          
           
        }

        async mostrarGrups(){
            let tableContainer = document.getElementById('llistatGrups');
             
            tableContainer.innerHTML = "";
          
            let llista = JSON.parse(await enviar([],'getUsuaris'))
            let numGrups = JSON.parse(await enviar([],'getNumGrups'));
            numGrups = numGrups[0].CountGrups;
        

            for (let i = 0; i < numGrups; i++) {

                let table = lib.crearElement('div',{class:'Grupos col-3',id:'Grup'+(i+1)},"");
                let tr = lib.crearElement('div',{class:'fila  nGrup',},'Grup' + (i + 1));
                table.addEventListener('drop', drop);
                table.addEventListener('dragover', allowDrop);
                table.appendChild(tr);
                tableContainer.appendChild(table);
                let grup = "Grup"+(i+1)

                for (let j = 0; j < llista.length; j++) { //Afegir usuaris

                   
                    if (llista[j].grup == grup) {
                        let tr = lib.crearElement('div',{class:'fila col',draggable:'true',id:llista[j].id},'');

                        tr.textContent = llista[j].nom + " "+llista[j].cognom;
                        tr.addEventListener('dragstart', drag);
                        table.appendChild(tr);
                        
                    }

                }

                
            }
        }

    }

    

async function enviar(D, accio){
    return $.ajax({
        url: './grups.php', // Fitxer controlador per afegir a la BD
        method: 'POST',
        data: {data: JSON.stringify(D), accio:accio},
        // success: function (response) {
        //     return alert(response);
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
    enviar({'idUser':data,'idGrup':ev.currentTarget.id},'canviarGrup');
}

function allowDrop(ev) {
    ev.preventDefault();
  }



$( window ).on( "load", async function() {
    let llistaUsers = JSON.parse(await enviar([], 'getUsuaris'));
    $('#numDeUsersXGrup').attr('max', llistaUsers.length);

    if (llistaUsers.length == 0) {
        alert('No hi ha usuaris a la base de dades');
        return;
    }

    let  grup = new Grup(llistaUsers);


   
    
    $('#crearGrups').on('click', async function() {
 
        grup.crearGrup();
      
    });

    grup.mostrarGrups();
    
  } );
