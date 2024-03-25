@extends('layouts.app')

@section('title', 'Modifica un progetto')


@section('content')
<h1 class="text-center p-3">Modifica il progetto</h1>
{{-- <form action="{{route('admin.projects.update', $project)}}" method="POST">
  @csrf
  @method('PUT')
  @if($errors->any())
  <div class="alert alert-danger">
    <h1>Campi non validi:</h1>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="row p-3">
    <div class="col-6">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Titolo</label>
        <input type="text" class="form-control" placeholder="Insert title" name="title" value="{{old('title', $project->title)}}">
      </div>
    </div>
    <div class="col-6">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Linguaggio</label>
        <input type="text" class="form-control" placeholder="Insert title" name="programming_language" value="{{old('programming_language', $project->programming_language)}}">
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Content</label>
        <input type="text" class="form-control" placeholder="Insert title" name="content" value="{{old('content', $project->content)}}">
      </div>
    </div>
    <div class="d-flex justify-content-center p-3">
      <button type="submit" class="btn btn-primary me-3">Modifica</button>
      <button type="reset" class="btn btn btn-secondary">Reset</button>
    </div>
</form> --}}
@include('includes.form.form')
@endsection