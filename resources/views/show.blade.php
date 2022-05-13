<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

      @if(isset($customers) && !empty($customers))
      <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">

              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="branch_id">Branch</label>
                    <select id="branch_id" name="branch_id" class="form-control">
                      <option selected>Select Branch</option>
                      <option>Branch 1</option>
                      <option>Branch 2</option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                      <option selected>Select Gender</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </div>
                </div>
              </form>




            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Branch Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                    <tr>
                      <th scope="row">{{ $loop->index + 1 }}</th>
                      <td>{{ $customer->branch_id }}</td>
                      <td>{{ $customer->first_name }}</td>
                      <td>{{ $customer->last_name }}</td>
                      <td>{{ $customer->email }}</td>
                      <td>{{ $customer->phone }}</td>
                      <td>{{ $customer->gender }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="d-felx justify-content-center">
            {{ $customers->links() }}
        </div>
      </div>
      @endif


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>