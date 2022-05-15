<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Task 2 || File Transfer</title>
  </head>
  <body>
      <div class="container mt-4">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('index') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('import') }}">Task 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('file-transfer') }}">Task 2</a>
            </li>
          </ul>
        </div>
        </nav>

        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @endif

        <div class="d-flex justify-content-center mt-4">
          <form action="{{ route('file-transfer') }}" method="post">
            @csrf
            <input type="submit" name="submit" value="Transfer File" class="btn btn-success">
          </form>
        </div>
      </div>

  </body>
</html>