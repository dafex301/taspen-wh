@extends('layouts.main')

@section('container')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            {{-- <form method="POST" action="/password"> --}}
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">Current
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                        required>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm
                                    New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control"
                                        name="new_password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const form = document.querySelector('form');
        const password = document.querySelector('#new_password');
        const confirmPassword = document.querySelector('#new_password_confirmation');

        form.addEventListener('submit', function(event) {
            if (password.value !== confirmPassword.value) {
                event.preventDefault();
                alert('The password and confirmation password do not match.');
            }
        });
    </script>
@endsection
