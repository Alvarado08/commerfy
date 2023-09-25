<x-layout>
    <header class="p-5">
        <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Products</h1>
    </header>
    <a class="p-5" href="/products/create">
        <button class="bg-black py-2 px-5 rounded text-white justify-center inline-flex items-center">
        Create Product
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
        </svg>          
        </button>
    </a>
    @unless ($products->isEmpty())
    <section class="p-5 grid grid-cols-4 gap-5">
        @foreach ($products as $product)
            <x-card>
                <img class="w-full max-w-md mx-auto rounded" src="{{$product->logo ? asset('storage/'. $product->logo) : asset('/no-logo.webp')}}" alt="product image">
                <h3 class="text-xl font-bold mt-2">{{$product->name}}</h3>
                <h4 class="text-lg font-semibold">Category</h4>
                <h4>{{$product->category}}</h4>
                <h4 class="text-lg font-semibold">Price</h4>
                <h4><span>$</span>{{$product->price}}</h4>
                <h4 class="text-lg font-semibold">In Stock</h4>
                <h4>{{$product->qty}}</h4>
                <h4 class="text-lg font-semibold">About</h4>
                <p>{{$product->description}}</p>
                <div class="grid-grid-cols-2 gap-3 my-2">
                    <a href="/products/{{$product->id}}/edit"><button class="bg-blue-500 text-white py-2 px-5 rounded">Edit Product</button>
                    </a>
                    <form class="inline-block" action="/products/{{$product->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white py-2 px-5 rounded">Delete Product</button>
                    </form>
                </div>
                <h4 class="text-lg font-semibold">Created On</h4>
                <h3>{{$product->created_at}}</h3>
            </x-card>
        @endforeach
    </section>
    @else
    <section class="p-5">
        <p class="font-semibold text-lg">You haven't published any products to sell</p>
    </section>
    @endunless
</x-layout>