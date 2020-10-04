// Funciones JS del módulo
var img_dealing_id = 0;

function dealing_type_change(value) {
    if (value != 3) {
        $("[name='rubro_aux'] option[value='']").attr("selected", true);
        $("[name='rubro_aux']").prop('disabled', 'disabled');
    } else {
        $("[name='rubro_aux']").removeAttr("disabled");
    }
}

function dealing_persistence()
{
    $('#entries_table_container').jtable('load', {
        name: $('#entries_name').val()
    });
}

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#entries_table_container').jtable({
        title: 'Lista de Rubros',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'nombre ASC',
        actions: {
            listAction: '../core/server.classes/entries.server.class.php?action=search',
            deleteAction: '../core/server.classes/entries.server.class.php?action=delete',
            updateAction: '../core/server.classes/entries.server.class.php?action=update',
            createAction: '../core/server.classes/entries.server.class.php?action=create'
        },
        fields: {
            id: {
                key: true,
                create: false,
                edit: false,
                list: false
            },
            entradas: {
                title: '',
                width: '1%',
                sorting: false,
                edit: false,
                create: false,
                display: function(table_data) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../images/general/list.png" title="Ver Movimientos" id="dealings-entry-'+table_data.record.id+'" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        img_dealing_id = $img.attr('id');
                        $('#envelope_table_container').jtable('openChildTable',
                                $img.closest('tr'), //Parent row
                                {
                                    title: 'Lista de Movimientos | Rubro ' + table_data.record.nombre,
                                    paging: true,
                                    pageSize: 5,
                                    sorting: true,
                                    defaultSorting: 'id DESC',
                                    actions: {
                                        listAction: '../core/server.classes/dealings.entries.server.class.php?action=search&entry=' + table_data.record.id,
                                        // deleteAction: '../core/server.classes/dealings.entries.server.class.php?action=delete',
                                        // updateAction: '../core/server.classes/dealings.entries.server.class.php?action=update',
                                        createAction: '../core/server.classes/dealings.entries.server.class.php?action=create'
                                    },
                                    fields: {
                                        rubro: {
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
                                        tipo: {
                                            title: 'Tipo de Movimiento',
                                            options: '../core/server.classes/drop.down.lists/ddldealings.type.server.class.php',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Tipo de movimiento ha registrar.',
                                            onchange: 'dealing_type_change(this.value)'
                                        },
                                        concepto: {
                                            title: 'Concepto',
                                            type: 'textarea',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Ingrese el concepto por el cual se efectua el movimiento.'
                                        },
                                        valor: {
                                            title: 'Valor',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Ingrese el valor o monto de la entrada sin puntos, ni comas, ni carácteres especiales.'
                                        },
                                        fecha: {
                                            title: 'Fecha',
                                            create: false,
                                            edit: false
                                        },
                                        rubro_aux: {
                                            title: 'Rubro Destino',
                                            options: function(data) {
                                                data.clearCache();
                                                return '../core/server.classes/drop.down.lists/ddlentries.server.class.php?exclude=' + table_data.record.id;
                                            },
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'En caso de que el tipo de movimiento sea traspaso, escoja el rubro al que se realizará el traspaso.'
                                        }
                                    },
                                    //Initialize validation logic when a form is created
                                    formCreated: function(event, data) {
                                        data.form.validationEngine();
                                        $("[name='rubro_aux'] option[value='']").attr("selected", true);
                                        $("[name='rubro_aux']").prop('disabled', 'disabled');
                                    },
                                    //Validate form when it is being submitted
                                    formSubmitting: function(event, data) {
                                        return data.form.validationEngine('validate');
                                    },
                                    //Dispose validation logic when form is closed
                                    formClosed: function(event, data) {
                                        data.form.validationEngine('hide');
                                        data.form.validationEngine('detach');
                                        dealing_persistence();
                                    }
                                }, function(data) { //opened handler
                            data.childTable.jtable('load');
                        });
                    });
                    return $img;
                }
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
                                    title: 'Configuración | Rubro ' + table_data.record.nombre,
                                    paging: true,
                                    pageSize: 5,
                                    sorting: true,
                                    defaultSorting: 'id DESC',
                                    actions: {
                                        listAction: '../core/server.classes/configuration.entries.server.class.php?action=search&entry=' + table_data.record.id,
                                        deleteAction: '../core/server.classes/configuration.entries.server.class.php?action=delete',
                                        // updateAction: '../core/server.classes/configuration.entries.server.class.php?action=update',
                                        createAction: '../core/server.classes/configuration.entries.server.class.php?action=create'
                                    },
                                    fields: {
                                        rubro: {
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
            nombre: {
                title: 'Nombre',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el nombre del donante.'
            },
            descripcion: {
                title: 'Descripción',
                type: 'textarea',
                inputTooltip: 'Ingrese la descripción del rubro.'
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
        },
        recordsLoaded: function (event, data) { 
            if(img_dealing_id != 0){
                $('#'+img_dealing_id).click();
            }
        }
    });

    //Re-load records when user click 'load records' button.
    $('#search_entries_records').click(function(e) {
        e.preventDefault();
        $('#entries_table_container').jtable('load', {
            name: $('#entries_name').val()
        });
    });

    //Load all records when page is first shown
    $('#search_entries_records').click();
});