@extends('template')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">
		<div class="position-relative mb-3">
			<div class="row g-3 justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0 font-dangrek-bold title-fonts"  >ឯកសារបណ្តុះបណ្តាល</h1>
				</div>
				<a href="{{ route('admin.tdocs.create') }}" class="btn btn-primary btn-add-style font-Hanuman-bold">បន្ថែមទិន្នន័យ</a>
			</div>
		</div>
	
		<div class="app-card app-card-notification shadow-sm mb-4">
			<div class="app-card-header px-4 py-3">
				<table class="table myTable">
					<thead class="table caption-top">
						<td class="font-Hanuman-bold table-title-font">ល.រ</td>
						<td class="font-Hanuman-bold table-title-font">ឈ្មោះអ្នកប្រើប្រាស់</td>
						<td class="font-Hanuman-bold table-title-font">អ៊ីម៉ែល</td>
                        <td class="font-Hanuman-bold table-title-font">លេខសម្ងាត់</td>
                        <td class="font-Hanuman-bold table-title-font">កាលបរិច្ឆេទ</td>
						<td class="font-Hanuman-bold table-title-font">ការកំណត់រចនាសម្ព័ន្ធ</td>
					</thead>
					<tbody>
					</tbody>
				  </table>
		</div><!--//app-card-->
		<script type="text/javascript">
			//Datatables
			$(document).ready( function () {
    	var table = $('.myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax : "{{ route('admin.tdocs.newsDatatable') }}",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'title_kh', name: 'title_kh'},
				{data: 'title_eng', name: 'title_eng'},
				{data: 'dsc_kh', name: 'dsc_kh'},
				{data: 'dsc_eng', name: 'dsc_eng'},
				{data: 'created_at', name: 'created_at'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		})
	});
		</script>
			@include('vendor.sweetalert.sweet-alert')
@endsection