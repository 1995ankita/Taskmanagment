<!doctype html>
<html lang="en">

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Task</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('project.board.FormBuilder.index') }}">Form Builder</a></li> --}}
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
                                <h3 class="card-title">Task list</h3>
                                <div class="float-right">
                                    <a class="btn btn-block btn-sm btn-success mb-2"
                                        href="{{ route('project.board.task.create', ['projectId' => $projectId, 'boardId' => $boardId]) }}">Create
                                        New Task</a>
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
                                                <th scope="col">Name</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($forms as $form)
                                                <tr>
                                                    <td>{{ $form->name }}</td>
                                                    <td>
                                                        {{-- <a href="{{ URL('edit-form-builder', $form->id) }}"
                                                            class="btn btn-primary">Edit</a> --}}
                                                            <a href="{{ route('edit-form-builder', ['projectId' => $projectId, 'boardId' => $boardId, 'taskId' => $form->id]) }}" class="btn btn-primary">Edit</a>


                                                        {{-- <a href="{{ URL('read-form-builder', $form->id) }}"
                                                            class="btn btn-primary">Show</a> --}}
                                                        {{-- <form method="POST" action="{{ URL('form-delete', $form->id) }}"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this form?')">Delete</button>
                                                        </form> --}}
                                                    </td>
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
@endsection
