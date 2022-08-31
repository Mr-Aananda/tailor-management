<x-guest-layout>
    <x-slot name="title">Sign Up</x-slot>

    <!-- authentication -->
    <section class="authentication">

        <!-- main wrapper -->
        <div class="wrapper signup">
            <!-- alert -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-0 p-2 mb-0" role="alert">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="wrap-content">
                <div class="p-4 pt-2">
                    <!-- Brand logo -->
                    <div class="text-center">
                        <img src="{{ asset('images/logos/logo_with_name.svg') }}" class="logo" alt="Brand logo">
                    </div>
                    <hr>

                    <!-- page title -->
                    <div class="text-center mt-2 mb-3">
                        <h3 class="main-title">Sign Up</h3>
                    </div>

                    <!-- Some text -->
                    {{-- <p class="px-4 text-center mb-3">
                        <small>
                            You're signing up for QuickBooks Online in Bangladesh
                            <a href="#">(Change)</a>
                        </small>
                    </p> --}}

                    <!-- form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row g-3">
                            <!-- First name input -->
                            <div class="col-12">
                                <label for="first-name" class="form-label required">Name</label>
                                <input type="text" name="name" class="form-control" id="first-name" required>
                            </div>

                            <div class="col-12">
                                <label for="user-id" class="form-label required">Email address(User ID)</label>
                                <input type="text" name="email" class="form-control" id="user-id" placeholder="access@example.com" required>
                            </div>


                            <!-- password input -->
                            <div class="col-12">
                                <label for="password" class="form-label required">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="**********" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password-confirmation" class="form-label required">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" id="password-confirmation" placeholder="**********" required>
                                </div>
                            </div>

                            <!-- button -->
                            <div class="col-12">
                                <button type="submit" class="btn custom-btn btn-success mr-2 w-100">
                                    <span>Sign up</span>
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="mt-2 text-center">
                        <small>
                            Already have an account?
                            <a href="{{ route('login') }}">
                                {{ __('Sign In') }}
                            </a>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row text-light text-small mt-2">
                <div class="col-md-8">
                    &copy; 2020
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
</x-guest-layout>
