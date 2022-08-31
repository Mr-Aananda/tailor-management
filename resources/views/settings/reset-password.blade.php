<x-app-layout>
    <x-slot name="title">Reset Password</x-slot>

    <div class="container print-none">
        <ul class="nav nav-tabs mt-2">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('password.reset') }}">Reset Password</a>
            </li>
        </ul>
    </div>

    <div class="container mt-2">
        <div class="card mb-5 border-0">
            <div class="card-header p-0 border-0 d-flex">
                <!-- page title -->
                <div class="mt-3">
                    <h4 class="main-title">Change Password</h4>
                    <p><small>To change your password, need to ensure that old password is the last password which is enter by your self.</small></p>
                </div>

                <!-- header icon -->
                <a href="{{ route('tailor.dashboard') }}" title="Go back" data-bs-toggle="tooltip"
                    class="pe-0 ms-auto print-none top-icon-button mb-2 mt-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>

            <div class="card-body p-0 pt-3">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <div class="row gy-3 mt-3">
                        <!-- current password -->
                        <div class="col-md-12 mb-5">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="current-password" class="form-label required mt-1">Current password</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="password" name="current_password" class="form-control" id="current-password" placeholder="********" required autofocus>
                                </div>
                            </div>
                        </div>

                        <!-- New password -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="new-password" class="form-label required mt-1">New password</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control" id="new-password" placeholder="********" required>
                                </div>
                            </div>
                        </div>

                        <!-- Re-Type new password -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="re-type-password" class="form-label required mt-1">Re-Type password</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" class="form-control" id="re-type-password" placeholder="********" required>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-7">
                                    <button type="reset" class="btn btn-danger custom-btn me-3">
                                        <i class="bi bi-dash-square"></i>
                                        Reset
                                    </button>

                                    <button type="submit" class="btn btn-success custom-btn">
                                        <i class="bi bi-save2"></i>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
