@extends('layouts.admin_view', ["title" => "Detail Order"])
@section("content_admin")
<h3 class="text-center my-3 text-uppercase">Detail Order</h3>

     <!-- Detail Order -->
     <div class="row justify-content-center">
      <div class="card px-0 mb-5 col-lg-9" >
        <div class="card-header"><h5>Order in {{str_replace("_"," ", $order->status);}}</h5></div>
      <div class="card-body">
        <div class="row" >
          <div class="col-lg-3">
            <div class="mb-3">
                <label for="quantity" class="form-label d-block">Payment Photo</label>
                @if ($order->payment_photo === null)
                    <p class="fs-6" style="font-style: italic; color:red;">Not yet made payment</p>
                @else
                    <img width="150px" src="/uploads/payment_photo/{{$order->payment_photo}}" alt="" srcset="">
                @endif
            </div>
            <div class="mb-2">
              <label for="quantity" class="form-label d-block">Total Amount</label>
              <p class="fs-6">Rp. {{number_format($order->total_amount,0,',','.')}}</p>
            </div>
          </div>
          <div class="col-lg-9 overflow-auto" style="height: 25rem">
            <label for="products" class="form-label d-block">Order products</label>
            @foreach ($order->products as $product)
              <div class="mb-1">
                <div class="row">
                  <div class="me-3 col-3">
                    <img width="100px" style="border-radius:20%" src="/uploads/product_photo/{{$product->product_photo}}" alt="" srcset="">
                  </div>
                  <div class="col-6">
                    <p class="fs-4 mb-1">{{$product->title}} <span class="fst-italic" style="color: grey; font-size:1rem;"> ( x{{$product->pivot->quantity}})</span></p>
                    <ul class="m-0">
                      <li>
                        <div class="row mb-2">
                          <div class="col-md-5">Description</div>
                          <div class="col-md-7 ps-0">{{$product->pivot->description}}</div>
                        </div>
                      </li>
                      <li>
                        <div class="row">
                          <div class="col-md-5">Price per item</div>
                          <div class="col-md-7 ps-0">Rp. {{number_format($product->pivot->price_per_item,0,',','.')}}</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <hr>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('add_javascript')
<script>
  $(document).ready(function () {
      $('#dataStatus').DataTable();
      $("#detailButton").click(function(){
        $("#detailOrder").toggle("slow");
      });
  });
</script>
@endsection