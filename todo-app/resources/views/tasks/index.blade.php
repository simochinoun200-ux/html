@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Ajouter Un Tache</h1>
    <div class="card mb-4">
        <div class="card-header">nouveau tache</div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="title" class="form-control" required placeholder="Ajouter un Tache...">
                    <button class="btn btn-primary">ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <h1>Liste des Tache</h1>
    <div class="card">
        <div class="card-header">List des taches</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
    <table class="table table-bordered">
        <thead>
            <tr>
        <th>user</th>
        <th>tache</th>
        <th>status</th>
        <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
        <td>{{ $task->user->name }}</td>
        <td style="{{ $task->status == 'completed' ? 'text-decoration: line-through' : '' }}">{{ $task->title }}</td>
        <td>
            @if($task->user_id == auth()->id())
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm {{ $task->status == 'completed' ? 'btn-success' : 'btn-secondary' }}">{{ $task->status == 'completed' ? 'complete' : 'en attente' }}</button>
                </form>
            @else
                <span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">{{ $task->status == 'completed' ? 'complete' : 'en attente' }}</span>
@endif
        </td>
        <td>
            @if($task->user_id == auth()->id())
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">uppdate</a>
                                
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('supprimer????')">delete</button>
                                </form>
            @else
                <span class="text-muted">cant change tache  </span>
            @endif
                        </td>
    </tr>
        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection