@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($projects as $project)
    <div class="row p-3">
        <div class="col">
            <div class="card p-2  rounded-4 ">
                <div class="card-header d-flex rounded-4 bg-success text-light justify-content-center p-3">
                    <span>
                        @if (isset(Auth::user()['name']))
                        <i class="fa-solid fa-envelopes-bulk"></i>
                        @else
                        <a class="nav-link" href="{{ route('login') }}"> <i class="fa-solid fa-envelopes-bulk"></i> </a>
                        @endif
                    </span>
                    @isset(Auth::user()['name'])
                    <p class="ms-auto">
                        <a class="dropdown-item" href="{{ url('profile') }}"> {{ Auth::user()['name'] }}</a>
                    </p>
                    @endisset
                </div>
                <div class="card-body rounded-4  text-center">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <p>
                        Author :  {{ $project->author }}
                    </p>
                    <div class="card-img mt-2 mb-2">
                        <img src="{{ asset('storage/imgs/'. $project->image) }}" class="img-fluid" alt="">
                    </div>
                    <p class="card-text rounded-4  font-medium p-3 ">{{ $project->content }}</p>
                    <div class="card-footer p-2">
                        <span class="d-block">Data inizio : {{ $project->project_date_start }} </span>
                        @if (isset($project->project_date_end))
                            <p> Data fine: {{ $project->project_date_end }}</p>
                        @else
                            <p> Project working in progress </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row mt-2 mb-4">
        <div class="col">
          {{ $projects->links()}}
        </div>
    </div>
</div>
</div>
@endsection
