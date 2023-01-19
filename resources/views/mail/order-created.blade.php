<x-mail::message>
# Order Created.

Hi, {{ $order->customer->name }}!

<x-mail::panel>
    # Order #{{ $order->id }}

        | Product | Quantity | Price  |
        | ------- | -------  | ------ |
    @foreach ($order->products as $product)
    | {{ $product->product->name }}  |    {{ $product->quantity }}     |  {{ $product->quantity * $product->product->price }} |
    @endforeach
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


