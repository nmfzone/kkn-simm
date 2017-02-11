@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.family_cards.create') }}
@endsection

@section('contentheader_title')
  {{ trans('message.family_cards.create') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.family_cards.create') }}</div>

					<div class="panel-body">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ route('family_cards.store') }}">

              @include('family_cards.partials._family_card_create_form')

            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
