@extends('layouts.admin_view', ["title" => "Products"])
@section("content_admin")
<h3 class="text-center my-3">PRODUCTS</h3>
<div class="mb-4">
  <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddProduct" style="text-decoration:none"><i class="fa fa-plus me-2"></i> Add product</a>
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
      <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/product" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="mb-2">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" name="title" id="title" class="form-control" required>
              </div>
              <div class="mb-2">
                <label for="type" class="form-label">Type</label>
                  <select name="type" id="type" class="form-select">
                    <option value="">Choose one</option>
                    <option value="electronic">Electronic</option>
                    <option value="kitchen">Kitchen</option>
                    <option value="furniture">Furniture</option>
                  </select>
              </div>
              <div class="mb-2">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" name="price" id="price" class="form-control" required>
              </div>
              <div class="mb-2">
                  <label for="description" class="form-label d-block">Description</label>
                  <textarea id="description" name="description" class="form-control" cols="30" rows="8"></textarea>
              </div>
              <div class="mb-2">
                <label for="product_photo" class="form-label">Image</label>
                <input type="file" name="product_photo" id="product_photo" class="form-control">
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
    <table id="dataProducts" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Image</th>
          <th>Price</th>
          <th>Type</th>
          <th>Description</th>
          <th>Is Available</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$product->title}}</td>
            <td>
              <img style="border-radius: 50%" width="120px" height="120px" src="/uploads/product_photo/{{$product->product_photo}}" alt="Photo product" srcset="">
            </td>
            <td>{{number_format($product->price,0,',','.')}}</td>
            <td>{{$product->type}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->is_available === 1 ? "Ready stock" : "Out off stock"}}</td>
            <td>
              <a class="text-decoration-none me-2" href="/"> Edit</a>
              <a class="text-decoration-none" href="/product/{{$product->id}}/delete"> Delete</a>
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
                        {{$product->title}}
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
      $('#dataProducts').DataTable();
  });
</script>
@endsection