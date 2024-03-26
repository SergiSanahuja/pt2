import * as lib from './lib.js';


let afegirUser = document.getElementById('newF');
let llistaUsers = [];
let idAlumne

class Excel {
    constructor(content) {
        this.content = content; 
    }

    headers() {
        return this.content[0];
    }

    rows(){
        return this.content.slice(1, this.content.length);
    }

}

;

async function init() {

    const file = document.getElementById('excelFile');

    file.addEventListener('change', async function(e) {
        let content = await readXlsxFile( file.files[0]);
        content.shift();


        //localStorage.setItem('excel', JSON.stringify(content)); 
        
        mostrarUsers(content);
        guardarEnBD(content);
        location.reload();
    });

    
    llistaUsers = JSON.parse(await enviar([], 'mostrar'));

    
    mostrarUsers(llistaUsers);

    $('#afegirForm').click(() => {
        // $('#form')[0].reset();
        $('#divForm').show();
    });
    
    $('#cancelar').click(() => {
        $('#divForm').hide();
    });

    
}

//Esborrar les dades del localStorage d'alumnes
$('#clearStorage').on('click', function() {
      
    if(confirm('Estas segur que vols esborrar les dades?')){
        enviar([], 'eliminar');
        alert('Dades esborrades');
        localStorage.clear();
        location.reload();

    }else{

        alert('Operació cancelada');

    }
});

//-------------------------------------------Filtrar alumnes-------------------------
$('#filtrarLletra').on('click', async function() {
   
   enviar([], 'mostrarPerLletra');

   llistaUsers = JSON.parse(await enviar([], 'mostrarPerLletra'));
   
   mostrarUsers(llistaUsers);



});

$('#filtrarEdat').on('click', async function() {
    enviar([], 'mostrarPerEdat');

    llistaUsers = JSON.parse(await enviar([], 'mostrarPerEdat'));
    
    mostrarUsers(llistaUsers);

});

$('#filtrarCurs').on('click', async function() {
    
    enviar([], 'mostrarPerCurs');

    llistaUsers = JSON.parse(await enviar([], 'mostrarPerCurs'));
    
    mostrarUsers(llistaUsers);
  
  });

  //---------------------------Filtrar alumnes per nom-------------------
$('#nomUsuari').on('keyup', function() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("nomUsuari");
    filter = input.value.toUpperCase();
    table = document.getElementById("Alumnes");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if(td){
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }
});


//------------------------------Guardar els usuaris a la BD---------------------------
function guardarEnBD() {
    let table = $('#Alumnes');
    let data = [];

    table.find('tr').each(function (i, el) {
        if (i !== 0) {
            let $tds = $(this).find('td');
            let rowData = $tds.map(function (i, el) {
                return $(this).text();
            }).get();
            if (rowData.length > 0) {
                data.push(rowData);
            }
        }
    });
    alert('Dades guardades');
    enviar(data, 'guardar');
}

//------------------------Petició AJAX per enviar les dades a la BD-------------------
async function enviar(data, accio){
    return $.ajax({
        url: './usuaris.php', // Fitxer controlador per afegir a la BD
        method: 'POST',
        data: {data: JSON.stringify(data), accio:accio},
        // success: function (response) {
        //     alert(response);
        //     return response;
        // },
        error: function () {
            alert('There was a problem saving the data');
        }
    });
}
//------------------------Mostrar alumnes a la taula-------------------
function mostrarUsers(t) {

    let excel2 = t;
    let table = document.getElementById('Alumnes');  
    table.innerHTML = '';

    

       let tr = document.createElement('tr');
       tr.appendChild(lib.crearElement('th', {}, 'id'));
       tr.appendChild(lib.crearElement('th', {}, 'Nombre'));
       tr.appendChild(lib.crearElement('th', {}, 'Apellidos'));
       tr.appendChild(lib.crearElement('th', {}, 'Edad'));
       tr.appendChild(lib.crearElement('th', {}, 'Curso'));
       
       table.appendChild(tr);
           
        excel2.forEach((row, index) => {
            tr = lib.crearElement('tr', {id: index,class:'tr'}, '');

            Object.values(row).forEach(cell => {
                let cellElement;
               
                    // Si no es la primera fila, crear un elemento td
              
                cellElement = document.createElement('td');


                cellElement.setAttribute('name', cell);
                
                cellElement.textContent = cell;
                tr.appendChild(cellElement);
            });

            table.appendChild(tr);
            }
            );    

}

$('#Alumnes').on('click', '.tr', function() {
    let data = [];
    $(this).find('td').each(function() {
        data.push($(this).text());
    });
    idAlumne = data[0];
    $('#newNom').val(data[1]);
    $('#newCognom').val(data[2]);
    $('#Edat').val(data[3]);
    $('#Curs').val(data[4]);
    afegirUser.showModal();
});





//Afegir un nou alumne

$('#AfegirUsuari').on('click', function() {
    afegirUser.showModal();

    idAlumne = null;
    $('#newNom').val('');
    $('#newCognom').val('');
    $('#Edat').val('');
});

afegirUser.addEventListener("click", ev => {
    const x = ev.clientX;
    const y = ev.clientY;
    const rect = afegirUser.getBoundingClientRect();    // Rectangle que ocupa el diàleg

    if (x < rect.left || x >= rect.right || y < rect.top || y >= rect.bottom) cerrarDialog();
});
function cerrarDialog() {
    afegirUser.close();
    $('#cont').css('filter', 'none');
}


$('#Guardar').on('click', function() {
    let nom = $('#newNom').val();
    let cognom = $('#newCognom').val();
    let edat = $('#Edat').val();
    let curs = $('#Curs').val();
 

    let data = [nom, cognom, parseInt(edat), curs, parseInt(idAlumne)];

  

    if (nom === '' || cognom === '' || edat === '' || curs === '') {
        alert('Has d\'omplir tots els camps');
        return;
    }

    enviar([data], 'guardar');

    let table = $('#Alumnes');
    let tr = document.createElement('tr');
    tr.appendChild(lib.crearElement('td', {}, nom));
    tr.appendChild(lib.crearElement('td', {}, cognom));
    tr.appendChild(lib.crearElement('td', {}, edat));
    tr.appendChild(lib.crearElement('td', {}, curs));
    table.append(tr);
    $('#divForm').hide();
    afegirUser.close();
    $('#cont').css('filter', 'none');
    
    location.reload();
   
});

$('#borrar').on('click', function() {
    
    if(confirm('Estas segur que vols esborrar aquest alumne?')){
        let data = [idAlumne];
     
        enviar([data], 'borrar');
        alert('Alumne esborrat');
        location.reload();
    }else{
        alert('Operació cancelada');
    }

});

init();