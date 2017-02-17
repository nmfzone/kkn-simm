@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.family_cards.show') }}
@endsection

@section('contentheader_title')
  {{ trans('message.family_cards.show') }}
@endsection

@section('main-content')
  <div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.family_cards.show') }}</div>

					<div class="panel-body">
            <form class="form-horizontal" role="form">

              @include('family_cards.partials._family_card_show_form')

            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
