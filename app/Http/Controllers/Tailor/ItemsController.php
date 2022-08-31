<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Item::withCount('orderDetails')->paginate($this->paginate);
        return view('tailor.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemPart = config('tailor.itemPart');
        return view('tailor.items.create', compact('itemPart'));
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
            'item_name'         => 'required|string|max:20',
            'item_part'         => 'required|string',
            'price'             => 'required|numeric',
            'worker_cost'       => 'required|numeric',
            'description'       => 'nullable'
        ]);
        //Insert
        Item::create($data);
        // view
        return redirect()->back()->withSuccess('Item create successfully.');
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
        $item = Item::findOrFail($id);
        $itemPart = config('tailor.itemPart');
        // view
        return view('tailor.items.edit', compact('item', 'itemPart'));
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
        $item = Item::findOrFail($id);

        // validation
        $data = $request->validate([
            'item_name'              => 'required|string|max:20',
            'item_part'              => 'required|string',
            'price'                  => 'required|numeric',
            'worker_cost'            => 'required|numeric',
            'description'            => 'nullable'
        ]);
        // update
        $item->update($data);

        // view with message
        return redirect()->route('items.index')->with('success', 'Item has been updated successfully.');
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
        $item = Item::findOrFail($id);

        // view
        if ($item->delete()) {
            return redirect()->route('items.index')->withSuccess('Item deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
