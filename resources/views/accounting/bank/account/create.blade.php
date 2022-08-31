<x-app-layout>
    <x-slot name="title">Bank Account</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bankAccount.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('bankAccount.create') }}">New Entry</a>
                </li>

               <li class="nav-item">
                    <a class="nav-link" href="{{ route('bankAccount.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create bank account</h4>
                </div>

                <!-- header icon -->
                <a href="{{ route('bankAccount.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
        </div>
        <!-- container menu end -->

         <div class="p-0 pt-3 card-body">
            <form action="{{ route ('bankAccount.store') }}" method="POST">
                @csrf

                <!-- type text -->
                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="bank-account-id" class="mt-1 form-label required">Bank name</label>
                    </div>

                    <div class="col-6">
                        @if (isset(request()->bankId))
                            <input type="text" name="bank_id" value="{{ $bank->name }}" class="form-control" readonly>
                        @else
                            <select name="bank_id" class="form-control" id="bank-account-id">
                                <option value="" selected disabled> -- </option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="account_name" class="mt-1 form-label required">Account Owner Name</label>
                    </div>

                    <div class="col-6">
                        <input type="text" name="account_name" class="form-control" id="account_name" placeholder="Characters only"
                               required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="account_number" class="mt-1 form-label required">Account Number</label>
                    </div>

                    <div class="col-6">
                        <input type="text" name="account_number" class="form-control" id="account_number" placeholder="Characters only"
                               required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="balance" class="mt-1 form-label required">Balance</label>
                    </div>

                    <div class="col-6">
                        <input type="number" name="balance" class="form-control" id="balance" placeholder="0.00" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="branch" class="mt-1 form-label required">Branch</label>
                    </div>

                    <div class="col-6">
                        <input type="text" name="branch" class="form-control" id="branch" placeholder="Characters only" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label for="note" class="mt-1 form-label">Description</label>
                    </div>

                    <div class="col-8">
                        <textarea name="note" class="form-control" id="note" rows="5" placeholder="Optional"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-2">
                        <label class="mt-1 form-label"> &nbsp;</label>
                    </div>

                    <div class="col-10">
                        <button type="reset" class="btn btn-warning me-2">
                            <i class="bi bi-dash-square"></i>
                            <span class="p-1">Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-square"></i>
                            <span class="p-1">Save</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
