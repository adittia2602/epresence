"use strict";

var now, filterButtons, exportButtons, col_filter;
now = new Date().toISOString().split('T')[0];
col_filter = '<?php echo $col = [0,1];?>';
filterButtons = function () {
    this.api().columns().every( function () {
        var column = this;
        var select = $('<select><option value=""></option></select>')
            .appendTo( $(column.footer().empty()) )
            .on( 'change', function () {
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );

                column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
            } );

        column.data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );
};

exportButtons = [
    'copy','print',
    {
        extend: 'csv',
        filename: now +" Penyaluran UMi",
        title: "Penyaluran UMi"
    }
];


$(document).ready(function() { 
    $("#dataTable").dataTable( {
        "columnDefs": [
            { "type": "num-fmt", "targets": 3 }
        ],
        dom: 'lBfrtip',
        buttons: exportButtons,
        initComplete: filterButtons
    });

    $('table.multipleTable').dataTable({
        dom: 'lBfrtip',
        buttons: exportButtons,
    });
});

