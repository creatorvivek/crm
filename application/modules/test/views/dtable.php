 <a target="_incognito" href="https://were.hunting.wabbits.com">Qwiet</a>

 <table id="tables" class="display table table-bordered table-striped table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                  
                </tr>
            </thead>
            <tbody>
            </tbody>
 
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>MoBile</th>
                   
                </tr>
            </tfoot>
        </table>

        <script type="text/javascript">
 
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#tables').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url() ?>test/d2",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>