import * as lib from './lib.js';

let afegirUser = document.getElementById('newF');

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

function init() {

    const file = document.getElementById('excelFile');

    file.addEventListener('change', async function(e) {
        const content = await readXlsxFile( file.files[0]);
        content.shift();

        localStorage.setItem('excel', JSON.stringify(content)); 
        
        mostrarUsers()
        guardarEnBD();
    });
    
    mostrarUsers();

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

//Filtrar alumnes
$('#filtrarLletra').on('click', function() {
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

    data = data.sort((a, b) => {
        return a[0].localeCompare(b[0]);
    });


    if(localStorage.getItem('excel') != null){
        
        localStorage.setItem('excel', JSON.stringify(data));
        location.reload();
    }
    else{
        alert('No hi ha cap alumne a la llista');
    }
   

});

$('#filtrarEdat').on('click', function() {
    
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

    data = data.sort( (a, b) => {
        return compareNumbers(parseInt(a[2]), parseInt(b[2]));
    });

    if(localStorage.getItem('excel') != null){
            
            localStorage.setItem('excel', JSON.stringify(data));
            location.reload();
        }
        else{
            alert('No hi ha cap alumne a la llista');
        }

});

$('#filtrarCurs').on('click', function() {
    
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
  
      data = data.sort( (a, b) => {
          return a[3].localeCompare(b[3]);
      });
  
      if(localStorage.getItem('excel') != null){
              
              localStorage.setItem('excel', JSON.stringify(data));
              location.reload();
          }
          else{
              alert('No hi ha cap alumne a la llista');
          }
  
  });

function compareNumbers(a, b) {
    return a - b;
  }

//Guardar els usuaris a la BD
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


function enviar(data, accio){
    $.ajax({
        url: './usuaris.php', // Fitxer controlador per afegir a la BD
        method: 'POST',
        data: {data: JSON.stringify(data), accio:accio},
        success: function (data) {
            
            
        },
        error: function () {
            alert('There was a problem saving the data');
        }
    });
}

function mostrarUsers() {

    let excel2 = JSON.parse(localStorage.getItem('excel'));
    let table = document.getElementById('Alumnes');  

    if (excel2 == null) {

        excel2.forEach((row, index) => {
        let tr = document.createElement('tr');
        Object.values(row).forEach(cell => {
            let cellElement;
            if (index === 0) {
                // Si es la primera fila, crear un elemento th
                cellElement = document.createElement('th');
            } else {
                // Si no es la primera fila, crear un elemento td
                cellElement = document.createElement('td');
                cellElement.setAttribute('name', cell);
            }
            cellElement.textContent = cell;
            tr.appendChild(cellElement);
        });
        table.appendChild(tr);
        }
        );
    }else{

       let tr = document.createElement('tr');
       tr.appendChild(lib.crearElement('th', {}, 'Nombre'));
       tr.appendChild(lib.crearElement('th', {}, 'Apellidos'));
       tr.appendChild(lib.crearElement('th', {}, 'Edad'));
       tr.appendChild(lib.crearElement('th', {}, 'Curso'));
       
       table.appendChild(tr);
           
        excel2.forEach((row, index) => {
            tr = document.createElement('tr');
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

}

//Filtrar alumnes per nom
$('#nomUsuari').on('keyup', function() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("nomUsuari");
    filter = input.value.toUpperCase();
    table = document.getElementById("Alumnes");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
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


//Afegir un nou alumne

$('#AfegirUsuari').on('click', function() {
    afegirUser.showModal();

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

init();