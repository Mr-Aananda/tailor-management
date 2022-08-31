<x-app-layout>
    <x-slot name="title">Elements</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="container print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('elements.index') }}">All Records</a>
                </li>

            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            {{-- card start --}}
            <div class="card mb-5 border-0">
                {{-- card head --}}
                <div class="card-header p-0 border-0 d-flex">
                    <!-- page title -->
                    <div class="mt-3">
                        <h4 class="main-title">Update element</h4>
                        <p><small>The five major elements of accounting are: Assets, Liabilities, Owner's Equity, Income and Expense. These terms are used widely in accounting so it is necessary that we take a close look at each element.</small></p>
                    </div>
    
                    <!-- header icon -->
                    <a href="{{ route('elements.index') }}" title="Go back" class="pe-0 ms-auto print-none top-icon-button mb-2 mt-3">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>
                {{-- card head --}}


                <div class="card-body p-0 pt-3">
                    <form action="{{ route('elements.update', $record->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- type text -->
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="element-name" class="form-label required mt-1">Element name</label>
                            </div>
        
                            <div class="col-6">
                                <input type="text" name="name" class="form-control" id="element-name" placeholder="Characters only" value="{{ old('name', $record->name) }}" required>

                                {{-- error --}}
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="symbol" class="form-label required mt-1">Symbol</label>
                            </div>
        
                            <div class="col-4">
                                <input type="text" name="symbol" class="form-control" id="symbol" value="{{ old('symbol', $record->symbol) }}" placeholder="One capital letter" required>

                                {{-- error --}}
                                @error('symbol')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="description" class="form-label mt-1">Description</label>
                            </div>
        
                            <div class="col-8">
                                <textarea name="description" class="form-control" id="description" rows="8" placeholder="Optional">{{ old('description', $record->description) }}</textarea>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-2">
                                <label class="form-label mt-1">&nbsp;</label>
                            </div>
        
                            <div class="col-10">
                                <button type="reset" class="btn btn-warning me-2">
                                    <i class="bi bi-dash-square"></i>
                                    <span class="p-1">Reset</span>
                                </button>
        
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i>
                                    <span class="p-1">Save changes</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- card end --}}
        </div>
    </div>
</x-app-layout>