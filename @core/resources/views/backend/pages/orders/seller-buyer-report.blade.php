@extends('backend.admin-master')
@section('site-title')
    {{__('Seller Buyer Reports')}}
@endsection

@section('style')
    <x-datatable.css/>
    <style>
        /* Ensure modal backdrop is clickable and below modal */
        .modal-backdrop {
            z-index: 1040 !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            pointer-events: auto !important;
        }
        /* Modal container */
        #reportModal.modal {
            z-index: 1050 !important;
            position: fixed !important;
        }
        #reportModal.modal.show {
            display: block !important;
        }
        /* Modal dialog - must be above backdrop */
        #reportModal .modal-dialog {
            z-index: 1051 !important;
            position: relative !important;
            margin: 1.75rem auto !important;
            pointer-events: none !important;
        }
        /* Modal content - must be clickable */
        #reportModal .modal-content {
            position: relative !important;
            z-index: 1052 !important;
            pointer-events: auto !important;
        }
        /* Ensure close button is clickable */
        #reportModal .close {
            position: relative !important;
            z-index: 1053 !important;
            opacity: 1 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        #reportModal .close:hover {
            opacity: 0.75 !important;
        }
        /* Ensure modal footer button is clickable */
        #reportModal .modal-footer button {
            position: relative !important;
            z-index: 1053 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        /* Ensure all interactive elements are clickable */
        #reportModal .modal-header,
        #reportModal .modal-body,
        #reportModal .modal-footer {
            pointer-events: auto !important;
        }
        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Seller Buyer Reports')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('Order ID')}}</th>
                                <th>{{__('Report Details')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Buyer Details')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($reports as $data)
                                    <tr>
                                        <td>{{$data->order_id}}</td>
                                        <td>
                                            <p><strong>{{ __('Report From:') }}</strong> {{ __(ucfirst(strtolower($data->report_from))) }}</p>
                                            <p><strong>{{ __('Report To:') }}</strong> {{ __(ucfirst(strtolower($data->report_to))) }}</p>
                                            <p><strong>{{ __('Report Date:') }}</strong> {{date('d-m-Y', strtotime($data->created_at))}}</p>
                                            <p><strong>{{ __('Description:') }}</strong> <span class="btn btn-info btn-sm report_description" data-report="{{ $data->report }}" style="cursor: pointer;"><i class="ti-eye"></i></span></p>
                                        </td>
                                        <td>
                                            <p><strong>{{ __('Name:') }}</strong> {{ optional($data->seller)->name }}</p>
                                            <p><strong>{{ __('Email:') }}</strong> {{ optional($data->seller)->email }}</p>
                                            <p><strong>{{ __('Phone:') }}</strong> {{ optional($data->seller)->phone }}</p>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.order.report.chat.seller',$data->id.'/'.$data->seller_id) }}">{{__('Chat To Seller')}}</a>
                                        </td>
                                        <td>
                                            <p><strong>{{ __('Name:') }}</strong> {{ optional($data->buyer)->name }}</p>
                                            <p><strong>{{ __('Email:') }}</strong> {{ optional($data->buyer)->email }}</p>
                                            <p><strong>{{ __('Phone:') }}</strong> {{ optional($data->buyer)->phone }}</p>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.order.report.chat.buyer',$data->id.'/'.$data->buyer_id) }}">{{__('Chat To Buyer')}}</a>
                                        </td>
                                        <td>
                                            @can('report-delete')
                                                <x-delete-popover :url="route('admin.order.report.delete',$data->id)"/>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    Report modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true" data-backdrop="true" data-keyboard="true">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">{{ __('Report Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor: pointer; z-index: 1051;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>{{ __('Description:') }}</strong></label>
                        <div class="p-3 bg-light rounded" style="min-height: 100px; white-space: pre-wrap; word-wrap: break-word;" id="report_description"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to change status complete? Once you done you can not revert this !!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ __('Yes, change it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click','.report_description',function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    let report_description = $(this).data('report');
                    if (report_description) {
                        $('#report_description').text(report_description);
                    } else {
                        $('#report_description').text('{{__("No description available")}}');
                    }
                    // Show modal manually with proper options
                    $('#reportModal').modal({
                        backdrop: true,
                        keyboard: true,
                        show: true
                    });
                });

                // Handle backdrop click - close modal when clicking on backdrop
                $(document).on('click', '.modal-backdrop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('#reportModal').modal('hide');
                });

                // Handle modal container click (when clicking outside modal-content)
                $(document).on('click', '#reportModal', function(e) {
                    // Only close if clicking directly on the modal container (not on modal-content or its children)
                    if ($(e.target).is('#reportModal')) {
                        e.preventDefault();
                        e.stopPropagation();
                        $('#reportModal').modal('hide');
                    }
                });

                // Prevent modal content clicks from closing the modal
                $(document).on('click', '#reportModal .modal-content, #reportModal .modal-content *', function(e) {
                    e.stopPropagation();
                });

                // Ensure close buttons work - use direct event handler with high priority
                $(document).on('click', '#reportModal .close', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                $(document).on('click', '#reportModal [data-dismiss="modal"]', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                $(document).on('click', '#reportModal .btn-secondary', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    $('#reportModal').modal('hide');
                    return false;
                });

                // Close modal on ESC key
                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape' || e.keyCode === 27) {
                        if ($('#reportModal').hasClass('show')) {
                            $('#reportModal').modal('hide');
                        }
                    }
                });

                // Clean up when modal is hidden
                $('#reportModal').on('hidden.bs.modal', function () {
                    // Remove any duplicate backdrops
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                });

                // Also handle when modal is shown to ensure proper z-index
                $('#reportModal').on('shown.bs.modal', function () {
                    // Ensure modal dialog is above backdrop
                    $(this).css('z-index', '1050');
                    $('.modal-backdrop').css('z-index', '1040');
                    $(this).find('.modal-dialog').css('z-index', '1051');
                });

                // Initialize DataTable with Arabic language
                $('.table-wrap > table').DataTable({
                    "order": [[ 0, "desc" ]],
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
                });
            });

        })(jQuery);
    </script>
@endsection
