@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Registration List</h1>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Tables</a></li>
									<li class="breadcrumb-item active" aria-current="page">Table</li>
								</ol> --}}
							</div>

							
						</div>
						<!-- PAGE-HEADER END -->

						<!-- Row -->
		<div class="row row-sm">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All Registrations</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive export-table">
							<table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom  w-100">
								<thead>
									<tr>
										<th class="border-bottom-0">Name</th>
										<th class="border-bottom-0">Mobile</th>
                                        <th class="border-bottom-0">Passing Year</th>
										<th class="border-bottom-0">Total Fee</th>
                                        <th class="border-bottom-0">Guests</th>
                                        <th class="border-bottom-0">Payment Status</th>
										<th class="border-bottom-0">Action</th>

									</tr>
								</thead>
								<tbody>
                                @foreach($registrations as $registration)
									<tr>
										<td>{{$registration->name}}</td>
                                        <td>{{$registration->phone}}</td>
                                        <td>{{$registration->passing_year}}</td>
                                        <td>{{$registration->total_fee}}</td>
                                        <td>{{$registration->guests->count()}}</td>
                                        <td>
                                            @if($registration->payment_status == true)
                                            <button class="btn btn-green">Success</button>
                                            @else
                                            <button  class="btn btn-red">Pending</button>
                                            @endif
                                        </td>

										<td>
                                            <a href="{{route('admin.member.invitations',$registration->id)}}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                            </a>

                                            {{-- <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                            </a>

                                            <button class="btn btn-danger waves effect" type="button"
                                            onclick="deletepost$post({{ $post->id}})" >
                                            <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="deleteform-{{$post->id}}" action="{{route('admin.posts.destroy',$post->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form> --}}
                                        </td>

									</tr>
                                @endforeach

								</tbody>
							</table>
                            {{ $registrations->links('vendor.pagination.custom') }}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

@endsection('content')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function deletepost$post(id)

    {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   event.preventDefault();
   document.getElementById('deleteform-'+id).submit();
  }
})
    }
    </script>

@section('scripts')


       <!-- CHARTJS JS -->
		<script src="{{ asset('assets/plugins/chart/Chart.bundle.js')}}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js')}}"></script>



@endsection
