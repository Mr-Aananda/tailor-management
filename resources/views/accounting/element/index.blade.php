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
    
            <!-- card head -->
            <div class="border-0 card">
                <div class="p-0 border-0 card-header d-md-flex align-items-center d-block">
                    <!-- page title -->
                    <div class="mt-3 mb-2">
                        <h4 class="main-title">Elements </h4>
                        <p><small>Total {{ count($records) }} elements.</small></p>
                    </div>
    
                    <!-- Print -->
                    <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                        <i class="bi bi-printer"></i>
                    </a>

                    <!-- refresh -->
                    <a href="{{ route('elements.index') }}" class="btn top-icon-button print-none" title="Refresh">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
    
                <!-- content body -->
                <div class="p-0 card-body">
                    <!-- search collapse -->
                    <div class="collapse print-none" id="element-search">
                        <div class="px-0 border-0 card card-body rounded-0">
                            <!-- search form -->
                            <form action="#">
                                <div class="row gy-1 gx-3">
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <label for="element-name" class="form-label">Element name</label>
                                        <input type="text" name="element_name" class="form-control" id="element-name" placeholder="Characters only">
                                    </div>
    
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <label for="symbol" class="form-label">Symbol</label>
                                        <input type="text" name="symbol" class="form-control" id="symbol" placeholder="Capital letter">
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
    
                    <!-- data -->
                    <div class="table-responsive">
                        <table class="table custom-table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Element</th>
                                    <th scope="col">Symbol</th>
                                    <th scope="col" class="print-none text-end">Action</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @forelse($records as $element)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}.</th>
                                        <td data-toggle="tooltip" data-placement="top" title="{{$element->description}}">{{ $element->name }}</td>
                                        <td>{{ $element->symbol }}</td>
                                        <td class="print-none text-end">
                                            <a href="{{ route('elements.show', $element->id) }}" class="btn table-small-button" title="View"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('elements.edit', $element->id) }}" class="btn table-small-button" title="Update"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="4">No record exists.</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- card head end -->
        </div>
    </div>
</x-app-layout>