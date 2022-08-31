<x-app-layout>
    <x-slot name="title">Account</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accounts.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('accounts.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('accounts.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="card border-0">
            <div class="card-header p-0 border-0 d-flex mb-3">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new account</h4>
                    <p><small>A ledger account contains a record of business transactions. It is a separate record within the general ledger that is assigned to a specific asset, liability, equity item, revenue type, or expense type.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('accounts.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="card-body p-0 pt-3">
                <form action="{{ route('accounts.store') }}" method="POST">
                    @csrf

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="account-name" class="mt-1 form-label required">Account name</label>
                        </div>

                        <div class="col-6">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="account-name" placeholder="Characters only" required autofocus>
                            
                            {{-- error --}}
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="account-element" class="mt-1 form-label required">Element ID</label>
                        </div>

                        <div class="col-4">
                            <select name="element_id" class="form-control" id="account-element" required>
                                <option value="" selected disabled>---</option>
                                @foreach($elements as $element)
                                    <option value="{{ $element->id }}" {{ (old('element_id') == $element->id) ? 'selected' : '' }}>{{ $element->name }}</option>
                                @endforeach
                            </select>

                            {{-- error --}}
                            @error('element_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-8">
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Optional">{{ old('description') }}</textarea>
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