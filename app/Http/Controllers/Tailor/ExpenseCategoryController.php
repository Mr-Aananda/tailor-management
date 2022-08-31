<?php

namespace App\Http\Controllers\tailor;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::withCount('expenseSubcategories')->paginate($this->paginate);
        return view('tailor.expense.expense-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tailor.expense.expense-category.create');
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
            'category_name'         => 'required|string',
            'description'       => 'nullable'
        ]);
        //Insert
        ExpenseCategory::create($data);
        // view
        return redirect()->back()->withSuccess('Category create successfully.');
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
        $category = ExpenseCategory::findOrFail($id);
        return view('tailor.expense.expense-category.edit', compact('category'));
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
        $category = ExpenseCategory::findOrFail($id);

        // validation
        $data = $request->validate([
            'category_name'              => 'required|string',
            'description'            => 'nullable'
        ]);
        // update
        $category->update($data);

        // view with message
        return redirect()->route('expense-category.index')->with('success', 'Category has been updated successfully.');
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
        $category = ExpenseCategory::findOrFail($id);

        // view
        if ($category->delete()) {
            return redirect()->route('expense-category.index')->withSuccess('Category deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
