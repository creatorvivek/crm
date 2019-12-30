$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
        // order: [[4, 'desc']],
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});