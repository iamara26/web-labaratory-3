<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    // Start the query with the Product model
    $query = Product::query();

    // Handle search input
    if ($request->has('search')) {
        $query->where('product_name', 'LIKE', '%' . $request->search . '%');
    }

    // Handle category filter
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    // Fetch products with optional category list
    $products = $query->with('category')->paginate(10); // Adjust pagination as needed
    $categories = Category::all(); // Get all categories for filtering

    return view('admin.products.index', compact('products', 'categories'));
}


    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve all categories for the form
        $categories = Category::all();

        // Return the 'create' view with the list of categories
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|min:3|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Validate category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            // Generate a unique name for the image
            $imageName = time() . '.' . $request->image->extension();
            // Move the image to the 'images' directory
            $request->image->move(public_path('images'), $imageName);
            // Add the image name to the validated data
            $validatedData['image'] = $imageName;
        }

        // Ensure description is not null
        if (!isset($validatedData['description'])) {
            $validatedData['description'] = '';
        }

        // Create a new product record with category_id
        Product::create($validatedData);

        // Redirect to the products index page with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        // Retrieve all categories for the form
        $categories = Category::all();

        // Return the 'edit' view with the product and categories data
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|min:3|max:255|unique:products,product_name,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id', // Validate category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            // Generate a unique name for the new image
            $imageName = time() . '.' . $request->image->extension();
            // Move the new image to the 'images' directory
            $request->image->move(public_path('images'), $imageName);
            // Add the new image name to the validated data
            $validatedData['image'] = $imageName;

            // Delete the old image if it exists
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
        }

        // Ensure description is not null
        if (!isset($validatedData['description'])) {
            $validatedData['description'] = '';
        }

        // Update the existing product record with the validated data
        $product->update($validatedData);

        // Redirect to the products index page with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        // Delete the image if it exists
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        // Delete the product record from the database
        $product->delete();

        // Redirect to the products index page with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
