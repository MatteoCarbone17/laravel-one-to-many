@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route($routeName, $project) }}" enctype="multipart/form-data"  method="POST">
                    @csrf
                    @method($method)
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <p class="fs-5"><i class="fa-solid fa-circle-exclamation"></i> Check Errors </p>
                        </div>
                    @endif
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label font-weight-bold">Project Title</label>
                        <input type="text" name="title" class="form-control   @error('title') is-invalid @enderror "
                            id="title" value="{{ old('title') ?? $project->title }}">
                        @error('title')
                            <div class="invalid-feedback">
                                <p><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                            </div>
                        @enderror
                        <div class="mb-3 mt-3">
                       <select class="form-control"  name="type_id" id="type_id">
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">  {{ $type->name }}  </option>
                                @error('type_id')
                                    <div class="invalid-feedback">
                                        <p><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                                    </div>
                                @enderror
                                @endforeach
                            </select> 
                        </div>
                         {{-- @dump($types, $project)  --}}
                        <div class="mb-3 mt-3">
                            <label for="content" class="form-label d-block">Project Content</label>
                            <textarea name="content" id="" cols="140" class="  @error('content') is-invalid @enderror " rows="10">{{ old('content') ?? $project->content }} </textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    <p><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                        <label for="image" class="form-label font-weight-bold">Project Image</label>
                        <input type="file" name="image" class="form-control   @error('image') is-invalid @enderror "
                            id="image" value="{{ old('image') ?? $project->image }}">
                       </div> 
                      </div>
                        <div class="mb-3 mt-3">
                            <label for="date_start" class="form-label">Project Date Start</label>
                            <input type="date" name="project_date_start"
                                class="form-control   @error('project_date_start') is-invalid @enderror "
                                id="project_date_start"
                                value="{{ old('project_date_start') ?? $project->project_date_start }}">
                            @error('project_date_start')
                                <div class="invalid-feedback">
                                    <p><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="date_end" class="form-label">Project Date End</label>
                            <input type="date" name="project_date_end" class="form-control" id="project_date_end"
                                value="{{ old('project_date_end') ?? $project->project_date_end }}">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Save Project</button>
                    </div>
               </form>
        </div>
    </div>
    </div>
@endsection
