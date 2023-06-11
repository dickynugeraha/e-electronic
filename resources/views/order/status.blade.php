@extends('layouts.admin_view', ["title" => "Orders"])
@section("content_admin")
<h3 class="text-center my-3 text-uppercase">orders {{str_replace("_"," ", $status);}}</h3>

 <script>
  let msg = '{{Session::get('alert')}}';
  let exist = '{{Session::has('alert')}}';

  if (exist){
    alert(msg);
  }
 </script>
 
<div class="row">
    <table id="dataStatus" class="table table-hover" >
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Products</th>
          <th>Total Amount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php $nomor = 1; ?>
      <tbody>
        @foreach ($orders as $order)
        <?php 
        $totalQuantity = 0;
        ?>
        @foreach ($order->products as $product)
            <?php $totalQuantity += $product->pivot->quantity; ?>
        @endforeach
          <tr>
            <td>{{$nomor}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->user->email}}</td>
            <td>{{$order->user->address}}</td>
            <td>{{count($order->products)}} item ({{$totalQuantity}} pcs)</td>
            <td>Rp. {{number_format($order->total_amount,0,',','.')}}</td>
            <td>
              <a href="/order/{{$order->id}}/{{$order->user_id}}"  class="text-decoration-none me-2">Detail</a>
              <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$order->id}}" href="#" class="text-decoration-none me-2">Change status</a>
              
            </td>
          </tr>
        <?php $nomor++ ?>
          {{-- Modal --}}
          <div class="modal fade" id="exampleModal{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change status order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/order/update-status" method="post">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                              <option value="required_payment">Required Payment</option>
                              <option value="checking">Checking</option>
                              <option value="process">Process</option>
                              <option value="on_shipping">On Shipping</option>
                              <option value="success">Success</option>
                              <option value="cancel">Cancel</option>
                            </select>
                        </div>
                        <input type="hidden" name="order_id" value="{{$order->id}}">
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
      </tbody>
    </table>

   
</div>

@endsection

@section('add_javascript')
<script>
  $(document).ready(function () {
      $('#dataStatus').DataTable();
  });
</script>
@endsection