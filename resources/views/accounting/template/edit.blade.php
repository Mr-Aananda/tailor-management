<x-app-layout>
    <x-slot name="title">Template </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('template.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('template.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('template.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="card border-0">
            <div class="card-header p-0 border-0 d-flex mb-3">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Template Update </h4>
                    <p><small>Template can handle daily transaction. It contain <strong>Debit</strong>, <strong>Credit</strong> and <strong>Party</strong> transaction. You can update (Add or Remove) all the accounts from the form bellow.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('template.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="card-body p-0 pt-3">
                <form action="{{ route('template.update', $record->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="particular" class="mt-1 form-label required">Particular </label>
                        </div>

                        <div class="col-6">
                            <input type="text" name="particular" value="{{ old('particular', $record->particular) }}" class="form-control" id="particular" placeholder="Characters only" required>
                            
                            <!-- error -->
                            @error('particular')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="group-id" class="mt-1 form-label required">Group ID</label>
                        </div>

                        <div class="col-4">
                            <select name="group_id" class="form-control" id="group-id" required>
                                <option value="" selected disabled>---</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ (old('group_id', $record->group_id) == $group->id) ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- error -->
                            @error('group_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Template component -->
                    <div id="template-edit-component" data-accounts="{{ $accounts }}" data-details="{{ json_encode($details) }}"></div>

                    <!-- depreciation -->
                    <div class="row mb-3">
                        <div class="col-2">
                            <label class="form-label required mt-1">Will depreciation applied?</label>
                        </div>
            
                        <div class="col-6">
                            <label for="depreciation-yes" class="me-3">
                                <input type="radio" name="is_depreciable" value="1" class="form-check-input" id="depreciation-yes" {{ ($record->is_depreciable == 1) ? 'checked' : '' }} required>
                                <span>Yes</span>
                            </label>
            
                            <label for="depreciation-no">
                                <input type="radio" name="is_depreciable" value="0" class="form-check-input" id="depreciation-no" {{ ($record->is_depreciable == 0) ? 'checked' : '' }} required>
                                <span>No</span>
                            </label>

                            <!-- error -->
                            @error('is_depreciable')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="description" class="mt-1 form-label">Description</label>
                        </div>

                        <div class="col-8">
                            <textarea name="description" class="form-control" id="description" rows="5" placeholder="Optional">{{ old('description', $record->description) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label class="mt-1 form-label">&nbsp;</label>
                        </div>

                        <div class="col-10">
                            <span class="d-block text-muted mb-2">
                                Please, do not click the button bellow without changes.
                            </span>

                            <button type="reset" class="btn btn-warning me-2">
                                <i class="bi bi-dash-square"></i>
                                <span class="p-1">Reset</span>
                            </button>

                            <button type="submit" class="btn btn-primary" onClick="this.disabled=true;this.form.submit();">
                                <i class="bi bi-plus-square"></i>
                                <span class="p-1">Save changes</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>