<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        // $categories_parent = Category::where('parent_id', $categories->parent_id)->value('title')->get();
        $totalcategories = Category::count();
        return view('backend.category.index', [
            'categories' => $categories,
            'totalcategories' => $totalcategories,
            // 'categories_parent' => $categories_parent
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('backend.category.create', [
            'parent_cats' => $parent_cats
        ]);
    }

    public function categoryStatus(Request $request){
        if($request->mode == 'true') {
            Category::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Category::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update status', 'status' => true]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_content = Category::where('slug', $slug)->count();
        if($slug_content > 0) {
            $slug .= time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $status = Category::create($data);
        // dd($status);
        if($status){
            return redirect()->route('category.index')->with('success', 'Successfully created category');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
            return view('backend.category.edit', [
                'category' => $category
            ]);
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $status = $category->delete();
            if($status){
                return redirect()->route('category.index')->with('success', 'Category Successfully deleted');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
