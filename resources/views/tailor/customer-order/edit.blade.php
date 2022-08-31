<x-app-layout>
    <x-slot name="title">Edit Customer order </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.customer-order.menu')
        <!-- container menu end -->

        <div class="border-0 card">
            <div class="p-0 mb-3 border-0 card-header d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Edit customer order</h4>
                    <p><small>Can edit <strong>order</strong> from here.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('customer-order.index') }}" title="Go back" class="mt-3 mb-2 pe-0 ms-auto print-none top-icon-button">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="p-0 card-body">
                <form action="{{route('customer-order.update',$customer_order->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                     <div id="CustomerOrder"
                        data-order-no="{{ $customer_order->order_no }}"
                        data-payment-types= "{{ $paymentTypes }}"
                        data-cashes= "{{ $cashes }}"
                        data-items= "{{ $items }}"
                        data-fittings= "{{ $fittings }}"
                        data-designs="{{ $designs }}"
                        data-discount-types="{{ json_encode($discountTypes,true) }}"
                        data-images="{{$images ?? []}}"
                        data-employees = "{{$employees }}"

                        data-date="{{$customer_order->format_date ?? ""}}"
                        data-name="{{$customer_order->customer->customer_name ?? ""}}"
                        data-order-no="{{$customer_order->order_no ?? ""}}"
                        data-delivery-date="{{$customer_order->format_delivery_date ?? ""}}"
                        data-mobile-no="{{$customer_order->customer->mobile_no ?? ""}}"
                        data-address="{{$customer_order->customer->address ?? ""}}"
                        data-discount-type="{{$customer_order->discount_type ?? ""}}"
                        data-discount="{{$customer_order->discount ?? ""}}"
                        data-payment-type-edit="{{$customer_order->paymentDetails[0]->payment_type ?? ""}}"
                        data-cash-edit-id="{{$customer_order->paymentDetails[0]->cash_id ?? ""}}"
                        data-total-paid="{{$customer_order->paymentDetails[0]->total_paid ?? ""}}"
                        data-customer-order="{{$customer_order}}"
                        data-all-edit-data= "{{ json_encode($allEditData, true) }}"

                        data-is-main-update={{ 0 }}

                        data-customers = "{{$customers ?? []}}"

                        {{-- data-vouchers = "{{$vouchers ?? []}}" --}}
                        data-fabric-bill="{{$customer_order->fabric_bill ?? ""}}"
                        data-fabric-paid="{{$customer_order->fabric_paid ?? ""}}"
                        >
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
