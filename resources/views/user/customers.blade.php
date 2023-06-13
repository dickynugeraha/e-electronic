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
          <th>Photo</th>
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
            <td>
              <img width="120px" class="rounded" src="/uploads/profile_photo/{{$user->profile_photo}}" alt="" srcset="">
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->id_card_number}}</td>
            <td>
              {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}" href="#" class="text-decoration-none me-2">Edit</a> --}}
              <a href="/user/{{$user->id}}/delete" class="text-decoration-none">Delete</a>
            </td>
          </tr>
        <?php $nomor++ ?>
        <!-- Modal Edit-->
        {{-- <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Profile edit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/product/update" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$user->address}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control" value="{{$user->age}}" required>
                    </div>
                    <div class="mb-2">
                        <label for="id_card_number" class="form-label">ID card number</label>
                        <input type="number" name="id_card_number" id="id_card_number" class="form-control" value="{{$user->id_card_number}}" required>
                    </div>
                    <div class="mb-2">
                      <label for="profile_photo" class="form-label">Photo</label>
                      <input type="file" name="profile_photo" id="profile_photo" class="form-control">
                    </div>
                   
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-primary" type="submit">Add</button>
                </div>
            </form>
          </div>
          </div>
      </div> --}}
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