@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Задачи</h5>
                    <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm"> + Добавить задачу</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-5">
                            <input type="text" name="search" class="form-control" placeholder="Поиск по названию..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">Все статусы</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новая</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>В
                                    работе</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Выполнена
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Найти</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100">Сбросить</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th class="text-end">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            @if($task->status == 'new')
                                                <span class="badge bg-secondary">Новая</span>
                                            @elseif($task->status == 'in_progress')
                                                <span class="badge bg-warning text-dark">В работе</span>
                                            @elseif($task->status == 'completed')
                                                <span class="badge bg-success">Выполнена</span>
                                            @endif
                                        </td>
                                        <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tasks.show', $task) }}"
                                                    class="btn btn-info btn-sm text-white" title="Просмотр">
                                                    <i class="bi bi-eye">👁️</i>
                                                </a>
                                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm"
                                                    title="Редактировать">
                                                    <i class="bi bi-pencil">✏️</i>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Вы уверены?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Удалить">
                                                        <i class="bi bi-trash">🗑️</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Задачи не найдены.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection