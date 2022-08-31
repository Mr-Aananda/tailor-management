<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::withCount('distributions')->with('distributions.orderDetails.item')->paginate($this->paginate);
        return view('tailor.worker.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('tailor.worker.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        //Validation
        $data = $request->validate([
            'worker_name'         => 'required|string',
            'item_id'             => 'required',
            'mobile_no'         => 'required',
            'balance'             => 'nullable|min:0',
            'address'       => 'nullable',
            'discription'       => 'nullable'
        ]);

        if ($request->balance_status) {
            $data['balance'] = $request->balance ?? 0;
        } else {
            $data['balance'] = -1 * $request->balance ?? 0;
        }

        //Insert
        $worker= Worker::create($data);


        $pivot_data = [];

        foreach ($request->item_id as $id) {
            $item = Item::find($id);

            $pivot_data[$id] = [
                'worker_cost' => $item->worker_cost,
            ];
        }

        $worker->items()->sync($pivot_data);

        // view
        return redirect()->back()->withSuccess('Worker create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the specified resource
         $worker = Worker::findOrFail($id);

        // view
        return view('tailor.worker.show', compact('worker'));
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
        $worker = Worker::with('items')->findOrFail($id);
        $items = Item::all();
        // view
        return view('tailor.worker.edit', compact('worker', 'items'));
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
        // return $request->all();
        // get the specified resource
        $worker = Worker::findOrFail($id);

        // validation
        $data = $request->validate([
            'worker_name'         => 'required|string',
            'item_id'             => 'required',
            'mobile_no'           => 'required',
            'balance'             => 'nullable|min:0',
            'address'             => 'nullable',
            'description'         => 'nullable'
        ]);

        if ($request->balance_status) {
            $data['balance'] = $request->balance ?? 0;
        } else {
            $data['balance'] = -1 * $request->balance ?? 0;
        }

        // update
       $worker->update($data);


        $pivot_data = [];

        foreach ($request->item_id as $id) {
            $item = Item::find($id);
            $worker->items()->detach($id);

            $pivot_data[$id] = [
                'worker_cost' => $item->worker_cost,
            ];
        }

        $worker->items()->sync($pivot_data);

        // view with message
        return redirect()->route('worker.index')->with('success', 'Worker has been updated successfully.');
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
        $worker = Worker::findOrFail($id);

        // view
        if ($worker->delete()) {
            return redirect()->route('worker.index')->withSuccess('Worker deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    /**
     *
     * React component method for get all worker cost to addsubcategories
     *
     */
    public function getAllWorkerCost()
    {
        return Item::where('id', '=', request()->item_id)->get();
    }

}
