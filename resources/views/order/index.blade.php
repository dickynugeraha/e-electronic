@extends('layouts.user_view', ["title" => "Orders"])
@section("content_user")
    <h3 class="text-center mb-3">ORDERS</h3>
    <div class="row justify-content-center mb-2">
      <div class="col-md-8">
        <div class="dropdown ms-auto mr-0 mb-3">
          <form action="" class="d-flex align-items-center">
            <div class="me-3">
              <label for="status">Show status by:</label>
            </div>
            <div>
              <select id="status" class="form-select" name="status">
                <option value="all">All</option>
                <option value="required_payment">Required Payment</option>
                <option value="checking">Checking</option>
                <option value="process">Process</option>
                <option value="on_shipping">On Shipping</option>
                <option value="success ">Success</option>
                <option value="cancel ">Cancel</option>
              
              </select>
            </div>
            <button type="submit" class="btn btn-sm btn-secondary ms-3">Filter</button>
          </form>
        </div>
      </div>
    </div>

    @if (count($orders) === 0)
        <p class="fs-5" style="color:red; font-style:italic;">No orders yet..</p>
    @endif

    <div class="row justify-content-center">
      @foreach ($orders as $order)
        <?php $productsOrders = count($order->products); ?>
        <a href="/order/{{$order->id}}" class="d-block col-md-8 mb-3" style="text-decoration: none; color:black;">
            <div class="d-flex justify-content-between align-items-center px-5 py-2 order">
              <div>
                <p class="fs-4">{{ date_format($order->created_at,"D, d F Y"); }}</p>
                <p class="fs-5" style="color: grey; font-style:italic;">Order {{str_replace("_"," ", $order->status);}}</p>
              </div>
              <div>
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </div>
          </div>
        </a>
      @endforeach
    </div>
@endsection
