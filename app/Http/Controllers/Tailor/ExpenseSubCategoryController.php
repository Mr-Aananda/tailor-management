<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use Illuminate\Http\Request;

class ExpenseSubCategoryController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = ExpenseSubCategory::withCount('expenses')->paginate($this->paginate);
        return view('tailor.expense.expense-subCategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ExpenseCategory::all();
        return view('tailor.expense.expense-subCategory.create', compact('categories'));
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
            'expense_category_id' => 'required',
            'subcategory_name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        //Insert
        ExpenseSubCategory::create($data);
        // view
        return redirect()->back()->withSuccess('Subcategory create successfully.');
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
        $subcategory = ExpenseSubCategory::findOrFail($id);
        $categories = ExpenseCategory::all();
        return view('tailor.expense.expense-subCategory.edit', compact('subcategory', 'categories'));
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
        $subcategory = ExpenseSubCategory::findOrFail($id);

        // validation
        $data = $request->validate([
            'expense_category_id' => 'required',
            'subcategory_name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        // update
        $subcategory->update($data);

        // view with message
        return redirect()->route('expense-subcategory.index')->with('success', 'Subcategory has been updated successfully.');
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
        $subcategory = ExpenseSubCategory::findOrFail($id);

        // view
        if ($subcategory->delete()) {
            return redirect()->route('expense-subcategory.index')->withSuccess('Subcategory deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }

    /**
     *
     * react component method for add subcategories by category
     *
     */

    public function getSubcategoriesById()
    {
        return ExpenseSubcategory::where('expense_category_id', '=', request()->category_id)->get();
    }
}
