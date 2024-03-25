@extends('layouts.app')

@section('content')
 <h1 class="text-center p-3">{{$project->title}}</h1>
 <div class="container d-flex justify-content-center">
  <div class="card" style="width: 18rem;">
    <img src="{{asset('storage/' . $project->image)}}" class="card-img-top p-3" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$project->title}}</h5>
      <p class="card-text">{{$project->content}}</p>
      <p class="card-text">
        <strong>Linguaggio usato: </strong>{{$project->programming_language}}
      </p>
      <div>
        <p><strong>Creato: </strong>{{$project->created_at}}</p>
        <p><strong>Modificato: </strong>{{$project->updated_at}}</p>
      </div>
      <div class="d-flex gap-2">
      <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna indietro</a>
      <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
      </form>
    </div>
    </div>
  </div>
 </div>
@endsection

@section('scripts')
    <script>
        const deleteForm = document.getElementById('delete-form');

        deleteForm.addEventListener('submit', e => {
            e.preventDefault();

            const confirmation = confirm('Sei sicuro di voler spostare questo progetto nel cestino?');

            if(confirmation) deleteForm.submit();
        });
    </script>
@endsection