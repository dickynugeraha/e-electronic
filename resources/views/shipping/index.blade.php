@extends('layouts.admin_view', ["title" => "Shippings"])
@section("content_admin")
<h3 class="text-center my-3">SHIPPINGS</h3>
<div class="mb-4">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddProduct" style="text-decoration:none"><i class="fa fa-plus me-2"></i> Add shipping</a>
</div>
 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Shipping</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/shipping" method="post">
          <div class="modal-body">
              <div class="mb-2">
                  <label for="area" class="form-label">Area</label>
                  <input type="text" name="area" id="area" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="price" class="form-label">Price</label>
                  <input type="text" name="price" id="price" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="estimated_arrival" class="form-label">Estimated Arrival (day)</label>
                <input type="text" name="estimated_arrival" id="estimated_arrival" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button class="btn btn-sm btn-primary" type="submit">Add</button>
          </div>
      </form>
  </div>
  </div>
</div>
<div class="row">
    <table id="dataShippings" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Area</th>
          <th>Price</th>
          <th>Estimated Arrival</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($shippings as $shipping)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$shipping->area}}</td>
            <td>Rp. {{number_format($shipping->price,0,',','.')}}</td>
            <td>{{$shipping->estimated_arrival}}</td>
            <td>
              <a href="#" class="text-decoration-none me-2">Edit</a>
              <a href="#" class="text-decoration-none">Delete</a>
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
                        {{$shipping->title}}
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
      $('#dataShippings').DataTable();
  });
</script>
@endsection