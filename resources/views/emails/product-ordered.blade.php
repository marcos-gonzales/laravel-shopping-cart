<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Order Made</title>
    <meta charset="utf-8" />
</head>
<body>
<h2>Thanks for shopping with ShopsRus {{$user->name}}</h2>
<p>We hope you are as pleased with your order as we are.</p>

<p>Order Total: ${{$order->total}}</p>
@foreach($order->products as $o)
    <div class="flex space-x-2 mt-6">
        <img src="{{$o->file_path}}" alt="{{$o->name}}" style="width: 150px;">
        <p class="font-bold text-lg">{{ $o->name }}</p>
        <p class="">${{$o->price}}</p>
    </div>
@endforeach
</body>
</html>
