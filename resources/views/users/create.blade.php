@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.users_create') }}
@endsection

@section('contentheader_title')
  {{ trans('message.users_create') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.users_create') }}</div>

					<div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('users.store') }}">

              @include('users.partials._user_create_form')

            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
