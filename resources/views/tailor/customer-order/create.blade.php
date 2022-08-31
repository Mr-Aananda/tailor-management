<x-app-layout>
    <x-slot name="title">Customer order </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer-order.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Create new order</h4>
                    <p><small>Can create <strong>order</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('customer-order.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 card-body">
                <form action="{{route('customer-order.store')}}" method="POST">
                    @csrf

                     <div id="CustomerOrder"
                        {{-- data-order-no="{{ $order_no }}" --}}
                        data-payment-types= "{{ $paymentTypes }}"
                        data-items= "{{ $items }}"
                        data-fittings= "{{ $fittings }}"
                        data-cashes= "{{ $cashes }}"
                        data-designs="{{ $designs }}"
                        data-discount-types="{{ json_encode($discountTypes,true) }}"
                        data-images="{{$images}}"
                        data-customers = "{{$customers}}"
                        data-employees = "{{$employees}}"
                        {{-- data-vouchers = "{{$vouchers}}" --}}
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
