<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::latest()->get();
        return view('foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('foods.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'price' => 'required|numeric|min:0',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $validated['image'] = $request->file('image')->store('foods', 'public');
    //     }

    //     Food::create($validated);

    //     return redirect()->route('foods.index')->with('success', 'Food added successfully.');
    // }
    


    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('foods', 'public');
    }

    Food::create($validated);

    return redirect()->route('foods.index')->with('success', 'Food added successfully.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $food = Food::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // delete old image if exists
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }

        $validated['image'] = $request->file('image')->store('foods', 'public');
    } else {
        // retain old image if not changed
        $validated['image'] = $food->image;
    }

    $food->update($validated);

    return redirect()->route('foods.index')->with('success', 'Food updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }

        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Food deleted successfully.');
    }






    public function menu()
{
    // Fetch the latest foods (you can change the limit)
    $foods = Food::latest()->take(8)->get();

    return view('welcome', compact('foods'));
}


public function browseCategories()
{
    $categories = Category::all();
    return view('categories', compact('categories'));
}

public function showCategory($id)
{
    $category = Category::with('foods')->findOrFail($id);
    return view('category-foods', compact('category'));
}


}
