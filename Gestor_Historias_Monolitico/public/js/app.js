
document.addEventListener("DOMContentLoaded", function () {

    // Validar las fechas de los formularios
    const formularios = document.querySelectorAll("form");

    formularios.forEach(function (formulario) {

        const fechaInicio = formulario.querySelector(
            'input[name="fecha_inicio"]'
        );

        const fechaFin = formulario.querySelector(
            'input[name="fecha_fin"]'
        );

        // Evitar que la fecha final sea anterior a la inicial
        if (fechaInicio && fechaFin) {

            fechaInicio.addEventListener("change", function () {
                fechaFin.min = fechaInicio.value;

                if (
                    fechaFin.value &&
                    fechaFin.value < fechaInicio.value
                ) {
                    fechaFin.value = "";
                }
            });

            formulario.addEventListener("submit", function (evento) {

                if (
                    fechaInicio.value &&
                    fechaFin.value &&
                    fechaFin.value < fechaInicio.value
                ) {
                    evento.preventDefault();
                    alert(
                        "La fecha de finalización no puede ser anterior a la fecha de inicio."
                    );
                }
            });
        }
    });

    // Confirmar acciones que tengan el atributo data-confirm
    const acciones = document.querySelectorAll("[data-confirm]");

    acciones.forEach(function (accion) {
        accion.addEventListener("click", function (evento) {

            const mensaje = accion.getAttribute("data-confirm");

            if (!confirm(mensaje)) {
                evento.preventDefault();
            }
        });
    });

});
