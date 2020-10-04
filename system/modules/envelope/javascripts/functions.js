// Funciones JS del módulo

// Ejecución posterior al "Load" de la página.
$(document).ready(function() {

    $('#envelope_table_container').jtable({
        title: 'Lista de Sobres',
        paging: true,
        pageSize: 10,
        sorting: true,
        defaultSorting: 'fecha DESC',
        actions: {
            listAction: '../core/server.classes/envelope.server.class.php?action=search',
            deleteAction: '../core/server.classes/envelope.server.class.php?action=delete',
            updateAction: '../core/server.classes/envelope.server.class.php?action=update',
            createAction: '../core/server.classes/envelope.server.class.php?action=create'
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
                width: '2%',
                sorting: false,
                edit: false,
                create: false,
                display: function(table_data) {
                    //Create an image that will be used to open child table
                    var $img = $('<img src="../images/general/list.png" title="Ver Entradas" />');
                    //Open child table when user clicks the image
                    $img.click(function() {
                        $('#envelope_table_container').jtable('openChildTable',
                                $img.closest('tr'), //Parent row
                                {
                                    title: 'Entradas del sobre no. ' + table_data.record.numero + ' | Día ' + table_data.record.fecha,
                                    sorting: true,
                                    defaultSorting: 'entrada ASC',
                                    actions: {
                                        listAction: '../core/server.classes/envelope.inflows.server.class.php?action=search&envelope=' + table_data.record.id,
                                        deleteAction: '../core/server.classes/envelope.inflows.server.class.php?action=delete',
                                        // updateAction: '../core/server.classes/envelope.inflows.server.class.php?action=update',
                                        createAction: '../core/server.classes/envelope.inflows.server.class.php?action=create'
                                    },
                                    fields: {
                                        sobre: {
                                            type: 'hidden',
                                            defaultValue: table_data.record.id
                                        },
                                        id: {
                                            title: 'Id',
                                            key: true,
                                            create: false,
                                            edit: false,
                                            list: true
                                        },
                                        entrada: {
                                            title: 'Entrada',
                                            options: '../core/server.classes/drop.down.lists/ddlinflows.server.class.php',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Tipo de entrada del sobre.'
                                        },
                                        valor: {
                                            title: 'Valor',
                                            inputClass: 'validate[required]',
                                            inputTooltip: 'Ingrese el valor o monto de la entrada sin puntos, ni comas, ni carácteres especiales.'
                                        }
                                    }
                                }, function(data) { //opened handler
                            data.childTable.jtable('load');
                        });
                    });
                    return $img;
                }
            },
            numero: {
                title: 'Número',
                inputClass: 'validate[required]',
                inputTooltip: 'Ingrese el número del sobre'
            },
            fecha: {
                title: 'Fecha',
                type: 'date',
                inputTooltip: 'Ingrese la fecha'
            },
            donante_nombre: {
                title: 'Donante',
                inputTooltip: 'Ingrese el nombre del donante'
            }
        },
        //Initialize validation logic when a form is created
        formCreated: function(event, data) {
            data.form.validationEngine();
            data.form.find('[name=donante_nombre]').autocomplete({
                source: "../core/server.classes/autocompletes/donors.ac.server.class.php"
            });
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
    $('#search_envelope_records').click(function(e) {
        e.preventDefault();
        $('#envelope_table_container').jtable('load', {
            name: $('#envelope_donor_name').val(),
            date_start: $('#envelope_date_start').val(),
            date_end: $('#envelope_date_end').val()
        });
    });

    //Load all records when page is first shown
    $('#search_envelope_records').click();
});