@extends('layouts.admin_view', ["title" => "Customers"])
@section("content_admin")
<h3 class="text-center my-3">CUSTOMERS</h3>

 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 
<div class="row">
    <table id="dataUsers" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Age</th>
          <th>ID Card Number</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->id_card_number}}</td>
            <td>
              <a href="#" class="text-decoration-none me-2">Edit</a>
              <a href="/user/{{$user->id}}/delete" class="text-decoration-none">Delete</a>
            </td>
          </tr>
        <?php $nomor++ ?>
        <!-- Modal Detail-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header"></div>
                    <div class="modal-body">
                        {{$user->title}}
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-default"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
      </tbody>

    </table>
</div>

@endsection

@section('add_javascript')
<script>
  $(document).ready(function () {
      $('#dataUsers').DataTable();
  });
</script>
@endsection