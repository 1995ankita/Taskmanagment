@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Category</a></li>
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
                                <h3 class="card-title">Category list</h3>
                                <div class="float-right">
                                    <a class="btn btn-block btn-sm btn-success mb-2"
                                        href="{{ route('project.create') }}">Create New Category</a>
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
                                            {{-- Loop through your categories and populate the table --}}
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    {{-- <td>{{ $category->created_at ? $category->created_at->format('Y-m-d') : '' }}</td>
                                                    <td>{{ $category->created_at ? $category->created_at->format('H:i:s') : '' }}</td>
                                                    <td>{{ $category->creator->name ?? '' }}</td>
                                                    <td>

                                                        <a href="{{ route('categories.edit', $category->id) }}" class="fas fa-edit"></a>
                                                        @if ($isAdmin)
                                                            <a href="#" class="delete-link"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $category->id }}"
                                                                action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                                style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endif
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- @push('child-scripts')
                                    <script>
                                        var columnStructure = [{
                                                data: 'id',
                                                name: 'id'
                                            },
                                            {
                                                data: 'name',
                                                name: 'name'
                                            },
                                            {
                                                data: 'icon',
                                                name: 'icon',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return '<i class="fas fa-check text-primary"></i>';
                                                    } else {
                                                        return '<i class="fas fa-times text-secondary"></i>';
                                                    }
                                                }
                                            }, {
                                                data: 'logo',
                                                name: 'logo',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return '<i class="fas fa-check text-primary"></i>';
                                                    } else {
                                                        return '<i class="fas fa-times text-secondary"></i>';
                                                    }
                                                }
                                            }, {
                                                data: 'is_active',
                                                name: 'is_active',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return '<i class="fas fa-toggle-on text-primary is_active" data-activestatus="' +
                                                            0 + '" data-val="' + full.id + '"></i>';
                                                    } else {
                                                        return '<i class="fas fa-toggle-on text-secondary is_active" data-activestatus="' +
                                                            1 + '" data-val="' + full.id + '"></i>';
                                                    }
                                                }
                                            },
                                            {
                                                data: 'is_popular',
                                                name: 'is_popular',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return '<i class="fas fa-toggle-on text-primary"></i>';
                                                    } else {
                                                        return '<i class="fas fa-toggle-on text-secondary"></i>';
                                                    }
                                                }
                                            }, {
                                                data: 'is_technical',
                                                name: 'is_technical',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return '<i class="fas fa-toggle-on text-primary"></i>';
                                                    } else {
                                                        return '<i class="fas fa-toggle-on text-secondary"></i>';
                                                    }
                                                }
                                            },

                                            {
                                                data: 'country',
                                                name: 'country',
                                                render: function(data, type, full, meta) {
                                                    var isChecked = full.countries.some(function(country) {
                                                        if (country.pivot.deleted_at == null) {
                                                            return true;
                                                        } else {
                                                            return false;
                                                        }
                                                    });
                                                    return '<input type="checkbox" class="category-checkbox" data-category-id="' +
                                                        full.id + '" ' +
                                                        (isChecked ? 'checked' : '') + '>';
                                                }
                                            },
                                            {
                                                data: 'popular',
                                                name: 'popular',
                                                render: function(data, type, full, meta) {
                                                    var ispopular = full.countries.some(function(country) {
                                                        return country.pivot.is_popular;
                                                    });
                                                    if (ispopular == 1) {
                                                        return '<i class="fas fa-toggle-on text-primary is_popular" data-popularstatus="' +
                                                            0 + '" data-val="' + full.id + '"></i>';
                                                    } else {
                                                        return '<i class="fas fa-toggle-on text-secondary is_popular" data-popularstatus="' +
                                                            1 + '" data-val="' + full.id + '"></i>';
                                                    }
                                                }
                                            },


                                            {
                                                data: 'created_at',
                                                name: 'created_at',
                                                render: function(data, type, full, meta) {
                                                    if (data) {
                                                        return moment(data).format('DD MMM YYYY [at] HH:mm:ss [GMT]');
                                                    }
                                                    return '';
                                                }
                                            }, {
                                                data: 'creator.name',
                                                name: 'creator.name'
                                            }, {
                                                data: 'id',
                                                name: 'actions',
                                                orderable: false,
                                                searchable: false,
                                                render: function(data, type, full, meta) {
                                                    var editUrl = '{{ route('category.edit', ':id') }}'.replace(':id',
                                                        data);
                                                    var deleteFormId = 'delete-form-' + data;
                                                    var deleteUrl = '{{ route('category.destroy', ':id') }}'.replace(':id',
                                                        data);
                                                    @php
                                                        $isAdmin = in_array('Admin', array_column(Auth::user()->roles->toArray(), 'name'));
                                                    @endphp

                                                    var action = '<a href="' + editUrl + '" class="fas fa-edit"></a>';

                                                    if (@json($isAdmin)) {
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
                                                    return action;
                                                }
                                            },
                                        ]
                                        loadAllData();
                                    </script>
                                @endpush --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
{{-- @push('child-scripts')
    <script>
        $(document).ready(function() {
            function loadAllData() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('category.index') }}',
                    columns: columnStructure
                });
            }

            function loadActiveData() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('getActiveCategories') }}',
                    columns: columnStructure
                });
            }

            $('#customSwitch1').on('change', function() {
                var isChecked = $(this).prop('checked');
                $('#table').DataTable().destroy();
                if (isChecked) {
                    loadActiveData();
                } else {
                    loadAllData();
                }
            });

            loadAllData();

            $('#table').on('click', '.is_active', function() {
                var activestatus = $(this).data('activestatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/changecategoryStatus';
                handleStatusToggle($toggle, activestatus, dataVal, url);
            });

            $('#table').on('click', '.is_popular', function() {
                var popularstatus = $(this).data('popularstatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/categorysetpopular';
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    data: {
                        'is_popular': popularstatus,
                        'id': dataVal
                    },
                    success: function(data) {
                        if (popularstatus === 1) {
                            $toggle.removeClass('text-secondary').addClass('text-primary');
                            $toggle.data('popularstatus', 0);
                            $('#success-message').text(data.success).show();
                            $('#danger-message').text(data.success).hide();
                        } else {
                            $toggle.removeClass('text-primary').addClass('text-secondary');
                            $toggle.data('popularstatus', 1);
                            $('#danger-message').text(data.success).show();
                            $('#success-message').text(data.success).hide();
                        }
                    }
                });
            });

            $('#table').on('click', '.category-checkbox', function() {
                var categoryId = $(this).data('category-id');
                var isChecked = $(this).prop('checked');
                var url = '/country-category';
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: url,
                    data: {
                        'id': categoryId,
                        'checked': isChecked
                    },
                    success: function(data) {
                        $checkbox.prop('checked', data.deleted_at === null);
                    }
                });
            });

        });
    </script>
@endpush --}}