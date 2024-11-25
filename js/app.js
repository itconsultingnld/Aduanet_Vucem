// function cargarPDF() {
//     // Obtén el archivo seleccionado
//     const inputFile = document.getElementById('fileInput');
//     const archivo = inputFile.files[0]; // El primer archivo seleccionado

//     if (archivo && archivo.type === 'application/pdf') {
//         // Crea un objeto URL para el archivo PDF
//         const fileURL = URL.createObjectURL(archivo);

//         // Inserta el PDF en un iframe dentro del contenedor
//         const pdfViewer = document.getElementById('pdfViewer');
//         pdfViewer.innerHTML = `<embed src="${fileURL}" type="application/pdf" width="50%" height="700px"/>`;
//     } else {
//         alert('Por favor, selecciona un archivo PDF válido.');
//     }
// }

let pdfDoc; // Almacena el documento PDF cargado

async function cargarPDF() {
    const inputFile = document.getElementById('fileInput');
    const archivo = inputFile.files[0];

    if (!archivo && !archivo.type === 'application/pdf') {
        return alert('Por favor, selecciona un archivo PDF válido.');
    }
    const arrayBuffer = await archivo.arrayBuffer();

    // Cargar el PDF en pdf-lib
    pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);

    // Mostrar el PDF en el visor (solo como información)
    const fileURL = URL.createObjectURL(archivo);
    const pdfViewer = document.getElementById('pdfViewer');
    pdfViewer.innerHTML = `<embed src="${fileURL}" type="application/pdf" width="100%" height="500px" />`;
}

async function eliminarPaginas() {
    if (!pdfDoc) {
        alert("Por favor, carga un PDF primero.");
        return;
    }

    // Obtener páginas a eliminar
    const pagesToRemoveInput = document.getElementById('pagesToRemove').value;
    const pagesToRemove = pagesToRemoveInput.split(',').map(num => parseInt(num.trim()) - 1); // Convertir a índices

    // Crear un nuevo PDF sin las páginas eliminadas
    const nuevoPdf = await PDFLib.PDFDocument.create();
    const totalPaginas = pdfDoc.getPageCount();

    for (let i = 0; i < totalPaginas; i++) {
        if (!pagesToRemove.includes(i)) { // Si la página no está en la lista a eliminar
            const [pagina] = await nuevoPdf.copyPages(pdfDoc, [i]);
            nuevoPdf.addPage(pagina);
        }
    }

    // Generar el nuevo PDF y descargarlo
    const pdfBytes = await nuevoPdf.save();
    const blob = new Blob([pdfBytes], { type: 'application/pdf' });
    const url = URL.createObjectURL(blob);

    const downloadLink = document.getElementById('downloadLink');
    downloadLink.href = url;
    downloadLink.download = "PDF_modificado.pdf";
    downloadLink.style.display = "block";
    downloadLink.textContent = "Descargar PDF Modificado";
}
