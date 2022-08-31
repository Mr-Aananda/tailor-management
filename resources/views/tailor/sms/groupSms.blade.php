<x-app-layout>
    <x-slot name="title">Group SMS </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.sms.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Group SMS Send</h4>
                    <p><small>Can send <strong>Group SMS</strong> from here.</small></p>
                    <p><small>About {{ isset($customers) ? count($customers) : 0 }} results found.</small></p>
                </div>

                <!-- search -->
                <a href="#customer-search"
                   class="btn top-icon-button print-none ms-auto" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('sms.groupSms') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
            <div class="mt-2">
                <p class="mb-2 text-muted"> 1. If don't want send SMS Please Uncheck Customer.</p>
                <p class="mb-2 text-muted"> 2. Type Message  and then click Send button to Send SMS.</p>
                {{-- <div class="mt-4">
                    <strong>
                        <span>Total SMS: 500 </span> &nbsp; &nbsp;
                        <span>Send SMS: 100</span> &nbsp; &nbsp;
                        <span>Remaining SMS: 400</span>
                    </strong>
                </div> --}}
            </div>

             <!-- content body -->
            <div class="p-0 mt-4 card-body">
                 <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="student-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('sms.groupSms') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">


                                <!--search by student paid_type -->
                                {{-- <div class="col-3">
                                    <label for="approved_by" class="form-label">Paid Type</label>
                                    <select name="paid_type" class="form-control" id="approved_by">
                                        <option value selected disabled>----</option>
                                        <option value="1">Full paid</option>
                                        <option value="2">Due paid</option>
                                    </select>
                                </div> --}}
                                <!-- button -->
                                <div class="col-12 col-sm-6 col-lg-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-block w-100 custom-btn btn-success">
                                        <i class="bi bi-search"></i>
                                        <span class="p-1">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 d-block">
                    <form action="{{ route('sms.groupSms') }}" method="POST">
                        @csrf
                        <div class="mb-3 table-responsive">
                            <table class="table custom-table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="p-0">
                                            <label for="check-all" class="p-2 d-block">
                                                <input type="checkbox" class="me-2" id="check-all">
                                                <span>SL </span>
                                            </label>
                                        </th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Mobile No</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($customers as $index=> $customer)
                                        <tr>
                                            <th scope="row" class="p-0">
                                                <label class="p-2 d-block">
                                                    <input type="checkbox" name="mobiles[]" value="{{ $customer->mobile_no }}" class="me-2">
                                                        {{ $index + $customers->firstItem() }}.
                                                </label>
                                            </th>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->mobile_no}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="7">No customer here </th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                            <!-- data table end -->
                            <!-- paginate -->
                        <div class="card-footer print-none">
                            <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                                {{ (isset($customers)) ? optional($customers)->links() : '' }}
                            </nav>
                        </div>
                            <!-- pagination end -->

                        <div class="mb-3 row">
                          <!-- Write Message Start-->
                            <div class="col-12">
                                <label for="message" class="mt-1 form-label required">Message</label>
                                    <textarea name="message" class="form-control" id="message" rows="4"
                                        placeholder="Type message here.." required>{{ old('message')}}</textarea>

                                        <!-- error -->
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                            </div>
                                <!-- Write Message End-->

                                <!-- SMS & Character count start -->
                            <div class="col-md-12 mt-3">
                                <p class="text-muted">
                                    <span>
                                        <strong>Total Characters</strong>
                                            <input type="text" id="total_characters" name="total_characters" value="23" readonly>
                                    </span>
                                    &nbsp;
                                    <span>
                                        <strong>Total Messages</strong>
                                            <input  type="text" id="total_messages" value="1" name="total_messages" readonly>
                                    </span>
                                </p>
                            </div>
                            <!-- SMS & Character count end -->
                        </div>

                        <div class="mb-3 row">
                            <div class="col-2">
                                <label class="mt-1 form-label">&nbsp;</label>
                            </div>

                            <div class="col-12">
                                <button type="reset" class="btn btn-warning me-2">
                                    <i class="bi bi-dash-square"></i>
                                    <span class="p-1">Reset</span>
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-envelope"></i>
                                    <span class="p-1">Send</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- content body end -->
        </div>

    @push('script')
        <!-- checked all program script -->
        <script>
            // select master & child checkboxes
            let masterCheckbox = document.getElementById("check-all"),
                childCheckbox = document.querySelectorAll('[name="mobiles[]"]');
            // add 'change' event into master checkbox
            masterCheckbox.addEventListener("change", function() {
                // add/remove attribute into child checkbox conditionally
                for (var i = 0; i < childCheckbox.length; i++) {
                    if(this.checked) {
                        childCheckbox[i].checked = true; // add attribute
                    } else {
                        childCheckbox[i].checked = false; // add attribute
                    }
                }
            });
        </script>
        <!-- checked all program script end -->

        <!-- SMS & Character count js start -->
        <script src="{{ asset('/js/sms/sms.js') }}"></script>
        <!-- SMS & Character count js end -->
    @endpush
</x-app-layout>

