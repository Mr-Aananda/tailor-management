<x-app-layout>
    <x-slot name="title">Worker salary </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.payroll.worker-salary.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new worker salary</h4>
                    <p><small>Can create <strong>worker salary</strong> from here.</small></p>
                </div>


                <!-- header icon -->
                   <!-- search -->
                {{-- <a href="#worker-bonus-search"
                   class="btn top-icon-button print-none mt-3  ms-auto " title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a> --}}

                <a href="{{ route('worker-salary.index') }}" title="Go back" class="mt-3 mb-2 pe-0 print-none top-icon-button ms-auto">
                    <i class="bi bi-arrow-left"></i>
                </a>

            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('worker-salary.store') }}" method="POST">
                    @csrf
                    {{-- Salary date start --}}
                     <div class="mb-3 row">
                        <div class="col-2">
                            <label for="date" class="mt-1 form-label required">Date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name="date" value="{{ old('date')}}" class="form-control" id="date" required>

                            <!-- error -->
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- Salary date end --}}

                    {{-- React components --}}
                    <!-- select worker start-->
                    <div
                        data-workers="{{ $workers }}"
                        data-cashes="{{ $cashes  }}"
                        data-worker-salary="{{ json_encode("")}}"
                        id="select-worker-show-total-payable-balance-and-deduct">
                    </div>
                    {{-- Button for bonus --}}
                    {{-- <div class="mb-3 row">
                        <div class="col-2">&nbsp;</div>
                        <div class="col-3">
                            <a href="#worker-bonus-search" class="btn btn-sm btn-success text-decoration-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false"> Add bonus</a>
                        </div>
                    </div> --}}
                     <!-- select worker end-->

                    {{-- React component --}}

                    {{-- Worker bonus start --}}
                    {{-- <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="worker-bonus-search">

                        <div data-distributions="{{$distributions}}" id="worker-bonus"></div>

                    </div> --}}

                    {{-- Worker bonus end --}}

                    <!-- Description start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note</label>
                        </div>

                        <div class="col-5">
                            <textarea name="note" class="form-control" id="note" rows="2"
                                placeholder="Optional">{{ old('note')}}</textarea>

                                <!-- error -->
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>
                    <!-- Description end-->

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
