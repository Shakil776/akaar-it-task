<div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
          <tr>
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