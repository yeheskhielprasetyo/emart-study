<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        $totalbanner = Banner::count();
        return view('backend.banner.index', [
            'banners' => $banners,
            'totalbanner' => $totalbanner
        ]);
    }

    public function bannerStatus(Request $request){
        if($request->mode == 'true') {
            Banner::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Banner::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update status', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
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
            'description' => 'string|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promo',
            'status' => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_content = Banner::where('slug', $slug)->count();
        if($slug_content > 0) {
            $slug .= time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        $status = Banner::create($data);
        // dd($status);
        if($status){
            return redirect()->route('banner.index')->with('success', 'Successfully created banner');
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
        $banner = Banner::find($id);
        if($banner){
            return view('backend.banner.edit', [
                'banner' => $banner
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
        $banner = Banner::find($id);
        if($banner){
            $this->validate($request, [
                'title' => 'string|required',
                'description' => 'string|nullable',
                'photo' => 'required',
                'condition' => 'nullable|in:banner,promo',
                'status' => 'nullable|in:active,inactive'
            ]);

            $data = $request->all();
            $status = $banner->fill($data)->save();
            if($status){
                return redirect()->route('banner.index')->with('success', 'Successfully updated banner');
            }else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if($banner){
            $status = $banner->delete();
            if($status){
                return redirect()->route('banner.index')->with('success', 'Banner Successfully deleted');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
