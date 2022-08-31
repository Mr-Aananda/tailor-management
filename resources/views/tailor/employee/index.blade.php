<x-app-layout>
    <x-slot name="title">Employees </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.employee.menu')
        <!-- container menu end -->

        <!-- print header -->
        @include('layouts.partials.printHead')
        <!-- print header end -->

        <!-- card start -->
        <div class="border-0 card">
            <!-- card head -->
            <div class="p-0 mb-3 border-0 card-header d-md-flex align-items-center d-block">
                <!-- page title -->
                <div class="mt-3 mb-2">
                    <h4 class="main-title">Employee</h4>
                    <p><small>About {{ count($employees) }} results found.</small></p>
                </div>

                <!-- Print -->
                <a href="#" class="btn top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                </a>

                <!-- refresh -->
                <a href="{{ route('employee.index') }}" class="btn top-icon-button print-none" title="Refresh">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>

                <!-- add -->
                <a href="{{ route('employee.create') }}" class="btn top-icon-button print-none" title="Create new employee">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <!-- card head end -->

            <!-- content body -->
            <div class="p-0 card-body">
                <!-- search area -->

                <!-- search area end -->

                <!-- data table -->
                <div class="mb-3 table-responsive">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Employee name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Mobile no</th>
                                <th scope="col">Basic salary</th>
                                <th scope="col">Address</th>
                                <th scope="col" class="print-none text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}.</th>
                                    <td>{{ $employee->employee_name }}</td>
                                    <td>{{ $employee->employee_role }}</td>
                                    <td>{{ $employee->mobile_no }}</td>
                                    <td>{{ $employee->basic_salary }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td class="print-none text-end">
                                        <a href="{{ route('employee.show', $employee->id) }}" class="btn table-small-button text-info" title="View" target="_blank" ><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn table-small-button text-success" title="Update"> <i class="bi bi-pencil-square"></i></a>

                                        <span data-bs-toggle="tooltip" title="Trash">
                                            <a href="#" class="btn table-small-button text-danger" onclick="if(confirm('Are you sure want to delete?')) { document.getElementById('employee-delete-{{ $employee->id }}').submit() } return false ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </span>

                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="post" class="d-none" id="employee-delete-{{ $employee->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4">Employee list is empty.</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- data table end -->

                <!-- paginate -->
                <div class="mb-5 card-footer print-none">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                        {{ optional($employees)->links() }}
                    </nav>
                </div>
                <!-- pagination end -->

            </div>
            <!-- content body end -->
        </div>
        <!-- card end -->
    </div>
</x-app-layout>
