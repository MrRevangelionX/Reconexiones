$(document).ready( function () {
    $('#table_reconections').DataTable( {
        responsive: true,
        dom: 'B<"clear">lfrtip',
        buttons: [ 'print', 'csv', 'pdf' ]
    });
});