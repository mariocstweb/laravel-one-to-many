@extends('layouts.app')

@section('title', 'Cestino')

@section('content')
<table class="table">
  <h1 class="text-center p-3">Deleted projects</h1>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Slug</th>
      <th scope="col">Contenuto</th>
      <th scope="col">Creato:</th>
      <th scope="col">Aggiornato:</th>
      <th scope="col">Linguaggio</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @forelse ($projects as $project)
    <tr>
      <th scope="row">{{$project->id}}</th>
      <td>{{$project->title}}</td>
      <td>{{$project->slug}}</td>
      <td>{{$project->content}}</td>
      <td>{{$project->created_at}}</td>
      <td>{{$project->updated_at}}</td>
      <td>{{$project->programming_language}}</td>
      <td>
        <div class="d-flex gap-2">
        <form action="{{route('admin.projects.restore', $project->id)}}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-arrows-rotate"></i></button>
        </form>
        <form action="{{route('admin.projects.drop', $project->id)}}" method="POST" id="delete-form">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
        </form>
      </div>
      </td>
    </tr>
  @empty
  <tr>
      <td colspan="5">
          <h3>Non ci sono progetti</h3>
      </td>
  </tr>
  @endforelse
  </tbody>
</table>
@endsection

@section('scripts')
    <script>
        const deleteForm = document.getElementById('delete-form');

        deleteForm.addEventListener('submit', e => {
            e.preventDefault();

            const confirmation = confirm('Sei sicuro di voler definitivamente il progetto?');

            if(confirmation) deleteForm.submit();
        });
    </script>
@endsection
