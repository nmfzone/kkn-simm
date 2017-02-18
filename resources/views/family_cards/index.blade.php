@extends('adminlte::layouts.app')

@section('stylesheets')
  <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
  {{ trans('message.family_cards.manage') }}
@endsection

@section('contentheader_title')
  {{ trans('message.family_cards.manage') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.family_cards.list') }}</div>

					<div class="panel-body">
            <table class="table table-condensed the-tables" id="family-cards-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>No KK</th>
                  <th>Kadus</th>
                  <th>RT</th>
                  <th>RW</th>
                  <th>Desa</th>
                  <th>Kepala Keluarga</th>
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

  <script>
    $(function() {
      $('#family-cards-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('family_cards.getFamilyCards') !!}',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'number', name: 'number' },
          { data: 'kadus', name: 'kadus' },
          { data: 'rt', name: 'rt' },
          { data: 'rw', name: 'rw' },
          { data: 'village.name', name: 'village.name' },
          { data: 'patriarch.name', name: 'patriarch.name' },
          { data: 'action', name: 'action', orderable: false, searchable: false, width: '250px' }
        ]
      });
    });
  </script>
@endsection
