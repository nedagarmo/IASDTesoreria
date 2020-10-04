// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#modules_table_container').jtable({
        title: 'Lista de Módulos',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'nombre ASC',
        actions: {
            listAction: '../core/server.classes/modules.server.class.php?action=search',
            deleteAction: '../core/server.classes/modules.server.class.php?action=delete',
            updateAction: '../core/server.classes/modules.server.class.php?action=update',
            createAction: '../core/server.classes/modules.server.class.php?action=create'
        },
        fields: {
            id: {
                key: true,
                create: false,
                edit: false,
                list: false
            },
            nombre: {
                title: 'Nombre',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el nombre del módulo.'
            },
            identificador: {
                title: 'Identificador',
                inputTooltip: 'Ingrese el identificador del módulo.',
                inputClass: 'validate[required]'
            },
            descripcion: {
                title: 'Descripción',
                type: 'textarea',
                inputTooltip: 'Ingrese la descripción del modulo.'
            },
            ruta: {
                title: 'Ruta',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese la ruta del modulo.'
            },
            icono: {
                title: 'Icono',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el nombre del icono.'
            },
            categoria: {
                title: 'Categoría',
                inputClass: 'validate[required]',
                options: function(data) {
                    data.clearCache();
                    return '../core/server.classes/drop.down.lists/ddlcategories.server.class.php';
                },
                inputTooltip: 'Ingrese la categoría del módulo.'
            },
            favorito: {
                title: 'Favorito?',
                type: 'checkbox',
                inputTooltip: 'Por medio de este campo se controla si es o no favorito o visible en el escritorio.',
                list: false,
                values: {'0': 'No', '1': 'Si'},
                defaultValue: '0'
            }
        },
        //Initialize validation logic when a form is created
        formCreated: function(event, data) {
            data.form.validationEngine();
        },
        //Validate form when it is being submitted
        formSubmitting: function(event, data) {
            return data.form.validationEngine('validate');
        },
        //Dispose validation logic when form is closed
        formClosed: function(event, data) {
            data.form.validationEngine('hide');
            data.form.validationEngine('detach');
        }
    });

    //Re-load records when user click 'load records' button.
    $('#search_modules_records').click(function(e) {
        e.preventDefault();
        $('#modules_table_container').jtable('load', {
            name: $('#module_name').val()
        });
    });

    //Load all records when page is first shown
    $('#search_modules_records').click();
});