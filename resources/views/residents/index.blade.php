@extends('adminlte::layouts.app')

@section('stylesheets')
  <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
  {{ trans('message.users.manage') }}
@endsection

@section('contentheader_title')
  {{ trans('message.users.manage') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.users.list') }}</div>

					<div class="panel-body">
            <table class="table table-condensed the-tables" id="users-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Photo</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('javascripts')
  <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>

  <script>
    $(function() {
      $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.getUsers') !!}',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'username', name: 'username' },
          { data: 'name', name: 'name' },
          { data: 'photo_url', name: 'photo_url', defaultContent: '-',
            render: function ( data, type, full, meta ) {
              return `<img src="${data}" width="40" />`;
            }
          },
          { data: 'action', name: 'action', orderable: false, searchable: false, width: '250px' }
        ]
      });
    });
  </script>
@endsection
