<h3>Order Confirmation #{{ $order->id }}</h3>

<ul>
@foreach($order->items as $item)
    <li>{{ $item->product->name }}</li>
@endforeach
</ul>
<h4>Total: {{ $order->total }}</h4>
<h4>Status: {{ $order->status }}</h4>
