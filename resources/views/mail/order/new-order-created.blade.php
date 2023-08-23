<x-mail::message>
# Order #{{ $order->id }}

# {{ $shop->name }}

## Customer

{{ $customer->name }}
[{{ $customer->email }}](mailto:{{ $customer->email }})

## Order Items

@foreach($products as $product)
- {{ $product->name }} {{ number_format($product->price / 100, 2) }} &#8381;
@endforeach

## Total {{ (number_format($order->total / 100, 2)) }} &#8381;

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
