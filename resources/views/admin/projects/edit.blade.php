@extends('layouts.app')

@section('content')
<div>
    @include('admin.partials.formEditCreate', ['method'=>'PUT','routeName'=>'admin.projects.update' ])
</div>
@endsection
