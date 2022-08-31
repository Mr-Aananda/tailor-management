<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="container mt-3 mb-5">
        <div class="text-center mt-3 mb-3">
            <img src="{{ asset('images/logos/logo_with_name.svg') }}" alt="" width="420px">
            <h4 class="text-muted my-3">Welcome to Tailor Management</h4>
        </div>
         <div class="mb-3">
            <h3 class="text-muted">
                Customer orders
                <i class="bi bi-people-fill"></i>
            </h3>
        </div>

        <div class="mb-4 gy-3 row">
            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color1">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total orders</h6>
                                    <h3 class="mb-0 text-white">{{count($customer_order)}}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-scissors"></i>
                            </div>
                        </div>
						<p class="mt-2 text-white">&nbsp;</p>
					</div>
				</div>
			</div>

            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color2">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total pending</h6>
                                    <h3 class="mb-0 text-white">{{count($orderPending)}}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-chevron-double-right"></i>
                            </div>
                        </div>
                            <p class="mt-2 text-white">Total pending</p>
					</div>
				</div>
			</div>

            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color3">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total processing</h6>
                                    <h3 class="mb-0 text-white">{{count($orderProcessing)}}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                            <p class="mt-2 text-white">Total processing</p>
						</a>
					</div>
				</div>
			</div>

            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color4">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total completed</h6>
                                    <h3 class="mb-0 text-white">{{count($orderComplete)}}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-patch-check"></i>
                            </div>
                        </div>
                            <p class="mt-2 text-white">Total completed</p>
						</a>
					</div>
				</div>
			</div>

        </div>
    </div>

	<div class="container">
        <div class="mb-3">
            <h3 class="text-muted">Payments <i class="bi bi-wallet2"></i></h3>
        </div>
        <div class="mb-4 gy-3 row">

           <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color1">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Grand total</h6>
                                    <h3 class="mb-0 text-white">{{ number_format ($customer_order->sum('grand_total'),2) }}</h3>
                            </div>
                            <div class="col-auto text-white fs-3 ">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-white">&nbsp;</p>
					</div>
				</div>
			</div>

            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color2">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total paid</h6>
                                    <h3 class="mb-0 text-white">{{ number_format ($totalPayment,2) }}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-cash"></i>
                            </div>
                        </div>
                            <p class="mt-2 text-white">Total paid</p>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-6">
				<div class="shadow card card-color3">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total due</h6>
                                    <h3 class="mb-0 text-white">{{ number_format ($customer_order->sum('total_due'),2) }}</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-cash"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-white">Total due</p>
					</div>
				</div>
			</div>

            <div class="col-xl-3 col-md-6">
				<div class="shadow card card-color4">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Expenses</h6>
                                    <h3 class="mb-0 text-white">0.00</h3>
                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-credit-card-2-front"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-white">Monthly Expenses</p>
					</div>
				</div>
			</div>
		</div>
	</div>

     {{-- <div class="container">

        <div>
            <h4 class="text-muted mb-2">Contact <i class="bi bi-people-fill"></i></h4>
        </div>
        <div class="mb-4 gy-3 row">
			<div class="col-xl-3 col-md-6">
				<div class="shadow card total-color">
					<div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-3 text-white">Total Contact</h6>
                                <h3 class="mb-0 text-white">0.00</h3>

                            </div>
                            <div class="col-auto text-white fs-3">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <p class="mt-2 text-white">People</p>
					</div>
				</div>
			</div>
		</div>
	</div> --}}


    @push('style')
		<style>
            .header-title{
                color: #eb684e!important;
            }
			.card-body a{
				text-decoration: none !important;
			}
			.card-color1{
				background-color: #0FB382 !important;

			}
			.card-color2{
				background-color: #7D4AB3 !important;

			}
			.card-color3{
				background-color: #EB588F !important;

			}

			.card-color4{
				background-color: #3dbaec!important;

			}

		</style>

	@endpush

</x-app-layout>
