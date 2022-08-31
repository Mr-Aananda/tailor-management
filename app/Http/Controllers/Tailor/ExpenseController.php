<?php

namespace App\Http\Controllers\Tailor;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use Illuminate\Http\Request;


class ExpenseController extends Controller
{
    private $paginate = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses_query = Expense::withCount('expenseSubCategory')->with('expenseSubCategory.expenseCategory');

        if (request()->search) {

            // set date
            $date = [];

            // set date
            if (request()->form_date != null) {
                $date[] = date(request()->form_date);

                if (request()->to_date != null) {
                    $date[] = date(request()->to_date);
                } else {
                    if (request()->form_date != null) {
                        $date[] = date('Y-m-d');
                    }
                }

                if (count($date) > 0) {
                    $expenses_query = $expenses_query->whereBetween('date', $date);
                }
            }
        }

        if (request('category_name')) {
            $expenses_query->whereHas('expenseSubCategory.expenseCategory', function ($query) {
                $query->where('category_name', 'like', '%' . request('category_name') . '%');
            });
        }

        if (request('subcategory_name')) {
            $expenses_query->whereHas('expenseSubCategory', function ($query) {
                $query->where('subcategory_name', 'like', '%' . request('subcategory_name') . '%');
            });
        }

        // get data
        $categories = ExpenseCategory::orderBy('category_name')->get();
        $subcategories = ExpenseSubCategory::orderBy('subcategory_name')->get();

        $expenses = $expenses_query->paginate($this->paginate);

        return view('tailor.expense.index', compact('expenses', 'categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ExpenseCategory::all();
        $cashes = Cash::all();
        return view('tailor.expense.create', compact('categories', 'cashes'));
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
            "date" => 'required',
            "expense_category_id" => 'required',
            "expense_sub_category_id" => 'required',
            "amount" => 'required',
            'cash_id'      => 'required',
            'payment_type'      => 'required',
            "description" => 'nullable',
        ]);
        //Insert
        Expense::create($data);
        if ($request->payment_type == 'cash') {
            $cash = Cash::findOrFail($request->cash_id);
            $cash->decrement('balance', $request->amount);
        }
        // view
        return redirect()->back()->withSuccess('Expense create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return view('tailor.expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $cashes = Cash::all();
        $categories = ExpenseCategory::all();
        foreach ($categories as $key => $category) {
            $category['is_selected'] = false;
        }

        return view('tailor.expense.edit', compact('expense', 'categories','cashes'));
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
        $expense = Expense::findOrFail($id);

        // validation
        $data = $request->validate([
            "date" => 'required',
            "expense_category_id" => 'required',
            "expense_sub_category_id" => 'required',
            "amount" => 'required',
            'cash_id'      => 'required',
            'payment_type'      => 'required',
            "description" => 'nullable',
        ]);

        $amount = $request->amount ? $request->amount : 0.00;
        $previous_amount = $expense->amount;
        // update
        $expense->update($data);

        $decrement = $amount - $previous_amount;

        Cash::where('id', $request->cash_id)->decrement('balance', $decrement);

        // view with message
        return redirect()->route('expense.index')->with('success', 'Expense has been updated successfully.');
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
        $expense = Expense::findOrFail($id);

        // view
        if ($expense->delete()) {
            return redirect()->route('expense.index')->withSuccess('Expense deleted successfully.');
        } else {
            return back()->withErrors('Failed to delete item.');
        }
    }
}
