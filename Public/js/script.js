document.addEventListener('DOMContentLoaded', function() {
    // Obtén el contenido de tu plantilla
    var source = document.getElementById("footer-template").innerHTML;

    // Compila la plantilla Handlebars
    var template = Handlebars.compile(source);

    // Define los datos para tu plantilla
    var data = {
        // Puedes proporcionar los datos que desees pasar a la plantilla aquí
    };

    // Renderiza la plantilla con los datos proporcionados
    var html = template(data);

    // Inserta el HTML renderizado en el DOM
    document.getElementById("output").innerHTML = html;
});
