@extends('layouts.user_view', ["title" => "Profile"])
@section("content_user")
    <h3 class="text-center mb-3">PROFILE</h3>
    <script>
      var msg = '{{Session::get('alert')}}';
      var exist = '{{Session::has('alert')}}';
      if(exist){
        alert(msg);
      }
    </script>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <img src="/uploads/profile_photo/{{$user->profile_photo}}" class="card-img-top"/>
          <div class="card-body px-0" style="color:grey; font-style:italic">
            <p class="fs-6 px-3">{{ucfirst($user->name)}}</p>
            <hr>
            <p class="fs-6 px-3">{{$user->email}}</p>
            <hr>
            <p class="fs-6 px-3">{{$user->age}} y.o</p>
            <hr>
            <p class="fs-6 px-3">{{ucfirst($user->address)}}</p>
            <hr>
            <p class="fs-6 px-3">{{$user->id_card_number}} (KTP)</p>
          </div>
          <div class="card-footer text-end">
            <a data-bs-toggle="modal" data-bs-target="#modalEditProfile" href="#" class="stretched-link text-decoration-none"><p class="fs-6 m-0 p-0"><i class="fa fa-pencil"></i> Edit</p></a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit Profile-->
    <div class="modal fade" id="modalEditProfile" tabindex="-1" aria-labelledby="modalProfile" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="modalProfile">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/profile/update" method="post">
              <div class="modal-body">
                  <div class="mb-2">
                      <label for="name" class="form-label" style="color:grey; font-style:italic;">Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                  </div>
                  <div class="mb-2">
                      <label for="email" class="form-label" style="color:grey; font-style:italic;">Email</label>
                      <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}">
                  </div>
                  <div class="mb-2">
                      <label for="age" class="form-label" style="color:grey; font-style:italic;">Age</label>
                      <input type="number" name="age" id="age" class="form-control" value="{{$user->age}}">
                  </div>
                  <div class="mb-2">
                      <label for="id_card_number" class="form-label" style="color:grey; font-style:italic;">KTP Number</label>
                      <input type="number" min="1" name="id_card_number" id="id_card_number" class="form-control" value="{{$user->id_card_number}}">
                  </div>
                  <div class="mb-2">
                      <label for="address" class="form-label" style="color:grey; font-style:italic;">Address</label>
                      <input type="text" name="address" id="address" class="form-control" value="{{$user->address}}">
                  </div>
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button class="btn btn-sm btn-primary" type="submit">Update</button>
              </div>
          </form>
      </div>
      </div>
  </div>

  <!-- Modal Change Password -->
  {{-- <div class="modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalPassword" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalPassword">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/cart/update" method="post">
            <div class="modal-body">
                <div class="mb-2">
                    <label for="password" class="form-label" style="color:grey; font-style:italic;">Password</label>
                    <input type="password" name="password" id="password" class="form-control" >
                </div>
                <div class="mb-2">
                    <label for="passwordConfirm" class="form-label" style="color:grey; font-style:italic;">Password Confirm</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" >
                </div>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
    </div> --}}
</div>
@endsection
