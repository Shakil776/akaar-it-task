<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>CSV File Import</title>
  </head>
  <body>
      <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-md-6 offset-md-3">
            <form  action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="csv">Choose CSV File</label>
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
        </div>
      </div>


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



    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script> 
      $(document).ready(function(){

        // csrf token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


          $(document).on('change','#branch_id',function(){

            var branch_filter = $(this).val();

            $.ajax({
              url: '/',
              method: 'GET',
              data: {branch_filter:branch_filter},
              success: function(data){
                $(".data").html(data);
              }
            });

          });

          $(document).on('change','#gender',function(){

            var gender_filter = $(this).val();

            $.ajax({
              url: '/',
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