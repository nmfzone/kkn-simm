@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.residents.create') }}
@endsection

@section('contentheader_title')
  {{ trans('message.residents.create') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.residents.create') }}</div>

					<div class="panel-body">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('residents.store') }}">

              @include('residents.partials._resident_create_form')

            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
