@extends('layouts.user_view', ["title" => "$product->title"])
@section('content_user')

  <div class="d-flex flex-column">
    
    <h1 class="mb-2">{{ucfirst($product->title)}} <span style="font-size: 1.5rem; color: #5D9C59; ">(Rp. {{number_format($product->price,2,',','.')}})</span></h1>     
    <script>
      var msg = '{{Session::get('alert')}}';
      var exist = '{{Session::has('alert')}}';
      if(exist){
        alert(msg);
      }
    </script>
    <div class="container mt-2">
        <div class="row r3">
            <div class="col-md-5 p-0">
                <ul>
                  <?php $descriptions = explode("|", $product->description) ?>

                  @foreach ($descriptions as $desc)
                    <li class="mb-3">{{ucfirst($desc)}}</li>
                  @endforeach
                    
                </ul>
                <div class="text-end card p-4 mt-5">
                  <form action="/cart" method="post">
                    <div class="mb-3 text-start" style="width: 8rem">
                      <label class="form-label" for="quantity" style="color: grey; font-style: italic">Quantity</label>
                      <input onchange="quantityChange()" id="quantity" type="number" class="form-control" name="quantity">
                    </div>
                    <div class="mb-3 text-start">
                      <label class="form-label" for="quantity" style="color: grey; font-style: italic">Description Order</label>
                      <input name="description" type="text" placeholder="Contoh : pesan dengan 1 warna hitam dan 1 warna hijau" class="form-control">
                    </div>
                    <div class="mb-3 text-start">
                      <label class="form-label" for="quantity" style="color: grey; font-style: italic">Total : Rp. <span id="pricePerItem"></span></label>
                    </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="submit" class="btn btn-success btn-md" value="Add to cart" />
                  </form>
                </div>
            </div>
            <div class="col-md-7 text-center"> <img src="{{$product->image_url}}" width="60%" height="80%"> </div>
        </div>
    </div>
</div>

@endsection

@section('add_javascript')
    <script>
      function quantityChange(){
        const price = {{$product->price}};
        const quantity = document.getElementById("quantity").value;
        const pricePerItem = document.getElementById("pricePerItem");

        pricePerItem.innerText = price * quantity;
      }
     
      
    </script>
@endsection