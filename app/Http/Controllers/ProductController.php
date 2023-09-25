<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // Show all products
    public function index(){
        $products = Product::latest()->paginate(2);
        return view('products.index',["products" => $products]);
    }

    // Show create form
    public function create(){
        return view('products.create');
    }

    // Store product data
    public function store(Request $request){
        // Validate form fields
        $inputFields = $request->validate([
            'name' => ['required', Rule::unique('products','name')],
            'category' => 'required',
            'price' => 'required|decimal:0,2',
            'qty' => 'required|numeric',
            'description' => 'required'
        ]);

        // Check if request has a file 
        // Store in storage/app/public/products
        // Create symlink from public dir in storage to public project dir
        // run: php artisan storage:link
        if($request->hasFile('logo')){
            $inputFields['logo'] = $request->file('logo')->store('products','public');
        }

        // Assign ownership to created product
        $inputFields['user_id'] = auth()->id();

        // Create product
        Product::create($inputFields);

        return redirect('products/manage')->with('message', 'Product created and posted succesfully');
    }

    // Edit Product Form
    public function edit(Product $product){
        // Validate current user is the owner
        if(auth()->user()->id !== $product['user_id']){
            return back();
        }
        return view('products.edit',['product'=>$product]);
    }

    // Update Product
    public function update(Request $request, Product $product){
        // Check current user is the owner
        if($product->user_id !== auth()->id()){
            abort(403, 'Unauthorized action');
        }
        // Validate form fields
        $inputFields = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|decimal:0,2',
            'qty' => 'required|numeric',
            'description' => 'required'
        ]);

        // Configure filesystems.php in config dir -> 'default' => env('FILESYSTEM_DISK', 'public'),
        // Check if request has a file 
        // Store in storage/app/public/products
        // Create symlink from public dir in storage to public project dir
        // run: php artisan storage:link
        if($request->hasFile('logo')){
            $inputFields['logo'] = $request->file('logo')->store('products','public');
        }

        $product->update($inputFields);

        return redirect('/')->with('message','Product updated succesfully');
    }

    // Manage Products
    public function manage(){
        return view('products.manage',['products'=>auth()->user()->products()->latest()->get()]);
    }

    // Delete Product
    public function destroy(Product $product){
        // Check currenr user is the owner
        if(auth()->user()->id !== $product['user_id']){
            return back();
        }
        $product->delete();
        return back()->with('message','Product deleted succesfully');
    }
}
