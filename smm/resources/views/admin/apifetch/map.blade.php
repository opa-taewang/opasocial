@extends('admin.layouts.app')
@section('title', getOption('app_name') . ' - API Service Map')
@section('content')
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 5px;">
            <div class="" style="float:left">
                <h4>API :: {{ $api_id.' - '.$api_name }}</h4>
              	<h4>Profit Margin :: {{ getOption('profit_percentage',true) }}%</h4>
            </div>
            <div class="btn-group" style="float:right">
              	<button type="button" class="btn btn-info btn-sm"  id="apply-all">Select Mapping</button>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-12 mt10">        	
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="frm-apply-all" action="{{ url('/admin/apifetch/savemap') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <div class="table-responsive">
                        <table class="table mydatatable table-bordered table-hover" style="width: 99.9%">
                            <thead>
                            <tr>
                                <th width="3%"><input type="checkbox" class="input-sm checkbox-all"></th>
                                <th width="3%">S.No.</th>
                                <th max-width="45%">Select Service to Map</th>
                                <th max-width="45%">API Service Name</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.mydatatable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                bInfo: false,
                paging: false,
                order: [ [0, 'asc'] ],
                ajax: '{!! url("admin/apifetch/getmap") !!}',
                columns: [
                    {data: 'check', name: 'check', sortable:false, searchable:false},
                    {data: 'sno', name: 'sno', sortable:false, searchable:false},
                    {data: 'service', name: 'service', sortable:false, searchable:false},
                    {data: 'api_service_name', name: 'api_service_name', sortable:false, searchable:false},
                ]
            });
        })
			  $(document).ready(function() {
			    $('[data-toggle="popover"]').popover({
			      html: true, 
			      placement: 'auto top'
			    });
			  });  

            $(document).on('change', '.srvcclass', function () {
                var t = $(this);
                if (t.find(':selected').val() == 0 && !$(t).is('[readonly]')) {
                    t.parents('tr').find('.sel-edit').removeAttr('readonly');
                    t.parents('tr').attr('style', 'background-color:#dedede');
                } else {
                    t.parents('tr').find('.sel-edit').attr('readonly', 'readonly');
                    t.parents('tr').removeAttr('style');
                }

            });

	       $(document).on('click', '.checkbox-all', function () {
                $('.row-checkbox').trigger('click');
            });


            $(document).on('click', '.row-checkbox', function () {
                var t = $(this);
                if (t.is(':checked')) {
                    t.parents('tr').find('.row-edit').removeAttr('readonly');
                    t.parents('tr').find('.srvcclass').removeAttr('disabled');
                    t.parents('tr').attr('style', 'background-color:#dedede');
                } else {
                    t.parents('tr').find('.row-edit').attr('readonly', 'readonly');
                    t.parents('tr').find('.srvcclass').attr('disabled', 'disabled');
                    t.parents('tr').removeAttr('style');
                }
				$(t.parents('tr').find('.srvcclass')).trigger('change');
            });
            
            $(document).on('focusout', '.sel-edit', function () {
                var t = $(this);
                var srvc = t.parents('tr').find('.srvcclass');
				            $(t).css('border-color', '');
    						if($.trim($(t).val()) == "" && !$(t).is('[readonly]')){
			                bootbox.alert("Service name cannot be blank. Please correct.");	
				            $(t).css('border-color', 'red');
    						}else{   
								$(srvc).find('option').each(function(index,element){
									 if(($.trim($(t).val()) == $(element).attr('odata')) && !$(t).is('[readonly]')){
			                bootbox.alert("Service with same name already exists. Please Select existing service to map or change the name.");	
				            $(t).css('border-color', 'red');								 		
										}
								 });  
							  }
            });

            $('#apply-all').on('click', function (e) {
                var form = $('#frm-apply-all');
                var isAnyRowInvalid = false; // check if it shouldn't submit  empty form
                
                $('.sel-edit').each(function () {
	                var t = $(this);
	                var srvc = t.parents('tr').find('.srvcclass');
	                
	    						if($.trim($(t).val()) == "" && !$(t).is('[readonly]')){
	    							
	    							isAnyRowInvalid = true;
				            bootbox.alert("Service name cannot be blank. Please correct.");	
				            $(t).css('border-color', 'red');
	    						}else{  
	    							 
									$(srvc).find('option').each(function(index,element){
										
										if(($.trim($(t).val()) == $(element).attr('odata')) && !$(t).is('[readonly]')){
	    							  isAnyRowInvalid = true;
				            	bootbox.alert("Service with same name already exists. Please Select existing service to map or change the name.");
				            $(t).css('border-color', 'red');									 		
										}
										
									 });
									   
								  }						
								});                

                  $(form).append(
                      $('<input>')
                          .attr('type', 'hidden')
                          .attr('name', 'api_id')
                          .val({{$api_id}})
                  );
                if(!isAnyRowInvalid){
                	
                	var countrows = 0;
                	
                  
                  $('.row-checkbox').each(function () {

                      var t = $(this);

	                      if (t.is(':checked')) {
	                          // API Fetch id
	                          $(form).append(
	                              $('<input>')
	                                  .attr('type', 'hidden')
	                                  .attr('name', t.attr('name'))
	                                  .val(t.val())
	                          );
	                          // service_id
	                          $(form).append(
	                              $('<input>')
	                                  .attr('type', 'hidden')
	                                  .attr('name', 'service[' + t.val() + ']')
	                                  .val($('select[name="service[' + t.val() + ']"]').find(':selected').val())
	                          );
	                          // api_service_name
	                          $(form).append(
	                              $('<input>')
	                                  .attr('type', 'hidden')
	                                  .attr('name', 'api_service_name[' + t.val() + ']')
	                                  .val($('label[name="api_service_name[' + t.val() + ']"]').attr('ldata'))
	                          );
	                          $(form).append(
	                              $('<input>')
	                                  .attr('type', 'hidden')
	                                  .attr('name', 'service_name[' + t.val() + ']')
	                                  .val($('input[name="service_name[' + t.val() + ']"]').val())
	                          );
	                          
														countrows++;
										}				
                  });

                  if (countrows >= 0) {
                  	form.submit();
                  }
								}
            });     
    </script>
@endpush