<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Task 1 || CSV File Import</title>
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
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif

        <div class="row mt-2">
            <div class="col-md-6">
              <form  action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="csv">Upload CSV File</label>
                      <input type="file" name="csv" class="form-control @error('csv') is-invalid @enderror" id="csv" />
                      @error('csv')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>

            <div class="col-md-6 text-right mt-4">
                <a href="{{ route('call-procedure') }}" class="btn btn-info">Show Stored Procedure Data</a>
            </div>
        </div>
      </div>

      @if(isset($customers) && count($customers) > 0)
      <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="branch_id">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control">
                        <option value="">Select Branch</option>
                        <option value="1">Branch 1</option>
                        <option value="2">Branch 2</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                      <option value="">Select Gender</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
        </div>
        <div class="data">
          @include('table')
        </div>

        <div class="pagination">
          @if(isset($_GET['branch_filter']) && !empty($_GET['branch_filter']))
            {{ $customers->appends(['branch_filter' => $_GET['branch_filter']])->links() }}
          @else
            {{ $customers->links() }}
          @endif
        </div>
      </div>
      @endif



    <!--  jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script> 
      $(document).ready(function(){

        // csrf token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

          // send ajax request for branch wise filter
          $(document).on('change','#branch_id',function(){

            var branch_filter = $(this).val();

            $.ajax({
              url: '/import',
              method: 'GET',
              data: {branch_filter:branch_filter},
              success: function(data){
                $(".data").html(data);
              }
            });

          });

          // send ajax request for gender filter
          $(document).on('change','#gender',function(){

            var gender_filter = $(this).val();

            $.ajax({
              url: '/import',
              method: 'GET',
              data: {gender_filter:gender_filter},
              success: function(data){
                $(".data").html(data);
              }
            });

          });

      });
    </script>
  </body>
</html>