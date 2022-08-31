<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::withCount('orderDetails')->paginate($this->paginate);

        return view('tailor.image.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $imagePart = config('tailor.imagePart');
        return view('tailor.image.create',compact('imagePart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $data = $request->validate([
            'image'             => 'required|mimes:jpeg,png,jpg,svg|max:2048',
            'image_part'        => 'required|string',
        ]);

        //file upload
        if ($request->hasFile('image')) {

            $data['image'] = $request->image->store('images/order_images');
        }

        //insert data
        Image::create($data);
        // view
        return redirect()->back()->withSuccess('Image upload successfully.');
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
        // get the specified resource
        $image = Image::findOrFail($id);

        $imageParts = config('tailor.imagePart');
        // view
        return view('tailor.image.edit', compact('image', 'imageParts'));
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
        // get the specified resource
        $image = Image::findOrFail($id);

        // validation
        $data = $request->validate([
            'image'             => 'required|mimes:jpeg,png,jpg,svg|max:2048',
            'image_part'        => 'required|string',
        ]);

        //file upload
        if ($request->hasFile('image')) {
            Storage::delete($image->image);

            $data['image'] = $request->image->store('images/order_images');
        }

        // update
        $image->update($data);

        // view with message
        return redirect()->route('image.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $image = Image::findOrFail($id);

        // view
        if ($image->delete()) {
            return redirect()->route('image.index')->withSuccess('Image deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete image.');
        }
    }
}
