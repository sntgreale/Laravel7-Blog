<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Category;
use App\Post;
use Session;

class CategoryController extends Controller
{
    // GET ALL CATEGORIES
    public function index()
    {
        // Display all Categories

        $categories = Category::paginate(10);

        return view('categories.index') -> withCategories($categories);
    }

    // SAVE CATEGORY
    public function store(Request $request)
    {
        // Save category
        $this->validate($request, array(
            'category_name' => 'required|max:255'
        ));

        $category = new Category;

        $category -> category_name = $request -> category_name;
        $category -> category_created_at = now();
        $category -> save();

        Session::flash('success', 'New Category has been created');

        return redirect()->route('categories.index');
    }

    // EDIT CATEGORY
    public function edit($id)
    {
        // Open form for edit category
        $category = Category::where('category_id', '=', $id) -> first();

        return view('categories.edit') -> withCategory($category);
    }

    // UPDATE CATEGORY
    public function update(Request $request, $id)
    {
        // Validate data
        $this->validate($request, array(
            'category_name' => 'required|max:255'
        ));

        // Search and update category
        $category = Category::where('category_id', '=', $id) -> update([
            'category_name' => $request -> input('category_name'),
        ]);
        
        // Set flash data with success message
        Session::flash('success', 'The blog category was successfully updated!');

        // Return to view
        return redirect() -> route('categories.index');
        

    }

    // DESTROY CATEGORY
    public function destroy($id)
    {
        // Change category to existing posts that the category to be removed
        // $posts = Post::where('post_category_id', '=', $id) -> update(['post_category_id' => null]);

        // Delete category specific
        // Category::where('category_id', '=', $id) -> delete();

        // Send message to the view
        // Session::flash('success', 'The category was successfully deleted.');
        
        // return redirect() -> route('categories.index');
    }
}
