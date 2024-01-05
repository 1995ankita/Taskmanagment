<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">

            <a href="{{ URL('formbuilder') }}" class="btn btn-success float-right">Create</a>
            <table class="table table-bordered table-light">
                <thead>
                    <tr>
                        <thead>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td>{{ $form->name }}</td>
                            <td>
                                <a href="{{ URL('edit-form-builder', $form->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ URL('read-form-builder', $form->id) }}" class="btn btn-primary">Show</a>
                                {{-- <form method="POST" action="{{ URL('form-delete', $form->id) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-md-1">
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
