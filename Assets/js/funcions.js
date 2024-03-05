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

    enviar(data, 'guardar');
}


function enviar(data, accio){
    $.ajax({
        url: './usuaris.php', // Fitxer controlador per afegir a la BD
        method: 'POST',
        data: {data: JSON.stringify(data), accio:accio},
        success: function (data) {
            alert('Data saved successfully');
            alert(data);
        },
        error: function () {
            alert('There was a problem saving the data');
        }
    });
}

function mostrarUsers() {

    let excel2 = JSON.parse(localStorage.getItem('excel'));
    let table = document.getElementById('Alumnes');  

    document.getElementById('clearStorage').addEventListener('click', function() {
        localStorage.removeItem('excel');
        enviar([], 'eliminar');
        alert('LocalStorage de Excel borrado!');
    });      

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

}


init();