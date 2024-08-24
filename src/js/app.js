// DOMContentLoaded funciona para que el JS se ejecute cuando el HTML este listo
document.addEventListener('DOMContentLoaded', () => {
    // Funciones que se ejecutan cuando el HTML esta listo
    eventListeners();

    // Funcion para habilitar el modo oscuro
    darkMode();
})

// Funciones
function eventListeners() {
    // Seleccionar el div que contiene la clase de mobile-menu para poder ocultarlo o mostrarlo
    const mobileMenu = document.querySelector('.mobile-menu');

    // Agrega el evento click al div mobile-menu para que se muestre o se oculte el menu
    mobileMenu.addEventListener('click', navegacionResponsive);
}

// Funcion para habilitar el modo oscuro
function darkMode() {
    // Seleccionar el boton de modo oscuro
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    // Agrega el evento click al boton de modo oscuro
    botonDarkMode.addEventListener('click', () => {
        // Agrega o elimina la clase dark-mode del body
        document.body.classList.toggle('dark-mode');
    }) 

    // Si el modo oscuro es preferido, agrega la clase dark-mode al body usando un operador ternario
    window.matchMedia('(prefers-color-scheme: dark)').matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');

    const prefiereDark = window.matchMedia('(prefers-color-scheme: dark)');

    // Agrega el evento change al objeto prefiereDark
    prefiereDark.addEventListener('change', (event) => {
        const { matches } = event;
        if (matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    }) 
}

// Funcion para mostrar y ocultar el menu
function navegacionResponsive() {
    // Seleccionar el div que contiene la clase de navegacion para poder mostrarlo o ocultarlo
    const navegacion = document.querySelector('.navegacion');

    // Si la clase mostrar existe, la elimina, si no la agrega con if
    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // }

    // Si la clase mostrar existe, la elimina, si no la agrega con toggle
    navegacion.classList.toggle('mostrar');
}   