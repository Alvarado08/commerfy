<x-layout>
    @include('partials._carrousel')
    @include('partials._hero')
    @include('partials._category')
    <div class="p-5">
        @if(count($products) == 0)
            <p>No products found... yet</p>
        @else
        <section class="grid grid-cols-4 gap-5">
            @foreach ($products as $product)
                <x-card>
                    <img class="w-full max-w-md mx-auto rounded" src="{{$product->logo ? asset('storage/'. $product->logo) : asset('/no-logo.webp')}}" alt="product image">
                    <h3 class="text-xl font-bold mt-2">{{$product->name}}</h3>
                    <h4 class="text-lg font-semibold">Category</h4>
                    <h4>{{$product->category}}</h4>
                    <h4 class="text-lg font-semibold">Price</h4>
                    <h4><span>$</span>{{$product->price}}</h4>
                    <h4><span class="font-bold">{{$product->qty}}</span> available</h4>
                    <p>{{$product->description}}</p>
                </x-card>
            @endforeach
        </section>
        @endif
    </div>
    <div class="mt-6 p-5">
        {{$products->links()}}
    </div>
</x-layout>