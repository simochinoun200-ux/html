@extends('layouts.app')

@section('content')
<div class="container">
    <h2>uppdate tache </h2>
    
    <form action="{{ route('tasks.updateTitle', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="title" class="form-control" value="{{ $task->title }}">
        </div>
        <button type="submit" class="btn btn-primary">enregistrer </button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">back</a>
    </form>
</div>
@endsection