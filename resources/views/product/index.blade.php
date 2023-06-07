@extends('layouts.user_view', ["title" => "Products"])
@section("content_user")
    <h3 class="text-center mb-3">PRODUCTS</h3>
    <div class="dropdown ms-auto mr-0 mb-3">
      <form action="" class="d-flex align-items-center">
        <div class="me-3">
          <label for="type">Filter berdasarkan:</label>
        </div>
        <div>
          <select id="type" class="form-select" name="Tipe">
            <option value="all">All</option>
            <option value="electronic">Electronic</option>
            <option value="kitchen">Kitchen</option>
            <option value="furniture">Furniture</option>
          </select>
        </div>
      </form>
      </div>
    @foreach ($products as $product)
    <div class="card" style="width: 15rem;">
      <div class="card-header fs-4">
        {{ucfirst($product->title)}}
      </div>
      <img src="{{ $product->image_url }}" class="card-img-top" alt="...">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Rp. {{$product->price}}</b></li>
        <?php $descriptions = explode("|", $product->description) ?>
        <li class="list-group-item">{{ucfirst($descriptions[0])}}..</li>
        <li class="list-group-item">
          <div class="text-end">
          {{-- <div class="d-flex justify-content-between"> --}}
            {{-- <a class="btn btn-md btn-warning" data-toggle="modal" data-target="myModal{{$product->id}}" style="text-decoration:none"><i class="fa fa-info-circle"></i> Detail</a> --}}
            {{-- <button id="detail_product" data-href="product/{{$product->id}}"class="btn btn-xs" role="button">Details</button> --}}
            <a href="/product/{{$product->id}}" style="text-decoration:none"><i class="fa fa-info-circle"></i> Detail</a>
            {{-- <a href="" style="text-decoration:none"><i class="fa fa-shopping-cart"></i> Add to cart</a> --}}
          </div>
        </li>
      </ul>
    </div>
    <!-- Modal Detail-->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
              </div>
              <div class="modal-body">
                {{$product->title}}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
    @endforeach
@endsection
@section('add_javascript')
<script>
  $(document).ready(function(){
      $("#detail_product").click(function(){
         var dataURL = $(this).attr( "data-href" )
          $('.modal-body').load(dataURL,function(){
      $('#myModal').modal({show:true});
  });
      });
  });
</script>
@endsection