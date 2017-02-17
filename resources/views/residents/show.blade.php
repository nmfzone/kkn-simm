@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.residents.show') }}
@endsection

@section('contentheader_title')
  {{ trans('message.residents.show') }}
@endsection

@section('main-content')
  <div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.residents.show') }}</div>

					<div class="panel-body">
            <form class="form-horizontal" role="form">
              @include('residents.partials._resident_show_form')
            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
