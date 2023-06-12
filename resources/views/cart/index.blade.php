@extends('layouts.user_view', ["title" => "Keranjang"])
@section("content_user")
    <div class="row">
        <div class="card col-md-8" style="padding: 0;">
            <script>
                var msg = '{{Session::get('alert')}}';
                var exist = '{{Session::has('alert')}}';
                if(exist){
                  alert(msg);
                }
              </script>
            <?php $totalAmount = 0; ?>
            <div class="card-header">
                <h5>YOUR CART ({{ count($cart_items) > 0 ? count($cart_items) : ""}})</h5>
            </div>
            <div style="max-height:24rem; overflow-x: hidden;">
            @foreach ($cart_items as $product)
                <div class="card-body row py-3">
                    <div class="col-lg-2 text-center">
                        <img src="/uploads/product_photo/{{$product->product_photo}}" style="width: 8rem; height: 8rem; border-radius: 10%;" alt="" srcset="">
                    </div>
                    <div class="col-lg-7 ps-lg-5 pt-3 pt-lg-0">
                        <p class="mb-1"><b>Title: </b> {{$product->title}}</p>
                        <p class="mb-1"><b>Price: </b> Rp. {{number_format($product->price,0,',','.')}}</p>
                        <p class="mb-1"><b>Qty: </b> {{$product->pivot->quantity}} pcs</p>
                        <p class="mb-4"><b>Description: </b> {{$product->pivot->description}}</p>
                        <div class="d-flex justify-content-start">
                            <div class="me-3">
                                <a href="/cart/{{$product->id}}/delete" style="text-decoration:none"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                            <div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$product->id}}" style="text-decoration:none"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-lg-end pt-3 pt-lg-0" style="font-size: 1.3rem;color: #609966; font-weight: bold; font-style: italic">Rp. {{$product->pivot->price_per_item}}</div>
                </div>
                <?php $totalAmount += $product->pivot->price_per_item ?>
                <hr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cart Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/cart/update" method="post">
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{$product->pivot->quantity}}">
                                </div>
                                <div class="mb-2">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" value="{{$product->pivot->description}}">
                                </div>
                                <input type="hidden" name="price" value="{{$product->price}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="d-flex justify-content-between p-3">
                <h5>Total Amount</h5>
                <h5 style="font-size: 1.3rem;color: #609966; font-weight: bold; font-style: italic">Rp. {{number_format($totalAmount,0,',','.')}}</h5>
            </div>
        </div>
       
        <div class="col-md-4 pt-4 pt-md-0 px-2">
            <div class="card">
                <div class="card-header"><h5>ORDER</h5></div>
                <div class="card-body">
                    <form action="/order" method="post">
                        
                        <div class="mb-2">
                            <label for="shipping" class="form-label" style="color: grey; font-style: italic">Shipping to</label>
                            <select name="shipping" id="shipping" class="form-select" aria-label="Default select">
                                <option selected>Choose one</option>
                                @foreach ($shippings as $shipping)
                                    <option value="{{$shipping->id}}">{{$shipping->area}} (Rp. {{$shipping->price}}) - {{$shipping->estimated_arrival}} days</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="payment_method" class="form-label" style="color: grey; font-style: italic">Payment Method</label>
                            <select name="payment_method" id="pament_method" class="form-select" aria-label="Default select">
                                <option selected>Choose one</option>
                                <option value="transfer_bank">Transfer Bank</option>
                                <option value="ovo">OVO</option>
                                <option value="gopay">Gopay</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="total_amount" class="form-label" style="color: grey; font-style: italic">Total Amount</label>
                            <input type="text" id="total_amount" class="form-control" name="total_amount" readonly value="{{$totalAmount}}">
                        </div>
                        @if (count($cart_items) > 0)
                            <div class="mb-2">
                                <button class="btn btn-md btn-success" type="submit" style="width:100%">Order</button>
                            </div>
                            @else
                            <p style="color: red; font-style: italic">Cannot order.. please add product to cart</p>

                        @endif
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    
@endsection
@section('add_javascript')
<script>
    const shipping = document.getElementById("shipping");
    const totalAmount = document.getElementById("total_amount");
    let isShippingChange = false;

    shipping.addEventListener("change", function(evt){
        if (!isShippingChange){
            totalAmount.value += " + shipping cost";
            isShippingChange = true;
        }

    });
</script>
@endsection