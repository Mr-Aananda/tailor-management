<x-app-layout>
    <x-slot name="title">Worker payment Edit </x-slot>

    <div class="container">
        <!-- container menu -->
       @include('tailor.payroll.worker-salary.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old worker payment</h4>
                    <p><small>Can edit a worker payment here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('worker-salary.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('worker-salary.update',$worker_salary->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                     {{-- Salary date start --}}
                     <div class="mb-3 row">
                        <div class="col-2">
                            <label for="date" class="mt-1 form-label required">Date</label>
                        </div>

                        <div class="col-3">
                            <input type="date" name="date" value="{{ old('date',$worker_salary->date->format('Y-m-d'))}}" class="form-control" id="date" required>

                            <!-- error -->
                            @error('date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- Salary date end --}}

                    <!-- select worker start-->
                    <div
                        data-workers="{{ $workers }}"
                        data-cashes="{{ $cashes }}"
                        data-worker-salary="{{ $worker_salary }}"
                        id="select-worker-show-total-payable-balance-and-deduct">
                    </div>
                     <!-- select worker end-->

                    <!-- Description start-->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="note" class="mt-1 form-label">Note</label>
                        </div>

                        <div class="col-5">
                            <textarea name="note" class="form-control" id="note" rows="2"
                                placeholder="Optional">{{ old('note',$worker_salary->note)}}</textarea>

                                <!-- error -->
                                @error('note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                    </div>
                    <!-- Description end-->

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
                                <span class="p-1">Update</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

