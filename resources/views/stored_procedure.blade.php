<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Stored Procedure</title>
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
       <h4 class="mt-4">I create stored procedure and it return my desire data but I could not show the stored procedure data in html table :)</h4>
        <div class="row mt-4">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Branch 1</th>
                  <th scope="col">Branch 2</th>
                </tr>
              </thead>
              <tbody>
                @foreach($result as $res)
                <tr>
                  <th scope="col">{{$res->total_customer}}</th>
                  <th scope="col">{{$res->total_customer}}</th>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        
      </div>
  </body>
</html>