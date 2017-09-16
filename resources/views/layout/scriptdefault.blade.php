<!-- Jquery Core Js -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{URL::asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{URL::asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{URL::asset('plugins/node-waves/waves.js')}}"></script>

<script src="{{URL::asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>


<!-- Jquery DataTable Plugin Js -->
<script src="{{URL::asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>


<!-- Jquery CountTo Plugin Js -->
<script src="{{URL::asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Morris Plugin Js -->
<script src="{{URL::asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{URL::asset('plugins/morrisjs/morris.js')}}"></script>

<!-- ChartJs -->
<script src="{{URL::asset('plugins/chartjs/Chart.bundle.js')}}"></script>


<!-- Autosize Plugin Js -->
<script src="{{URL::asset('plugins/autosize/autosize.js')}}"></script>
<!-- Moment Plugin Js -->
<script src="{{URL::asset('plugins/momentjs/moment.js')}}"></script>

<script src="{{URL::asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

<script src="{{URL::asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<!-- Flot Charts Plugin Js -->


<!-- Sparkline Chart Plugin Js -->
<script src="{{URL::asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

<!-- Custom Js -->
<script src="{{URL::asset('js/admin.js')}}"></script>
<script src="{{URL::asset('js/pages/forms/basic-form-elements.js')}}"></script>
<script src="{{URL::asset('js/pages/index.js')}}"></script>

<!-- Demo Js -->
<script src="{{URL::asset('js/demo.js')}}"></script>
<script src="{{ URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')  }}"></script>
<script src="{{URL::asset('js/script.js')}}"></script>
<script type="text/javascript">
    $(function () {
//        Textare auto growth
        autosize($('textarea.auto-growth'));

//        Datetimepicker plugin
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY - HH:mm',
            clearButton: true,
            weekStart: 1
        });

        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'dddd DD MMMM YYYY',
            clearButton: true,
            weekStart: 1,
            time: false
        });

        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });
        $('.js-basic-example').DataTable({
            responsive: true,
//            "iDisplayLength": 5,
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('.notify-user').dataTable( {
            responsive: true,
            "aoColumnDefs": [
                { 'bSortable': false, 'aTargets': [ 4 ] }
            ]
        });
    });

</script>
