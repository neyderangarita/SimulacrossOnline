@extends('adminlte::layouts.app')

@section('heading', 'Edit Permission')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
		<form action="{{ route('entrust-gui::permissions.update', $model->id) }}" method="post" role="form">
		<input type="hidden" name="_method" value="put">
		  @include('entrust-gui::permissions.partials.form')
		  <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>{{ trans('entrust-gui::button.save') }}</button>
		  <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::permissions.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('entrust-gui::button.cancel') }}</a>
		</form>
    </div>
  </div>
@endsection

