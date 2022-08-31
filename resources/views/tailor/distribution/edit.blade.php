<x-app-layout>
    <x-slot name="title">Distribution Edit </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.fitting.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit old distribution</h4>
                    <p><small>Can edit distribution here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('distribution.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 pt-3 card-body">
                <form action="{{ route('distribution.update',$distribution->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <!-- type text -->
                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="date" class="mt-1 form-label required">Date</label>
                        </div>

                        <div class="col-5">
                             <input type="date" name='distribute_date' value="{{ $distribution->distribute_date->format('Y-m-d')}}" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <label for="worker" class="mt-1 form-label">Worker name</label>
                        </div>

                        <div class="col-5">
                            <select name="worker_id" class="form-control" id="worker-id" required>
                                <option value="" selected disabled>--</option>
                                @foreach ($workers as $worker)
                                    <option value="{{ $worker->id }}" {{ (old('worker_id',$distribution->worker_id ) == $worker->id) ? 'selected' : '' }}>
                                        {{ $worker->worker_name }}
                                    </option>
                                @endforeach
                            </select>
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
                                <span class="p-1">Update</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
