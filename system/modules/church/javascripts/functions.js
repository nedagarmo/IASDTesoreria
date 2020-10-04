// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#church_table_container').jtable({
        title: 'Lista de Iglesias',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'nombre ASC',
        actions: {
            listAction: '../core/server.classes/church.server.class.php?action=search',
            deleteAction: '../core/server.classes/church.server.class.php?action=delete',
            updateAction: '../core/server.classes/church.server.class.php?action=update',
            createAction: '../core/server.classes/church.server.class.php?action=create'
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
                inputTooltip: 'Ingrese el nombre de la iglesia.'
            },
            direccion: {
                title: 'Dirección',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese la dirección de la iglesia.'
            },
            telefono: {
                title: 'Teléfono',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el teléfono de contacto de la iglesia.'
            },
            pais: {
                title: 'Pais',
                list: false,
                options: '../core/server.classes/drop.down.lists/ddlcountries.server.class.php',
                inputClass: 'validate[required]',
                inputTooltip: 'Escoja el país de la iglesia.'
            },
            departamento: {
                title: 'Departamento',
                list: false,
                dependsOn: 'pais',
                options: function(data) {
                    data.clearCache();
                    return '../core/server.classes/drop.down.lists/ddldepartments.server.class.php?country='+data.dependedValues.pais;
                },
                inputClass: 'validate[required]',
                inputTooltip: 'Escoja el departamento de la iglesia.'
            },
            municipio: {
                title: 'Municipio',
                list: false,
                dependsOn: 'departamento',
                options: function(data) {
                    data.clearCache();
                    return '../core/server.classes/drop.down.lists/ddltowns.server.class.php?department='+data.dependedValues.departamento;
                },
                inputClass: 'validate[required]',
                inputTooltip: 'Escoja el municipio de la iglesia.'
            },
            ubicacion: {
                title: 'Ubicación',
                create: false,
                edit: false
            },
            asociacion: {
                title: 'Asociación',
                dependsOn: 'municipio',
                options: function(data) {
                    data.clearCache();
                    return '../core/server.classes/drop.down.lists/ddlassociation.server.class.php?town='+data.dependedValues.municipio;
                },
                inputClass: 'validate[required]',
                inputTooltip: 'Asigne la iglesia a una asociación.'
            },
            distrito: {
                title: 'Distrito',
                dependsOn: 'asociacion',
                options: function(data) {
                    data.clearCache();
                    return '../core/server.classes/drop.down.lists/ddldistricts.server.class.php?association='+data.dependedValues.asociacion;
                },
                inputClass: 'validate[required]',
                inputTooltip: 'Asigne la iglesia a un distrito.'
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
    $('#search_church_records').click(function(e) {
        e.preventDefault();
        $('#church_table_container').jtable('load', {
            name: $('#church_name').val()
        });
    });

    //Load all records when page is first shown
    $('#search_church_records').click();
});