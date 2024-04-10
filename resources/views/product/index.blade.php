@extends('layouts.user_view', ["title" => "Products"])
@section("content_user")
<h3 class="text-center mb-3">PRODUCTS</h3>
<div class="dropdown ms-auto mr-0 mb-3">
  <form action="" class="d-flex align-items-center">
    <div class="me-3">
      <label for="type">Show product by:</label>
    </div>
    <div>
      <select id="type" class="form-select" name="type">
        <option value="all">All</option>
        <option value="sling_bag">Sling Bag</option>
        <option value="crossbody_bag">Crossbody Bag</option>
        <option value="tote_bag">Tote Bag</option>
        <option value="hand_bag">Hand Bag</option>
        <option value="serut_bag">Serut Bag</option>
        <option value="goodie_bag">Goodie Bag</option>
      </select>
    </div>
    <button type="submit" class="btn btn-sm btn-primary ms-3">Filter</button>
  </form>
</div>
<div class="row">
  @if (count($products) == 0)
  <p class="fs-5" style="color:red; font-style:italic;">No products found..</p>
  @endif
  @foreach ($products as $product)
  <div class="col-6 col-lg-3 col-md-4 col-sm-6 mt-3 mt-lg-0 user-products">
    <div class="card mb-3">
      <div class="card-header fs-4">
        <h5>{{ucfirst($product->title)}}</h5>
      </div>
      <img src="/uploads/product_photo/{{ $product->product_photo }}" style="height: 300px" alt="...">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Rp. {{number_format($product->price,0,',','.')}}</b></li>
        <?php $descriptions = explode("|", $product->description) ?>
        <li class="list-group-item">{{ucfirst($descriptions[0])}}..</li>
        <li class="list-group-item">
          <div class="text-end">
            <a href="/product/{{$product->id}}" style="text-decoration:none"><i class="fa fa-info-circle"></i> Detail</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
  @endforeach
</div>

@endsection