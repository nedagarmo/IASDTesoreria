// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#donors_table_container').jtable({
        title: 'Lista de Donantes',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'nombre ASC',
        actions: {
            listAction: '../core/server.classes/donors.server.class.php?action=search',
            deleteAction: '../core/server.classes/donors.server.class.php?action=delete',
            updateAction: '../core/server.classes/donors.server.class.php?action=update',
            createAction: '../core/server.classes/donors.server.class.php?action=create'
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
                inputTooltip: 'Ingrese el nombre del donante.'
            },
            identificacion: {
                title: 'Identificación',
                inputTooltip: 'Ingrese la identificación del donante.'
            },
            iglesia_nombre: {
                title: 'Iglesia',
                create: false,
                edit: false
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
    $('#search_donors_records').click(function(e) {
        e.preventDefault();
        $('#donors_table_container').jtable('load', {
            name: $('#donor_name').val()
        });
    });

    //Load all records when page is first shown
    $('#search_donors_records').click();
});