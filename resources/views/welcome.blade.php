<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Assesment</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .custom-file-input.selected:lang(en)::after {
            content: "" !important;
            }
            .custom-file {
            overflow: hidden;
            }
            .custom-file-input {
            white-space: nowrap;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="navbar navbar-dark bg-dark box-shadow">
                <div class="container d-flex justify-content-between">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Laravel Assesment</strong>
                    </a>
                </div>
            </div>
        </header>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <img src="uploads/{{ Session::get('file') }}">
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>Whoops! {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 offset-8">
                        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept=".txt" name="file" id="customFileInput" aria-describedby="customFileInput">
                                    <label class="custom-file-label" for="customFileInput">Select file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="customFileInput">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Affiliate Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Latitude</th>
                                    <th scope="col">Longitud</th>
                                    <th scope="col">Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-center">No records</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('.custom-file-input').addEventListener('change', function (e) {
              var name = document.getElementById("customFileInput").files[0].name;
              var nextSibling = e.target.nextElementSibling
              nextSibling.innerText = name
            })
        </script>
    </body>
</html>
