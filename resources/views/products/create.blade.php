<x-layout>
    <div class="py-5">

        <x-card class="max-w-lg mx-auto mt-5">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create Product
                </h2>
                <p class="mb-4">Post a product to sell</p>
            </header>
            <form action="/products" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">Product Name</label>
                    <input type="text" name="name" class="border border-gray-200 rounded p-2 w-full" value="{{old('name')}}">
                    @error('name')
                        <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="category" class="text-lg mb-2">Category</label>
                    <select name="category" class="w-full border border-gray-200 rounded p-2" value="{{old('category')}}">
                        <option value="Clothing">Clothing</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Kitchen">Kitchen</option>
                        <option value="Footwear">Footwear</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6 grid grid-cols-2 gap-5">
                    <div>
                        <label for="price" class="inline-block text-lg mb-2">Price</label>
                        <input type="text" name="price" class="border border-gray-200 rounded p-2 w-full" value="{{old('price')}}">
                        @error('price')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="qty" class="inline-block text-lg mb-2">Qty</label>
                        <input type="number" name="qty" class="border border-gray-200 rounded p-2 w-full" value="{{old('qty')}}">
                        @error('qty')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <label for="logo" class="inline-block text-lg mb-2">Image</label>
                    <input type="file" name="logo" class="border border-gray-200 rounded p-2 w-full">
                    @error('logo')
                        <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="description" class="inline-block text-lg mb-2">Description</label>
                        <textarea name="description" rows="5" class="border border-gray-200 rounded p-2 w-full">{{old('description')}}</textarea>
                        @error('description')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
                </div>
                <div class="mb-3">
                    <button class="bg-black text-white rounded py-2 px-4 w-full">Create & Post</button>
                </div>
                <a href="/products/manage" class="text-black font-bold text-lg">Go back </a>
            </form>
        </x-card>
    </div>
</x-layout>