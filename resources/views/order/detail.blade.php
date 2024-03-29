@extends('layouts.user_view', ["title" => "Detail Order"])
@section("content_user")
    <div class="row justify-content-center">
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
              alert(msg);
            }
        </script>
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5>DETAIL ORDER</h5>
                    <div>Order {{str_replace("_"," ", $order->status);}}</div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="px-4 py-3">
                    <div class="mb-3">
                        <p class="fs-4">Payment</p>
                        <div class="row">
                            @if ($order->payment_photo == null || $order->status == "required_payment")
                            <div class="col-md-6">
                                <p class="fs-6 mb-0" style="color:grey">Make payments through the following platforms</p>
                                <ol style="color:grey">
                                    <li>Transfer bank : BCA (9234619264301) - Fakhri Aqil Hidayat</li>
                                    <li>OVO : (084619264301) - Fakhri Aqil Hidayat</li>
                                    <li>Gopay : (084619264301) - Fakhri Aqil Hidayat</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <form action="/order/upload_foto_payment" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="payment_photo" class="form-label">Upload proof of transfer</label>
                                        <div class="d-flex">
                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                            <input onchange="previewImg()" type="file" name="payment_photo" id="payment_photo" class="form-control form-control-sm">
                                            <button type="submit" class="ms-2 btn btn-sm btn-primary">Upload</button>
                                        </div>
                                        @error('payment_photo')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </form>
                                <img class="rounded" src="" alt="" class="img-thumbnail mt-2" id="img-preview" width="200px">
                                {{-- <p style="color: red; font-style:italic" class="text-start">No photo, please make payment!</p> --}}
                            </div>
                            @else
                                @if ($order->status != "cancel" )
                                    <div class="col-12 text-center">
                                        <img class="rounded" src="/uploads/payment_photo/{{ $order->payment_photo }}" alt="payment_photo" srcset="" style="width: 12rem">
                                    </div>
                                @else
                                    <p class="fst-italic fs-5 text-left" style="color:red">Order canceled!</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-4">Total Amount</p>
                        <p class="fs-5" style="color:#609966; font-style:italic">Rp. {{number_format($order->total_amount,0,',','.')}}</p>
                    </div>
                </div>
                <hr>
                <ul style="list-style-type:none; padding:0; height: 400px; overflow-y:scroll; overflow-x:hidden;">
                    @foreach ($order->products as $product)
                        <li class="row">
                            <div class="col-md-4 text-center">
                                <img style="width:8rem; height:8rem;" class="rounded" src="/uploads/product_photo/{{ $product->product_photo }}" alt="" srcset="">
                            </div>
                            <div class="col-md-8 px-4">
                                <p class="fs-4" style="margin-bottom: 0">{{ $product->title }}</p>
                                <?php $descriptions = explode("|", $product->description) ?>
                                <p style="color:grey" class="fs-6">{{ucfirst($descriptions[0])}}..</p>
                                <div class="d-flex justify-content-between">
                                    <p style="color:#609966; font-style:italic" class="fs-5">Rp. {{number_format($product->price,0,',','.')}}</p>
                                    <p class="fs-5" style="color:grey">x {{ $product->pivot->quantity }}</p>
                                </div>
                            </li>
                        </li>
                        <hr>
                        {{-- <li>{{ $order->pivot->quantity }}</li> --}}
                    @endforeach
                </ul>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('add_javascript')
<script>
    function previewImg() {
    const gambar = document.querySelector('#payment_photo');
    const imgPreview = document.querySelector('#img-preview');

    const fileGambar = new FileReader();
    fileGambar.readAsDataURL(gambar.files[0]);

    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}
</script>
@endsection