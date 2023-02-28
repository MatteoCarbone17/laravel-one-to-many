@extends('layouts.app')

@section('content')
<div>
    @include('admin.partials.formEditCreate', ['method'=>'POST','routeName'=>'admin.projects.store' ])
</div>
@endsection
