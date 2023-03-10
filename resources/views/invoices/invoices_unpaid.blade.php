@extends('layouts.master')
@section('title')
قائمه الفواتير
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  قائمه الفواتير المدفوعه</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

	@if (session()->has('delete_invoice'))

		<script>
			window.onload = function(){
			notif({
				msg="تم الحذف بنجاح"
				type="success"
			})
			}
		</script>
									
	@endif
				<!-- row -->
				<div class="row">
					<!--div-->
				
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								
									<a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
											class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتوره</th>
												<th class="border-bottom-0">تريخ الفاتوره</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبه الضريبه</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0">الحاله</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0"></th>
												
											</tr>
										</thead>
										<tbody>
											<?php $i=0 ?>
											@foreach ($invoices as $invoice)
												<?php $i++?>
											
											<tr>
												<td>{{$i}}</td>
												<td>{{$invoice->invoices_number}}</td>
												<td>{{$invoice->invoice_date}}</td>
												<td>{{$invoice->due_date}}</td>
												<td>{{$invoice->product}}</td>
												<td>{{$invoice->section->section_name}}</td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->rate_vat}}</td>
												<td>{{$invoice->total}}</td>

												<td>
													@if($invoice->value_status== 1)
													<span class="text-success">{{$invoice->status}}</span>
													
													@elseif($invoice->value_status== 2)
													<span class="text-danger">{{$invoice->status}}</span>
													
													@else
													<span class="text-warning">{{$invoice->status}}</span>
												</td>
													@endif

												<td>{{$invoice->note}}</td>
												
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

<script>
	$('#delete_invoice').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var invoice_id = button.data('invoice_id')
		var modal = $(this)
		modal.find('.modal-body #invoice_id').val(invoice_id);
		
	})
</script>


@endsection