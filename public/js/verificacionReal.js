/**
 * verificacionReal.js
 * Verifica en tiempo real si un número de identificación ya está registrado.
 *
 * Uso: incluir el <script> con atributos data-*:
 *   data-check-url  → URL del endpoint AJAX (ruta 'visitantes.check-duplicado')
 *   data-field-id   → ID del input a monitorear (por defecto 'numero_identificacion')
 */
document.addEventListener('DOMContentLoaded', function () {
    const script = document.currentScript || document.querySelector('script[data-check-url]');
    const checkUrl = script?.dataset?.checkUrl || '/visitantes/check-duplicado';
    const fieldId = script?.dataset?.fieldId || 'numero_identificacion';

    const campo = document.getElementById(fieldId);
    const alertaAjax = document.getElementById('alerta-ajax');
    const texto = document.getElementById('alerta-ajax-texto');
    const btnVer = document.getElementById('alerta-ajax-ver');
    const btnEditar = document.getElementById('alerta-ajax-editar');

    if (!campo || !alertaAjax) return;

    let timer = null;
    let ultimoValor = '';

    campo.addEventListener('input', function () {
        clearTimeout(timer);

        const valor = campo.value.trim();

        // Ocultar alerta si el campo queda vacío o es muy corto
        if (valor.length < 3) {
            ocultarAlerta();
            return;
        }

        // Evitar peticiones redundantes si el valor no cambió
        if (valor === ultimoValor) return;

        // Esperar 500 ms después de que el usuario deje de escribir
        timer = setTimeout(function () {
            ultimoValor = valor;

            fetch(`${checkUrl}?numero_identificacion=${encodeURIComponent(valor)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
                .then(function (res) {
                    if (!res.ok) throw new Error('Error en la petición');
                    return res.json();
                })
                .then(function (data) {
                    if (data.duplicado) {
                        mostrarAlerta(data);
                    } else {
                        ocultarAlerta();
                    }
                })
                .catch(function () {
                    // En caso de error de red, simplemente ocultamos la alerta
                    ocultarAlerta();
                });
        }, 500);
    });

    /**
     * Muestra la alerta AJAX con los datos del visitante existente.
     * @param {Object} data  Respuesta JSON del servidor.
     */
    function mostrarAlerta(data) {
        texto.textContent = `El número "${data.numero}" ya pertenece a ${data.nombre}.`;
        btnVer.href = `/visitantes/${data.id}`;
        btnEditar.href = `/visitantes/${data.id}/edit`;
        alertaAjax.classList.remove('hidden');
    }

    /**
     * Oculta la alerta AJAX.
     */
    function ocultarAlerta() {
        alertaAjax.classList.add('hidden');
        ultimoValor = '';
    }
});