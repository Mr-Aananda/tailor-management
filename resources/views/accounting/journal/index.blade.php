<x-app-layout>
    <x-slot name="title">Journal</x-slot>

    <div class="container">
        <!-- container menu -->
        <div class="print-none">
            <ul class="mt-2 nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('journal.index') }}">All Records</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.create') }}">New Entry</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('journal.trash') }}">Recycle Bin</a>
                </li>
            </ul>
        </div>
        <!-- container menu end -->

        <!-- print header -->
        <div class="pb-2 print-show print-header border-bottom">
            <div class="d-flex">
                <div>
                    <h4>MaxSOP</h4>
                    <h6>5B Green House, 27/2 Ram Babu Road, Mymensingh</h6>
                    <p class="text-small"><strong>Phone:</strong>+880 1786 494650, +880 1786 494650</p>
                </div>

                <div class="ms-auto">
                    <p>5 December, 2020</p>
                </div>
            </div>
        </div>
        <!-- print header end -->

        <!-- card start -->
        <div class="card border-0">
            <!-- card head -->
            <div class="card-header p-0 border-0 d-md-flex align-items-center d-block mb-3">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Journal</h4>
                    <p><small>About {{ count($records) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('journal.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- search -->
                <a href="#journal-search"
                   class="btn top-icon-button print-none" title="Search" data-bs-toggle="collapse" role="button" aria-expanded="false">
                    <i class="bi bi-search"></i>
                </a>

                <!-- add -->
                <a href="{{ route('journal.create') }}" class="btn top-icon-button print-none" title="Create new journal">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="card-body p-0">
                <!-- search area -->
                <div class="collapse print-none {{ request()->search ? 'show' : '' }}" id="journal-search">
                    <div class="px-0 border-0 card card-body rounded-0">
                        <!-- search form -->
                        <form action="{{ route('journal.index') }}" method="GET">
                            <input type="hidden" name="search" value="1">

                            <div class="row gy-1 gx-3">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="group-id" class="form-label">Group </label>
                                    <select name="filter[group_id]" class="form-control" id="group-id">
                                        <option value="" selected disabled> -- </option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" @isset(request()->filter['group_id']) {{ (request()->filter['group_id'] == $group->id) ? 'selected' : '' }} @endisset>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-sm-3 col-lg-2">
                                    <label for="from-date" class="form-label">From date</label>
                                    <input type="date" name="filter[from]" value="{{ request()->filter['from'] ?? '' }}" class="form-control" id="from-date"> 
                                </div>

                                <div class="col-12 col-sm-3 col-lg-2">
                                    <label for="to-date" class="form-label">To date</label>
                                    <input type="date" name="filter[to]" value="{{ request()->filter['to'] ?? '' }}" class="form-control" id="to-date">
                                </div>

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
                <div class="table-responsive mb-3">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Date</th>
                                <th scope="col">Particular</th>
                                <th scope="col" class="text-end">Debit</th>
                                <th scope="col" class="text-end">Credit</th>
                                <th scope="col">Spender</th>
                                <th scope="col">Operator</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $totalDebit = 0;
                                $totalCredit = 0;
                            @endphp

                            @forelse($records as $index => $journal)
                                <tr>
                                    <th scope="row">{{ $index + $records->firstItem() }}.</th>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $journal->entry_date)->format('d M Y') }}</td>

                                    <td title="{{ $journal->note }}">
                                        <strong class="d-block mb-2">{{ $journal->template->particular }}</strong>
                                        
                                        @foreach ($journal->journalDetails as $details) 
                                            <span class="d-flex justify-content-between ms-{{ $details->is_debit ? '3' : '5' }}">
                                                <span>{{ $details->account->name }}</span>
                                                <span>({{ $details->is_debit ? 'Dr.' : 'Cr.' }})</span>
                                            </span>
                                        @endforeach
                                    </td>

                                    <td class="text-end">
                                        <span class="d-block mb-2">&nbsp;</span>

                                        <span>
                                            @foreach ($journal->journalDetails as $details)
                                                @if ($details->is_debit)
                                                    <span class="d-block">{{ number_format($details->amount, 2) }}</span>

                                                    @php
                                                        $totalDebit += $details->amount;
                                                    @endphp
                                                @else
                                                    <span class="d-block"> - </span>
                                                @endif
                                            @endforeach
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <span class="d-block mb-2">&nbsp;</span>

                                        <span>
                                            @foreach ($journal->journalDetails as $details)
                                                @if ($details->is_credit)
                                                    <span class="d-block">{{ number_format($details->amount, 2) }}</span>

                                                    @php
                                                        $totalCredit += $details->amount;
                                                    @endphp
                                                @else
                                                    <span class="d-block"> - </span>
                                                @endif
                                            @endforeach
                                        </span>
                                    </td>

                                    <td>{{ $journal->contact->contact_person_name }}</td>
                                    <td>{{ $journal->user->name }}</td>

                                    <td class="print-none text-end">
                                        <a href="{{ route('journal.show', $journal->id) }}" class="btn table-small-button" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('journal.edit', $journal->id) }}" class="btn table-small-button" title="Update">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('journal-delete-{{ $journal->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('journal.destroy', $journal->id) }}" method="post" class="d-none" id="journal-delete-{{ $journal->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <th colspan="8">Journal is empty.</th>
                            </tr>
                            @endforelse

                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th class="text-end">{{ number_format($totalDebit, 2) }}</th>
                                <th class="text-end">{{ number_format($totalCredit, 2) }}</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="card-footer print-none mb-5">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ $records->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->

        
    </div>
</x-app-layout>