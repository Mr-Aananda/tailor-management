<x-app-layout>
    <x-slot name="title">Contact </x-slot>

    <div class="container mb-5">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('contact.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="card border-0">
            <div class="card-header p-0 border-0 d-flex mb-3">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new contact</h4>
                    <p><small>Can create <strong>Customer</strong>, <strong>Supplier</strong>, <strong>Employee</strong> & <strong>Admin</strong>. Contact also contain all kind of data like Organigation & Person detals.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('contact.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="card-body p-0 pt-3">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="organigation-name" class="mt-1 form-label required">Organigation name</label>
                        </div>

                        <div class="col-6">
                            <input type="text" name="organigation_name" value="{{ old('organigation_name') }}" class="form-control" id="organigation-name" placeholder="Characters only" autofocus required>
                            
                            <!-- error -->
                            @error('organigation_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="contact-person-name" class="mt-1 form-label required">Contact person name</label>
                        </div>

                        <div class="col-4">
                            <input type="text" name="contact_person_name" value="{{ old('contact_person_name') }}" class="form-control" id="contact-person-name" placeholder="Characters only" required>
                            
                            <!-- error -->
                            @error('contact_person_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="gender" class="mt-1 form-label required">Gender</label>
                        </div>

                        <div class="col-2">
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="" selected disabled> -- </option> 

                                @foreach ($contactGender as $gender)
                                    <option value="{{ $gender }}" {{ (old('gender') == $gender) ? 'selected' : '' }}>
                                        {{ $gender }}
                                    </option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <!-- component -->
                    <div>
                        <!-- mobile number errors -->
                        @php
                            $mobile_errors = [];

                            foreach (old('mobile_number', []) as $key => $value) {
                                $mobile_errors[] = $errors->get('mobile_number.' . $key);
                            }
                        @endphp

                        {{-- <pre>{{ print_r($mobile_errors, 1) }}</pre> --}}

                        <div id="add-phone-component" 
                            data-phones="{{ json_encode(old('mobile_number')) }}" 
                            data-errors="{{ $errors ? json_encode($mobile_errors) : '' }}"></div>
                    </div>

                    <!-- balance -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="opening-balance" class="mt-1 form-label required">Opening balance</label>
                        </div>

                        <div class="col-4">
                            <input type="number" name="opening_balance" value="{{ old('opening_balance') }}" class="form-control" id="opening-balance" step="any" placeholder="0.00" required>
                            <small>Positive(+) balance <strong>Payable</strong> and negative(-) is <strong>Receivable</strong>.</small>

                            <!-- error -->
                            @error('opening_balance')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="credit-limit" class="mt-1 form-label required">Credit limit</label>
                        </div>

                        <div class="col-4">
                            <input type="number" name="credit_limit" value="{{ old('credit_limit', 0.00) }}" class="form-control" id="credit-limit" step="any" placeholder="0.00" required>
                            
                            <!-- error -->
                            @error('credit_limit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="nid" class="mt-1 form-label required">NID</label>
                        </div>

                        <div class="col-3">
                            <input type="number" name="nid" value="{{ old('nid') }}" class="form-control" id="nid" placeholder="xxxxxxxxxxxxx" required>
                            
                            <!-- error -->
                            @error('nid')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="email" class="mt-1 form-label">Email address</label>
                        </div>

                        <div class="col-6">
                            <input type="email" name="email_address" value="{{ old('email_address') }}" class="form-control" id="email" placeholder="example@maxsop.com">
                            
                            <!-- error -->
                            @error('email_address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Present address -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="present-address" class="mt-1 form-label required">Present address</label>
                        </div>

                        <div class="col-8">
                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="text" name="present_upazila" value="{{ old('present_upazila') }}" class="form-control" placeholder="Upazila" required>

                                    <!-- error -->
                                    @error('present_upazila')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <input type="text" name="present_district" value="{{ old('present_district') }}" class="form-control" placeholder="District" required>

                                    <!-- error -->
                                    @error('present_district')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <input type="text" name="present_division" value="{{ old('present_division') }}" class="form-control" placeholder="Division" required>

                                    <!-- error -->
                                    @error('present_division')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <textarea name="present_street" class="form-control" id="present-address" rows="1" placeholder="Street, building, house no etc ..." required>{{ old('present_street') }}</textarea>
                                </div>
                            </div>

                            <!-- error -->
                            @error('present_street')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                    </div>
                    <!-- Present address end -->

                    <!-- Permanent address -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="permanent-address" class="mt-1 form-label">Permanent address</label>
                        </div>

                        <div class="col-8">
                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="text" name="permanent_upazila" value="{{ old('permanent_upazila') }}" class="form-control" placeholder="Upazila">
                                </div>

                                <div class="col-4">
                                    <input type="text" name="permanent_district" value="{{ old('permanent_district') }}" class="form-control" placeholder="District">
                                </div>

                                <div class="col-4">
                                    <input type="text" name="permanent_division" value="{{ old('permanent_division') }}" class="form-control" placeholder="Division">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <textarea name="permanent_street" class="form-control" id="permanent-address" rows="1" placeholder="Street, building, house no etc ...">{{ old('permanent_street') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Permanent address end -->

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="contact-type" class="mt-1 form-label required">Contact type</label>
                        </div>

                        <div class="col-4">
                            <select name="contact_type" class="form-control" id="contact-type" required>
                                <option value="" selected disabled> -- </option> 

                                @foreach ($contactTypes as $key => $type)
                                    <option value="{{ $key }}" {{ (old('contact_type', 'regular_customer') == $key) ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note</label>
                        </div>

                        <div class="col-8">
                            <textarea name="note" class="form-control" id="note" rows="2" placeholder="Optional">{{ old('note') }}</textarea>
                        </div>
                    </div>

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