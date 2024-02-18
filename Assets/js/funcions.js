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



function init() {

    const file = document.getElementById('excelFile');
    
    file.addEventListener('change', async function(e) {
        const content = await readXlsxFile( file.files[0]);

        const excel = new Excel(content);

        $('#Alumnes').html('');
        $('#Alumnes').append(`<tr>${excel.headers().map((header) => `<th>${header}</th>`).join('')}</tr>`);
        excel.rows().forEach((row) => {
            $('#Alumnes').append(`<tr>${row.map((cell) => `<td>${cell}</td>`).join('')}</tr>`);
        });

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