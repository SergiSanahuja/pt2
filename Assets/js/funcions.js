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

        //provar de utilitzar la classe Excel
        const excel = new Excel(content);

        localStorage.setItem('excel', JSON.stringify(content));

        let excel2 = JSON.parse(localStorage.getItem('excel'));
        let table = document.getElementById('Alumnes');    

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
                }
                cellElement.textContent = cell;
                tr.appendChild(cellElement);
            });
            table.appendChild(tr);
        }
        );
    });
    
    let excel2 = JSON.parse(localStorage.getItem('excel'));
    let table = document.getElementById('Alumnes');  

    document.getElementById('clearStorage').addEventListener('click', function() {
        localStorage.removeItem('excel');
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
            }
            cellElement.textContent = cell;
            tr.appendChild(cellElement);
        });
        table.appendChild(tr);
    }
    );

    $('#afegirForm').click(() => {
        // $('#form')[0].reset();
        $('#divForm').show();
    });
    
    $('#cancelar').click(() => {
        $('#divForm').hide();
    });
}





init();