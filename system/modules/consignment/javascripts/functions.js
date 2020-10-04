// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#consignment_table_container').jtable({
        title: 'Lista de Conceptos de Remesa',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'concepto ASC',
        actions: {
            listAction: '../core/server.classes/consignments.server.class.php?action=search',
            deleteAction: '../core/server.classes/consignments.server.class.php?action=delete',
            updateAction: '../core/server.classes/consignments.server.class.php?action=update',
            createAction: '../core/server.classes/consignments.server.class.php?action=create'
        },
        fields: {
            id: {
                key: true,
                create: false,
                edit: false,
                list: false
            },
            configuracion: {
                title: '',
                width: '1%',
                sorting: false,
                edit: false,
                create: false,
                display: function(table_data) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../images/general/config.png" title="Ver Configuración" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        $('#envelope_table_container').jtable('openChildTable',
                                $img.closest('tr'), //Parent row
                                {
                                    title: 'Configuración | Remesa ' + table_data.record.concepto,
                                    paging: true,
                                    pageSize: 5,
                                    sorting: true,
                                    defaultSorting: 'id DESC',
                                    actions: {
                                        listAction: '../core/server.classes/configuration.consignment.server.class.php?action=search&consignment=' + table_data.record.id,
                                        deleteAction: '../core/server.classes/configuration.consignment.server.class.php?action=delete',
                                        // updateAction: '../core/server.classes/configuration.consignment.server.class.php?action=update',
                                        createAction: '../core/server.classes/configuration.consignment.server.class.php?action=create'
                                    },
                                    fields: {
                                        remesa: {
                                            type: 'hidden',
                                            defaultValue: table_data.record.id
                                        },
                                        id: {
                                            title: 'Id',
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: false
                                        },
                                        entrada: {
                                            title: 'Entrada',
                                            options: function(data) {
                                                data.clearCache();
                                                return '../core/server.classes/drop.down.lists/ddlinflows.server.class.php';
                                            },
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Elija la entrada a la que se descontará el porcentaje en esta configuración.'
                                        },
                                        porcentaje: {
                                            title: 'Porcentaje',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Ingrese el porcentaje a descontar de la entrada.'
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
                                }, function(data) { //opened handler
                            data.childTable.jtable('load');
                        });
                    });
                    return $img;
                }
            },
            concepto: {
                title: 'Concepto',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el concepto.'
            },
            acumulado: {
                title: 'Acumulado ($)',
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
    $('#search_consignment_records').click(function(e) {
        e.preventDefault();
        $('#consignment_table_container').jtable('load', {
            concept: $('#consignment_concept').val()
        });
    });

    //Load all records when page is first shown
    $('#search_consignment_records').click();
});