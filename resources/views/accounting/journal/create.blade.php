<x-app-layout>
    <x-slot name="title">Journal </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('journal.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="card border-0">
            <div class="card-header p-0 border-0 d-flex mb-3">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new transaction</h4>
                    <p><small>An accounting journal is a detailed account of all the financial transactions of a business. It’s also known as the book of original entry as it’s the first place where transactions are recorded. The entries in an accounting journal are used to create the general ledger which is then used to create the financial statements of a business.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('journal.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="card-body p-0 pt-3">
                <form action="{{ route('journal.store') }}" method="POST">
                    @csrf

                    <!-- date start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="entry-date" class="mt-1 form-label required">Entry date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" id="entry-date" class="form-control" required>
                            
                            <!-- error -->
                            @error('entry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- date end -->

                    <!-- component -->
                    <div>
                        <!-- mobile number errors -->
                        @php
                            $old_data = [
                                'group_id' => old('group_id'),
                                'template_id' => old('template_id'),
                                'debit_amount' => old('debit_amount', ''),
                                'credit_amount' => old('credit_amount', ''),
                                'depreciationYear' => old('depreciationYear', ''),
                                'depreciationAmount' => old('depreciationAmount', ''),
                            ];

                            $all_errors = [];

                            // number errors
                            if ($errors->has('group_id')) {
                                $all_errors['group_id'] = $errors->get('group_id');
                            }

                            if ($errors->has('template_id')) {
                                $all_errors['template_id'] = $errors->get('template_id');
                            }

                            foreach (old('debit_amount', []) as $key => $value) {
                                $all_errors['debit_amount'][] = $errors->get('debit_amount.' . $key);
                            }

                            foreach (old('credit_amount', []) as $key => $value) {
                                $all_errors['credit_amount'][] = $errors->get('credit_amount.' . $key);
                            }
                        @endphp

                        <div id="journal-create-component" 
                            data-groups="{{ $groups }}"
                            data-olddata="{{ json_encode($old_data) }}"
                            data-errors="{{ json_encode($all_errors) }}"></div> 
                    </div>

                    <!-- spender start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="spender" class="mt-1 form-label required">Spender</label>
                        </div>

                        <div class="col-3">
                            <select name="contact_id" id="spender" class="form-select" required>
                                <option value="" selected disabled>Choose One</option>

                                @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}" {{ (old('contact_id') == $contact->id) ? 'selected' : '' }}>
                                        {{ $contact->contact_person_name}}
                                    </option>
                                @endforeach
                            </select>

                            <!-- error -->
                            @error('contact_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- spender end -->

                    <!-- note start -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note </label>
                        </div>

                        <div class="col-6">
                            <textarea name="note" class="form-control" id="note" rows="3" placeholder="Optional">{{ old('note') }}</textarea>
                        </div>
                    </div>
                    <!-- note end -->

                    <!-- submit form -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label class="mt-1 form-label">&nbsp;</label>
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
    </div>
</x-app-layout>