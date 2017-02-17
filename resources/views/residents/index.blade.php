@extends('adminlte::layouts.app')

@section('stylesheets')
  <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
  {{ trans('message.residents.manage') }}
@endsection

@section('contentheader_title')
  {{ trans('message.residents.manage') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.residents.list') }}</div>

					<div class="panel-body">
            <table class="table table-condensed the-tables" id="residents-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Jenis Kelamin</th>
                  <th>TTL</th>
                  <th>Pendidikan</th>
                  <th>Pekerjaan</th>
                  <th width="70px">Aksi</th>
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

  <script type="text/javascript">
    $(function() {
      $('#residents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('residents.getResidents') !!}',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'nik', name: 'nik' },
          { data: 'gender', name: 'gender' , defaultContent: '-',
            render: function( data, type, full, meta ) {
              return `<center>${data}</center>`;
            }
          },
          { data: null, defaultContent: '-', orderable: false, searchable: false,
            render: function ( data, type, full, meta ) {
              return full.hometown.name + ', ' + Date.parse(full.date_of_birth).toString('d-M-yyyy');
            }
          },
          { data: 'education.name', name: 'education.name' },
          { data: 'job.name', name: 'job.name' },
          { data: 'action', name: 'action', orderable: false, searchable: false, width: '180px' }
        ]
      });
    });
  </script>
@endsection
