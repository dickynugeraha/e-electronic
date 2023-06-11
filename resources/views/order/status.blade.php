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
              <a href="#" class="text-decoration-none me-2">Change status</a>
              
            </td>
          </tr>
        <?php $nomor++ ?>
       
       
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