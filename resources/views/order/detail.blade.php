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
                    <div>Order {{$order->status}}</div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="px-4 py-3">
                    <div class="mb-3">
                        <p class="fs-4">Payment</p>
                        <div class="row">
                            @if ($order->payment_photo == null)
                            <div class="col-md-6">
                                <p class="fs-6 mb-0" style="color:grey">Make payments through the following platforms</p>
                                <ol style="color:grey">
                                    <li>Transfer bank : BCA (9234619264301) - Kale Pramono</li>
                                    <li>OVO : (084619264301) - Kale Pramono</li>
                                    <li>Gopay : (084619264301) - Kale Pramono</li>
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
                                <img src="" alt="" class="img-thumbnail mt-2" id="img-preview" width="200px">
                                {{-- <p style="color: red; font-style:italic" class="text-start">No photo, please make payment!</p> --}}
                            </div>
                            @else
                            <div class="col-12">
                                <img src="/payment_photo/{{ $order->payment_photo }}" alt="payment_photo" srcset="" style="width: 15rem">
                            </div>
                            @endif
                        </div>
                        
                       
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-4">Total Amount</p>
                        <p class="fs-5" style="color:#609966; font-style:italic">Rp. {{$order->total_amount}}</p>
                    </div>
                </div>
                <hr>
                <ul style="list-style-type:none; padding:0;">
                    @foreach ($order->products as $product)
                        <li class="row">
                            <div class="col-md-4 text-center">
                                <img style="width:8rem; height:8rem; border-radius:50%" src="{{ $product->image_url }}" alt="" srcset="">
                            </div>
                            <div class="col-md-8 px-4">
                                <p class="fs-4" style="margin-bottom: 0">{{ $product->title }}</p>
                                <?php $descriptions = explode("|", $product->description) ?>
                                <p style="color:grey" class="fs-6">{{ucfirst($descriptions[0])}}..</p>
                                <div class="d-flex justify-content-between">
                                    <p style="color:#609966; font-style:italic" class="fs-5">Rp. {{$product->price}}</p>
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