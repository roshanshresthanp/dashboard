<x-mail::message>
# Order Shipped

{{$message}}

{{-- <x-mail::button :url="$url">
View Order
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
