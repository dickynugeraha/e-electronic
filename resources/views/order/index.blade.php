@extends('layouts.user_view', ["title" => "Orders"])
@section("content_user")
    <h3 class="text-center mb-3">ORDERS</h3>

    @if (count($orders) === 0)
        <p class="fs-5" style="color:red; font-style:italic;">No orders yet..</p>
    @endif

    <div class="row justify-content-center">
      @foreach ($orders as $order)
        <?php $productsOrders = count($order->products); ?>
        <a href="/order/{{$order->id}}" class="d-block col-md-7 mb-3" style="text-decoration: none; color:black;">
            <div class="d-flex justify-content-between align-items-center px-5 py-2 order">
              <div>
                <p class="fs-4">{{ date_format($order->created_at,"D, d F Y"); }}</p>
                <p class="fs-5" style="color: grey; font-style:italic;">Order {{ $order->status }}</p>
              </div>
              <div>
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </div>
          </div>
        </a>
      @endforeach
    </div>
@endsection
