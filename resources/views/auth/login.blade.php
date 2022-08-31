<x-guest-layout>
    <x-slot name="title">Sign In</x-slot>

    <!-- authentication -->
    <section class="authentication">
        <!-- main wrapper -->
        <div class="wrapper">
            <!-- alert -->
            <div class=" {{ ($errors->has('email')) ? 'alert alert-danger p-2 mb-0 border-0 rounded-0' : '' }}" role="alert">
                @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                @endif
            </div>

            <div class="wrap-content">
                <div class="p-4 pt-2">
                    <!-- Brand logo -->
                    <div class="text-center">
                        <img src="{{ asset('images/logos/logo_with_name.svg') }}" class="logo" alt="Brand logo">
                    </div>
                    <hr>

                    <!-- page title -->
                    <div class="text-center mt-2 mb-3">
                        <h3 class="main-title">Sign In</h3>
                    </div>

                    <!-- Sum text -->
                    {{-- <p class="px-4 text-center mb-3">
                        <small>
                            One account for everything Intuit, including QuickBooks.
                            <a href="#" target="_blank">Learn more</a>
                        </small>
                    </p> --}}

                    <!-- form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- user ID -->
                            <div class="col-12">
                                <label for="email" class="form-label required">Email address</label>
                                <input type="email" name="email" value="admin@maxsop.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="access@example.com" required>
                            </div>

                            <!-- password input -->
                            <div class="col-12">
                                <label for="password" class="form-label required">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" value="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                                           placeholder="**********" required>
                                    <a href="#" class="pass-eye" onclick="show()"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </div>

                            <!-- checkbox input -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>


                            <!-- button -->
                            <div class="col-12">
                                <button type="submit" class="btn w-100 btn-success custom-btn mr-2">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>{{ __('Sign in') }}</span>
                                </button>
                            </div>

                        </div>
                    </form>

                    <!-- Sign in terms of use -->
                    <div class="text-center text-small my-2">
                        <small>
                            By clicking sign in, you agree to our <br>
                            <a href="#" class="text-small">Terms</a>
                            and have read and acknowledge our
                            <a href="#" class="text-small">Global Privacy Statement.</a>

                            <p class="fw-bold mt-2">Updated on April 3, 2022</p>
                        </small>
                    </div>
                    <hr>

                    <div class="mt-2 text-center">
                        <!-- forgot password -->
                        <small class="d-block">
                            @if (Route::has('password.request'))
                                {{-- <a href="{{ route('password.request') }}">
                                    {{ __('I forgot my user ID or Password.') }}
                                </a> --}}
                                  <a href="{{ route('login') }}">
                                    {{ __('I forgot my user ID or Password.') }}
                                </a>
                            @endif
                        </small>

                        <!-- Sign Up -->
                        <small class="d-block">
                            New to the system?
                            <a href="{{ route('login') }}">{{ __('Sign up') }}</a>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row text-light text-small mt-2">
                <div class="col-md-8">
                    &copy; 2020 - 2022
                    <a href="https://maxsop.com/" class="text-small" target="_blank">MaxSOP</a>.
                    <span> All rights reserved.</span>
                </div>

                <div class="col-md-4 text-end" style="word-spacing: 5px;">
                    <a href="#" class="text-small" target="_blank">Privacy</a> |
                    <a href="#" class="text-small" target="_blank">Support</a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function show() {
            var input = document.getElementsByName("password")[0],
                type = input.getAttribute("type");

            if (type === "password") {
                input.type = "text";
                document.querySelector('.bi-eye-fill').classList.add("bi-eye-slash-fill");
            } else {
                input.type = "password";
                document.querySelector('.bi-eye-fill').classList.remove("bi-eye-slash-fill");
            }
        }
    </script>
    @endpush
</x-guest-layout>

