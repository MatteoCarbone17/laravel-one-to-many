@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class=" m-4">
                    @if (session('message'))
                        <div class=" alert alert{{ session('classMessage') }}">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card  rounded-4 p-5">
                    <div class="card-header d-flex  rounded-4 bg-success text-light justify-content-between p-3">
                        <p>
                            Author : {{ $project->author }}
                        </p>
                        <span>
                            <i class="fa-solid fa-envelopes-bulk"></i>
                        </span>
                        <p>
                            <a class="dropdown-item" href="{{ url('profile') }}"> {{ Auth::user()['name'] }}</a>
                        </p>
                    </div>
                    <div class="card-body  rounded-4 text-center">
                      <h5 class="card-title mt-2 mb-2">{{ $project->title }}</h5>
                        <div class="card-img mt-2 mb-2">
                            <img src="{{ asset('storage/imgs/'. $project->image) }}" class="img-fluid" alt="">
                        </div>
                        <p class="card-text p-3">{{ $project->content }}</p>
                        <div class="card-footer  rounded-4 p-3">
                            <span class="d-block">Data inizio : {{ $project->project_date_start }} </span>
                            @if (isset($project->project_date_end))
                                <p> Data fine: {{ $project->project_date_end }}</p>
                            @else
                                <p> Project working in progress </p>
                            @endif
                            <span> Slug: {{ $project->slug }} </span>
                        </div>
                        <div class="col">
                            <div class="mt-3">
                                <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->id) }}"> Edit
                                    <i class="fa-solid fa-edit"></i> </a>
                                <form class="d-inline-block delete double-confirm"
                                    action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-5">
                          <div class="col-4">
                            @if (isset($previousProject->id))
                                <a class="btn btn-outline-primary mt-3"
                                    href="{{ route('admin.projects.show', $previousProject->id) }}">Previous Page</a>
                            @else
                                <a class="btn btn-outline-primary disabled mt-3" href="">End Previous Page</a>
                            @endif
                        </div>
                        <div class="col-4">
                            <a class="btn btn-success mt-3"
                                href="{{ route('admin.projects.index', $project->id) }}">Return to Project Page</a>
                        </div>
                        <div class="col-4">
                            @if (isset($nextProject->id))
                                <a class="btn btn-outline-primary mt-3"
                                    href="{{ route('admin.projects.show', $nextProject->id) }}">Next Page</a>
                            @else
                                <a class="btn btn-outline-primary disabled mt-3" href="">End Next Page</a>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @vite('resources/js/deleteButton.js')
@endsection
