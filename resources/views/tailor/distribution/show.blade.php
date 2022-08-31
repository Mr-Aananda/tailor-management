<x-app-layout>
    <x-slot name="title">Distribution </x-slot>

    <div class="container">
        <!-- container menu -->
        @include('tailor.distribution.menu')
        <!-- container menu end -->

        <!-- print header -->
        {{-- @include('layouts.partials.printHead') --}}
        <!-- print header end -->

        <div class="container">
            <div class="mb-5 border-0 card">
                <div class="p-0 mb-3 border-0 card-header d-flex">
                    <!-- page title -->
                    <div class="mt-3 print-none">
                        <h4 class="main-title">Customer order details reciept for worker</h4>
                        <p><small>All the details below.</small></p>
                    </div>


                    <!-- Print -->
                    <a href="#" class="btn mt-3 top-icon-button print-none ms-auto" title="Print" onclick="window.print()">
                        <i class="bi bi-printer"></i>
                    </a>
                    <!-- header icon -->
                    <a href="{{ route('distribution.index') }}" title="Go back"
                    class="mt-3 mb-2 pe-0  print-none top-icon-button">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="header-1">
                    <div class="row">
                        <div class="col-6 order_no">
                            <p class="fw-bold">{{$distribution->orderDetails->customerOrder->order_no}}</p>
                            <p class="m-0 mt-3"><span class="fw-bold">Worker name : </span> {{$distribution->worker->worker_name}}</p>
                        </div>
                        <div class="col-6 item_name"  style="position: relative" >
                            <p> <span class="fw-bold">আইটেম : </span> {{$distribution->orderDetails->item->item_name}} <span class="fw-bold">({{$distribution->orderDetails->quantity}})</span></p>
                            <p class="fw-bold mt-5">স্বাক্ষর :</p>
                            <span  style="position: absolute; right:0; margin-right:52px; margin-top:-12px" > - - - - - - - - - - - - - - - -  </span>
                        </div>
                    </div>
                </div>

                <div class="header-2">
                    <div class="row">
                        <div class="col-6 header_2_info_1">
                            <p class="fw-bold header_2_order_no">{{$distribution->orderDetails->customerOrder->order_no}}</p>
                            <p class="header_2_name">{{$distribution->orderDetails->customerOrder->customer->customer_name}}</p>
                        </div>
                        <div class="col-6 header_2_info_2">
                            <p class="header_2_item_name">{{$distribution->orderDetails->item->item_name}} <span class="fw-bold">({{$distribution->orderDetails->quantity}})</span></p>
                            <p class="header_2_date">{{$distribution->orderDetails->customerOrder->delivery_date->format('d-m-Y')}}</p>

                        </div>
                    </div>

                </div>

                <div class="p-0 px-2 card-body mesaurments">
                    <div class="text-center mb-4">
                        <p>Master name: <span class="fw-bold"> {{$distribution->orderDetails->employee->employee_name ?? ''}}</span> </p>
                    </div>
                    @if ($distribution->orderDetails->item->item_part == 'Upper part')
                         {{-- Upper part details  start--}}
                    <div class="my-3 row fs-5">
                       <div class="col-2">
                            <dd>
                                <span  class="d-block text-center ">লম্বা-</span>
                                <span class="d-block text-center ">
                                    @php
                                        $formatted_upper_length= explode('/', $distribution->orderDetails->upper_length)
                                    @endphp
                                    @if (count($formatted_upper_length)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_upper_length[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_upper_length[2] ?? 0}}</mn><mn>{{ $formatted_upper_length[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->upper_length }}
                                    @endif
                                </span>
                            </dd>
                       </div>

                        <div class="col-2">
                             <dd class="border-bottom border-2 border-secondary ">
                                 <span class="d-block text-center">
                                     রাউন্ড বডি-
                                    @php
                                        $formatted_round_body= explode('/', $distribution->orderDetails->round_body)
                                    @endphp
                                    @if (count($formatted_round_body)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_round_body[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_round_body[2] ?? 0}}</mn><mn>{{ $formatted_round_body[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->round_body }}
                                    @endif
                                </span>
                            </dd>
                             <dd>
                                 <span class="border-bottom border-2 border-secondary d-block text-center ">
                                     পেট-

                                     @php
                                        $formatted_belly= explode('/', $distribution->orderDetails->belly)
                                    @endphp
                                    @if (count($formatted_belly)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_belly[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_belly[2] ?? 0}}</mn><mn>{{ $formatted_belly[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->belly }}
                                    @endif
                                </span>
                            </dd>
                             <dd>
                                 <span class="d-block text-center ">
                                     হিপ-
                                    @php
                                        $formatted_upper_hip= explode('/', $distribution->orderDetails->upper_hip)
                                    @endphp
                                    @if (count($formatted_upper_hip)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_upper_hip[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_upper_hip[2] ?? 0}}</mn><mn>{{ $formatted_upper_hip[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->upper_hip }}
                                    @endif
                                </span>
                            </dd>
                       </div>

                        <div class="col-2">
                            @if ($distribution->orderDetails->straight != null)
                                <dd>
                                    <span class="border-bottom border-2 border-secondary d-block text-center ">
                                        {{$distribution->orderDetails->straight}}
                                    </span>
                                </dd>
                            @else
                                <dd>
                                    <span class="border-bottom border-2 border-secondary d-block text-center ">
                                        {{$distribution->orderDetails->down}}
                                    </span>
                                </dd>

                            @endif
                            <dd>
                                 <span class="d-block text-center">
                                     সোল্ডার-
                                    @php
                                        $formatted_solder= explode('/', $distribution->orderDetails->solder)
                                    @endphp
                                    @if (count($formatted_solder)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_solder[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_solder[2] ?? 0}}</mn><mn>{{ $formatted_solder[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->solder }}
                                    @endif
                                </span>

                            </dd>
                       </div>

                        <div class="col-2">
                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center ">
                                    হাতা-
                                    @php
                                        $formatted_sleeve= explode('/', $distribution->orderDetails->sleeve)
                                    @endphp
                                    @if (count($formatted_sleeve)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_sleeve[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_sleeve[2] ?? 0}}</mn><mn>{{ $formatted_sleeve[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->sleeve }}
                                    @endif
                                </span>
                            </dd>

                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center ">
                                    কফ-
                                    @php
                                        $formatted_coff= explode('/', $distribution->orderDetails->coff)
                                    @endphp
                                    @if (count($formatted_coff)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_coff[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_coff[2] ?? 0}}</mn><mn>{{ $formatted_coff[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->coff }}
                                    @endif

                                </span>
                            </dd>

                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center ">
                                    আর্ম-

                                     @php
                                        $formatted_arm= explode('/', $distribution->orderDetails->arm)
                                    @endphp
                                    @if (count($formatted_arm)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_arm[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_arm[2] ?? 0}}</mn><mn>{{ $formatted_arm[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->arm }}
                                    @endif
                                </span>

                            </dd>

                            <dd>
                                <span class="d-block text-center">
                                    মাসেল-
                                     @php
                                        $formatted_mussle= explode('/', $distribution->orderDetails->mussle)
                                    @endphp
                                    @if (count($formatted_mussle)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_mussle[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_mussle[2] ?? 0}}</mn><mn>{{ $formatted_mussle[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->mussle }}
                                    @endif
                                </span>

                            </dd>
                       </div>

                       <div class="col-2">
                           <dd>
                            <span class="text-center d-block">গলা-</span>
                                <span class="text-center d-block">

                                    @php
                                        $formatted_neck= explode('/', $distribution->orderDetails->neck)
                                    @endphp
                                    @if (count($formatted_neck)=== 3)
                                        (<math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_neck[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_neck[2] ?? 0}}</mn><mn>{{ $formatted_neck[1] ?? 0 }}</mn></mfrac></math>)
                                    @else
                                        ({{ $distribution->orderDetails->neck }})
                                    @endif
                                </span>
                            </dd>


                       </div>

                        <div class="col-2">
                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center">F</span>
                            </dd>

                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center ">
                                    বডি ফ্রন্ট-
                                        @php
                                        $formatted_body_front= explode('/', $distribution->orderDetails->body_front)
                                    @endphp
                                    @if (count($formatted_body_front)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_body_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_body_front[2] ?? 0}}</mn><mn>{{ $formatted_body_front[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->body_front }}
                                    @endif
                                </span>
                            </dd>

                            <dd>
                                <span class="border-bottom border-2 border-secondary d-block text-center ">
                                      পেট ফ্রন্ট-
                                        @php
                                        $formatted_belly_front= explode('/', $distribution->orderDetails->belly_front)
                                    @endphp
                                    @if (count($formatted_belly_front)=== 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_belly_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_belly_front[2] ?? 0}}</mn><mn>{{ $formatted_belly_front[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->belly_front }}
                                    @endif
                                </span>
                            </dd>

                            <dd>
                                <span class="d-block text-center">
                                    হিপ ফ্রন্ট-
                                    @php
                                        $formatted_hip_front= explode('/', $distribution->orderDetails->hip_front)
                                    @endphp
                                    @if (count($formatted_hip_front) === 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_hip_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_hip_front[2] ?? 0}}</mn><mn>{{ $formatted_hip_front[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->hip_front }}
                                    @endif
                                </span>
                            </dd>
                       </div>

                    </div>
                    {{-- Upper part details  end--}}
                    @else
                    {{-- Lower part details  start--}}
                    <div class="my-3 d-flex justify-content-around text-center fs-5">
                        <div>
                            <span>লম্বা-</span>
                            <dd>

                                @php
                                    $formatted_lower_length= explode('/', $distribution->orderDetails->lower_length)
                                @endphp
                                @if (count($formatted_lower_length) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_lower_length[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_lower_length[2] ?? 0}}</mn><mn>{{ $formatted_lower_length[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->lower_length }}
                                @endif
                            </dd>
                       </div>

                        <div>
                            <span> মুহুরী-</span>
                            <dd>

                                @php
                                    $formatted_muhuri= explode('/', $distribution->orderDetails->muhuri)
                                @endphp
                                @if (count($formatted_muhuri) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_muhuri[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_muhuri[2] ?? 0}}</mn><mn>{{ $formatted_muhuri[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->muhuri }}
                                @endif
                            </dd>
                       </div>

                        <div>
                            <span>নী- </span>
                            <dd>

                                @php
                                    $formatted_knee= explode('/', $distribution->orderDetails->knee)
                                @endphp
                                @if (count($formatted_knee) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_knee[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_knee[2] ?? 0}}</mn><mn>{{ $formatted_knee[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->knee }}
                                @endif
                            </dd>
                       </div>

                        <div>
                            <span>থাই-</span>
                            <dd>

                                @php
                                    $formatted_thigh= explode('/', $distribution->orderDetails->thigh)
                                @endphp
                                @if (count($formatted_thigh) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_thigh[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_thigh[2] ?? 0}}</mn><mn>{{ $formatted_thigh[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->thigh }}
                                @endif
                            </dd>
                       </div>
                        <div>
                            <span>কোমর-</span>
                            <dd>

                                @php
                                    $formatted_waist= explode('/', $distribution->orderDetails->waist)
                                @endphp
                                @if (count($formatted_waist) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_waist[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_waist[2] ?? 0}}</mn><mn>{{ $formatted_waist[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->waist }}
                                @endif
                            </dd>
                       </div>

                        <div>
                            <span>হিপ-</span>
                            <dd>

                                @php
                                    $formatted_lower_hip= explode('/', $distribution->orderDetails->lower_hip)
                                @endphp
                                @if (count($formatted_lower_hip) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_lower_hip[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_lower_hip[2] ?? 0}}</mn><mn>{{ $formatted_lower_hip[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->lower_hip }}
                                @endif
                            </dd>
                       </div>

                        <div>
                            <span>হাই-</span>
                            <dd>

                                @php
                                    $formatted_high= explode('/', $distribution->orderDetails->high)
                                @endphp
                                @if (count($formatted_high) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_high[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_high[2] ?? 0}}</mn><mn>{{ $formatted_high[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->high }}
                                @endif
                            </dd>
                       </div>

                    </div>

                    <div class="my-2 d-flex justify-content-around text-center fs-5">
                        <div>
                           @if ($distribution->orderDetails->front_down!=null)
                           <span class="fw-bold">FD- </span>
                             <dd>

                                {{$distribution->orderDetails->front_down}}
                            </dd>
                           @endif
                       </div>

                        <div>
                            @if ($distribution->orderDetails->back_down!=null)
                             <span class="fw-bold">BD- </span>
                             <dd>

                                {{$distribution->orderDetails->back_down}}
                             </dd>
                            @endif
                       </div>

                        <div>
                            @if ($distribution->orderDetails->fly!=null)
                            <span> ফ্লাই-</span>
                             <dd>

                                {{-- <span class="fw-bold">Fly- </span> --}}

                                @php
                                    $formatted_fly= explode('/', $distribution->orderDetails->fly)
                                @endphp
                                @if (count($formatted_fly) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_fly[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_fly[2] ?? 0}}</mn><mn>{{ $formatted_fly[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->fly }}
                                @endif
                             </dd>
                            @endif
                       </div>

                        <div>
                            @if ($distribution->orderDetails->front!=null)
                            <span> ফ্রন্ট-</span>
                               <dd>

                                {{-- <span class="fw-bold">Front- </span> --}}

                                @php
                                    $formatted_front= explode('/', $distribution->orderDetails->front)
                                @endphp
                                @if (count($formatted_front) === 3)
                                    <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_front[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_front[2] ?? 0}}</mn><mn>{{ $formatted_front[1] ?? 0 }}</mn></mfrac></math>
                                @else
                                    {{ $distribution->orderDetails->front }}
                                @endif
                             </dd>
                            @endif
                       </div>

                        <div>
                          @if ($distribution->orderDetails->back!=null)
                          <span> ব্যাক-</span>
                             <dd>

                                {{-- <span class="fw-bold">Back- </span> --}}
                                    @php
                                        $formatted_back= explode('/', $distribution->orderDetails->back)
                                    @endphp
                                    @if (count($formatted_back) === 3)
                                        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>{{ $formatted_back[0] ?? 0 }}</mn><mfrac><mn>{{ $formatted_back[2] ?? 0}}</mn><mn>{{ $formatted_back[1] ?? 0 }}</mn></mfrac></math>
                                    @else
                                        {{ $distribution->orderDetails->back }}
                                    @endif
                            </dd>
                          @endif
                       </div>

                    </div>
                    {{-- Lower part details  end--}}
                    @endif

                    <div class="my-3 row">
                        <div class="col-8 fs-5">
                            <dt>Designs :</dt>
                            @foreach ($distribution->orderDetails->designs as $design )
                                <li class="design_name">{{ $design->design_name }} </li>
                            @endforeach
                        </div>

                        <div class="col-4 text-center fs-5">
                            <dt>Fitting:</dt>
                            <dd>{{$distribution->orderDetails->fitting->fitting_name}}</dd>

                            @if ($distribution->orderDetails->image_id!=null)
                            <div style="position: relative">
                                    <img src="/storage/{{$distribution->orderDetails->image->image}}" class="img-fluid" width="150px" alt="image" style="position: absolute; right:0 ; top:10px;">
                            </div>

                            @endif
                        </div>

                        {{-- <div class="col-4 text-center">
                            <dt>Quantity:
                                <span>{{$distribution->orderDetails->quantity}}</span>
                            </dt>

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

     @push('script')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    @endpush

     @push('style')

        <style>
            @media print{
                .container{
                    max-width: 600px!important;
                }
                .order_no p{
                    margin-left: 100px;
                    margin-top:34px;
                }
                .item_name{
                    margin-top: 50px;
                }
                  .item_name p{
                    margin-left: 50px;
                }

                .header-2{
                    margin-top: 120px
                }

                .header_2_order_no{
                    margin-left: 100px;
                    margin-bottom: 20px;
                    margin-top:12px

                }
                   .header_2_name{
                    margin-left: 80px;

                }

                .header_2_item_name{
                     margin-left: 70px;
                     margin-bottom: 10px

                }
                  .header_2_date{
                    margin-left: 70px

                }
                .header_2_info_2{
                    margin-top: 30px;

                }
                    .mesaurments{
                    margin-top: 12px;
                    width:100%;
                }
                /* .design_name{
                    font-size: 12px !important;
                } */
            }
        </style>

        @endpush
</x-app-layout>
