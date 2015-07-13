<?php
/**
 * Created by IntelliJ IDEA.
 * User: urandu
 * Date: 7/11/15
 * Time: 1:38 PM
 */
?>

<!-- Mainly scripts -->
<script src="<?php echo(base_url()); ?>assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo(base_url()); ?>assets/js/inspinia.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/pace/pace.min.js"></script>

<!-- Data Tables -->
<script src="<?php echo(base_url()); ?>assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?php echo(base_url()); ?>assets/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable('../example_ajax.php', {
            "callback": function (sValue, y) {
                var aPos = oTable.fnGetPosition(this);
                oTable.fnUpdate(sValue, aPos[0], aPos[1]);
            },
            "submitdata": function (value, settings) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition(this)[2]
                };
            },

            "width": "90%",
            "height": "100%"
        });


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData([
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ]);

    }
</script>
</body>

</html>
