@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Folders</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('folders.index') }}">Folders</a></li>
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
                                <h3 class="card-title">Folder List</h3>
                                <div class="float-right">
                                    <a class="btn btn-block btn-sm btn-success mb-2" href="{{ route('folders.create') }}">Create New Folder</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Folder Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Permissions</th> <!-- New column for permissions -->
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                @push('child-scripts')
                                    <script>
                                        $(document).ready(function() {
                                            $('#table').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: {
                                                    url: '{{ route('folders.index') }}',
                                                    type: 'GET',
                                                },
                                                columns: [
                                                    {
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'permissions',
                                                        name: 'permissions'
                                                    }, // Display permissions
                                                    { // Actions column
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('folders.edit', ':id') }}'.replace(':id', data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('folders.destroy', ':id') }}'.replace(':id', data);
                                                            var permissions = full.permissions; // Assuming you have permissions data in your table

                                                            var action = '<div>'; // Start action container

                                                            // Check if user has permission to edit
                                                            if (permissions.includes('edit')) {
                                                                action += '<a href="' + editUrl + '" class="fas fa-edit"></a>';
                                                            }

                                                            // Check if user has permission to delete
                                                            if (permissions.includes('delete')) {
                                                                action += '<a href="#" class="delete-link" ' +
                                                                    'onclick="event.preventDefault(); document.getElementById(\'' +
                                                                    deleteFormId + '\').submit();">' +
                                                                    '<i class="fas fa-trash text-danger"></i>' +
                                                                    '</a>' +
                                                                    '<form id="' + deleteFormId + '" ' +
                                                                    'action="' + deleteUrl +
                                                                    '" method="POST" style="display: none;">' +
                                                                    '@csrf' +
                                                                    '@method('DELETE')' +
                                                                    '</form>';
                                                            }

                                                            // Check if user has permission to read
                                                            if (permissions.includes('read')) {
                                                                action += '<i class="fas fa-eye text-info"></i>';
                                                            }

                                                            // Check if user has permission to write
                                                            if (permissions.includes('write')) {
                                                                action += '<i class="fas fa-pencil-alt text-primary"></i>';
                                                            }

                                                            action += '</div>'; // End action container

                                                            return action;
                                                        }
                                                    },
                                                ]
                                            });
                                        });
                                    </script>
                                @endpush
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
