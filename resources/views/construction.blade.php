@extends('layouts.app')
@section('content')
<div class="pageBody construction text-center"  id="constructionForm">
   	<p><img src="{{ url('/') }}/assets/img/construction.png" style="height:200px" /></p>
   	<p>{{ __('underConstruction') }}</p>
   	<p><a class="btn btn-primary" href="{{ url()->previous() }}">Back</a></p>
</div>
@endsection