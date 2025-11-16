<!-- Start datatable js -->
<script src="{{asset('assets/backend/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/backend/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/backend/js/responsive.bootstrap.min.js')}}"></script>
@if(!isset($only_js))
    <script>
        (function($){
            "use strict";
            $('.table-wrap > table').DataTable( {
                "order": [[ 2, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }],
                "language": {
                    "sProcessing": "{{__('Processing...')}}",
                    "sLengthMenu": "{{__('Show')}} _MENU_ {{__('entries')}}",
                    "sZeroRecords": "{{__('No matching records found')}}",
                    "sEmptyTable": "{{__('No data available in table')}}",
                    "sInfo": "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
                    "sInfoEmpty": "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
                    "sInfoFiltered": "({{__('filtered from')}} _MAX_ {{__('total entries')}})",
                    "sInfoPostFix": "",
                    "sSearch": "{{__('Search:')}}",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "{{__('Loading...')}}",
                    "oPaginate": {
                        "sFirst": "{{__('First')}}",
                        "sLast": "{{__('Last')}}",
                        "sNext": "{{__('Next')}}",
                        "sPrevious": "{{__('Previous')}}"
                    },
                    "oAria": {
                        "sSortAscending": ": {{__('activate to sort column ascending')}}",
                        "sSortDescending": ": {{__('activate to sort column descending')}}"
                    }
                }
            } );

        })(jQuery);
    </script>
@endif