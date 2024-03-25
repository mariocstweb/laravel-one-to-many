@if($project->exists)
<form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
@method('PUT')
@else
<form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
@endif
@csrf
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
        <label for="exampleFormControlInput1" class="form-label">Immagine</label>
        <input type="file" class="form-control" placeholder="Insert title" name="image" value="{{old('image', $project->image)}}">
      </div>
    </div>
    <div class="col-12">
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Content</label>
        <input type="text" class="form-control" placeholder="Insert title" name="content" value="{{old('content', $project->content)}}">
      </div>
    </div>
    <div class="d-flex justify-content-center p-3">
      <button type="submit" class="btn btn-primary me-3">Salva</button>
      <button type="reset" class="btn btn btn-secondary">Reset</button>
    </div>

</form>