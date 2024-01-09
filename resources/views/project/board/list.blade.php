@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Board</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('project.board.index') }}">Board</a></li> --}}
                            {{-- <li class="breadcrumb-item"><a href="{{ route('project.board.index') }}">Board</a></li> --}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Board list</h3>
                                <div class="float-right">
                                    <a class="btn btn-block btn-sm btn-success mb-2"
                                        href="{{ route('project.board.create', $id) }}">Create New Board</a>
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                            <label class="custom-control-label" for="customSwitch1"></label>
                                        </div>
                                        <div class="text-center mt-1">Active</div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($boards as $board)
                                                <tr>
                                                    <td>{{ $board->id }}</td>
                                                    <td><a
                                                            href="{{ route('project.board.task.index', ['projectId' => $id, 'boardId' => $board->id]) }}">{{ $board->name }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('project.board.edit', ['project' => $id, 'board' => $board->id]) }}"
                                                            class="fas fa-edit"></a>

                                                        <a href="#" class="delete-link"
                                                            onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this board?')) document.getElementById('delete-form-{{ $board->id }}').submit();">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $board->id }}"
                                                            action="{{ route('project.board.destroy', ['project' => $id, 'board' => $board->id]) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </td>

                                                    {{-- <td><a href="{{ route('project.board.task.index', ['projectId' => $id, 'boardId' => $board->id]) }}">{{ $board->name }}</td> --}}
                                                    {{-- <td>
                                                    <a href="{{ route('board.edit', $board->id) }}" class="fas fa-edit"></a>
                                                    <a href="#" class="delete-link" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this board?')) document.getElementById('delete-form-{{ $board->id }}').submit();">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $board->id }}" action="{{ route('board.destroy', $board->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
@endsection
