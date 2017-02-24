@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.family_cards.edit') }}
@endsection

@section('contentheader_title')
  {{ trans('message.family_cards.edit') }}
@endsection

@section('main-content')
  <div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">{{ trans('message.family_cards.edit') }}</div>

					<div class="panel-body">
            <form class="form-horizontal family_card_form" role="form" enctype="multipart/form-data" method="POST" action="{{ route('family_cards.update', $familyCard) }}">

              {{ method_field('PUT') }}
              @include('family_cards.partials._family_card_edit_form')

            </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
