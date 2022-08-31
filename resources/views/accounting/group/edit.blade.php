<x-app-layout>
    <x-slot name="title">Group </x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('group.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <div class="container">
            <!-- card start -->
            <div class="card mb-5 border-0">
                <!-- card head -->
                <div class="card-header p-0 border-0 d-flex mb-3">
                    <!-- page title --> 
                    <div class="mt-3">
                        <h4 class="main-title">Change group details</h4>
                        <p><small>A group is use to find <strong>Template</strong> & <strong>Journal</strong> in daily transactions.</small></p>
                    </div>
    
                    <!-- header icon -->
                    <a href="{{ route('group.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>


                <div class="card-body p-0 pt-3">
                    <form action="{{ route('group.update', $record->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- type text -->
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="group-name" class="form-label required mt-1">Group name</label>
                            </div>
        
                            <div class="col-6">
                                <input type="text" name="name" class="form-control" id="group-name" placeholder="Characters only" value="{{ old('name', $record->name) }}">

                                <!-- error -->
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-2">
                                <label for="description" class="form-label mt-1">Description</label>
                            </div>
        
                            <div class="col-8">
                                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Optional">{{ old('description', $record->description) }}</textarea>
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
            <!-- card end -->
        </div>
    </div>
</x-app-layout>