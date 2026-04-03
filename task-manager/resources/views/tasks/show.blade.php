@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Просмотр задачи #{{ $task->id }}</h5>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Назад к списку</a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="text-primary">{{ $task->title }}</h4>
                        <hr>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold">Описание:</label>
                        <div class="p-3 bg-light border rounded">
                            {!! nl2br(e($task->description)) ?: '<span class="text-muted">Нет описания</span>' !!}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="fw-bold">Статус:</label>
                            <div>
                                @if($task->status == 'new')
                                    <span class="badge bg-secondary">Новая</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge bg-warning text-dark">В работе</span>
                                @elseif($task->status == 'completed')
                                    <span class="badge bg-success">Выполнена</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">
                                Создана: {{ $task->created_at->format('d.m.Y H:i') }}<br>
                                Обновлена: {{ $task->updated_at->format('d.m.Y H:i') }}
                            </small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Редактировать</a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                            onsubmit="return confirm('Вы уверены?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection