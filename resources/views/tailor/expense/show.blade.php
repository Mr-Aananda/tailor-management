<x-app-layout>
    <x-slot name="title">Expense </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.expense.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Expense details</h4>
                        <p><small>All the details below.</small></p>
                    </div>

                    <!-- header icon -->
                    <a href="{{ route('expense.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="p-0 card-body">

                                <div class="mb-3 row">
                                        <div class="col-2">
                                            <dt for="date" class="mt-1 form-label">Date </dt>
                                        </div>

                                        <div class="col-6">
                                            <dd class="fst-italic text-muted">{{ $expense->date }}</dd>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-2">
                                            <dt for="category-name" class="mt-1 form-label">Category </dt>
                                        </div>

                                        <div class="col-6">
                                            <dd class="fst-italic text-muted">{{ $expense->expenseSubCategory->subcategory_name }}</dd>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-2">
                                            <dt for="subcategory-name" class="mt-1 form-label">Subcategory </dt>
                                        </div>

                                        <div class="col-6">
                                            <dd class="fst-italic text-muted">{{ $expense->expenseSubCategory->expenseCategory->category_name }}</dd>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-2">
                                            <dt for="amount" class="mt-1 form-label">Amount </dt>
                                        </div>

                                        <div class="col-6">
                                            <dd class="fst-italic text-muted">{{$expense->amount}}</dd>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">

                                    @if ($expense->description!==null)
                                        <div class="col-2">
                                            <dt for="description" class="mt-1 form-label">Description </dt>
                                        </div>

                                        <div class="col-6">
                                            <dd class="fst-italic text-muted">{{ $expense->description }}</dd>
                                        </div>

                                    @endif
                                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
