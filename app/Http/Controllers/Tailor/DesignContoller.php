<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Item;
use Illuminate\Http\Request;

class DesignContoller extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $designs_query = Design::withCount("orderDetails")->with('items');

        if (request('design_name')) {
            $designs_query->where('design_name', 'like', '%' . request('design_name') . '%');
        }
         $designs = $designs_query->paginate($this->paginate);
        return view('tailor.design.index', compact('designs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items =Item::all();
        return view('tailor.design.create',compact('items'));
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
            'design_name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        //Insert
        $design = Design::create($data);
        $design->items()->sync($request->item_id);
        // view
        return redirect()->back()->withSuccess('Design create successfully.');
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
        $design = Design::with('items')->findOrFail($id);
        $items = Item::all();
        // view
        return view('tailor.design.edit', compact('design','items'));
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
        $design = Design::findOrFail($id);

        // validation
        $data = $request->validate([
            'design_name'              => 'required|string',
            'description'            => 'nullable'
        ]);
        // return $request->all();

        // $selected_item_ids = [];

        // foreach ($request->item_id as $item) {
        //     array_push($selected_item_ids, $item['id']);
        // }
        // update
        $design->update($data);
        $design->items()->sync($request->item_id);

        // view with message
        return redirect()->route('design.index')->with('success', 'Design has been updated successfully.');
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
        $design = Design::findOrFail($id);

        // view
        if ($design->delete()) {
            return redirect()->route('design.index')->withSuccess('Design deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    /**
     *
     * react component method for add design by item
     *
     */

    public function getDesignByItemId(Request $request)
    {
        return Item::query()
        ->with('designs')
        ->findOrFail($request->item_id)
        ->designs;
    }
}
