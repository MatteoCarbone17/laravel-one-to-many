@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <table class="table table-striped table-hover">
        <div class=" m-4">
          @if (session('message'))
          <div class=" alert alert{{session('classMessage')}}">
            {{ (session('message')) }}
          </div>
          @endif
        </div>
        <thead class=" table-dark text-light font-semibold">
            <tr>
              <th scope="col">#id</th>
              <th scope="col">Title</th>
              <th scope="col">Project date start</th>
              <th scope="col">Project date end</th>
              <th scope="col" >Actions <a class="mx-3 btn btn-primary btn-sm" href="{{ route('admin.projects.create') }}"> Add new Project <i class="fa-solid fa-plus"></i> </a> </th>
             
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                
            <tr class="">
              <th scope="row">{{ $project->id}} </th>
              <td>{{ $project->title }}</td>
              <td>{{ $project->project_date_start }}</td>
              <td>{{ $project->project_date_end }}</td>
              <td>
                <a class="btn btn-success"  href="{{ route('admin.projects.show' , $project->id) }}"><i class="fa-solid fa-eye"></i> </a>
                <a class="btn btn-warning"  href="{{ route('admin.projects.edit' ,  $project->id) }}" ><i class="fa-solid fa-edit"></i> </a>
               <form class="d-inline-block delete double-confirm" action="{{ route('admin.projects.destroy' , $project->id) }}" method="POST" >
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button> 
                </form> 
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <div class="row mt-2 mb-4">
      <div class="col">
        {{ $projects->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
    @vite('resources/js/deleteButton.js')
@endsection
