// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#audit_table_container').jtable({
        title: 'Lista de operaciones sobre el sistema',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'fecha DESC',
        actions: {
            listAction: '../core/server.classes/audits.server.class.php?action=search',
            // deleteAction: '../core/server.classes/donors.server.class.php?action=delete',
            // updateAction: '../core/server.classes/donors.server.class.php?action=update',
            // createAction: '../core/server.classes/donors.server.class.php?action=create'
        },
        fields: {
            id: {
                key: true,
                create: false,
                edit: false,
                list: false
            },
            operacion: {
                title: 'Operación'
            },
            observacion: {
                title: 'Observación'
            },
            tabla: {
                title: 'Tabla'
            },
            usuario: {
                title: 'Usuario'
            },
            fecha: {
                title: 'Fecha'
            },
            ip: {
                title: 'IP'
            },
            iglesia: {
                title: 'Iglesia'
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
    $('#search_audit_records').click(function(e) {
        e.preventDefault();
        $('#audit_table_container').jtable('load', {
            church: $('#church_name').val()
        });
    });

    //Load all records when page is first shown
    $('#search_audit_records').click();
});