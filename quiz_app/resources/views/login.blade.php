@extends('layout.common-layout')

@section('space-work')

<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>
              @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMessage">
                  <p style="color:red;">{{ Session::get('error') }}</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
            <form action="{{ route('studentLogin') }}" method="POST">
              @csrf

              <!-- Username input field -->
              <div class="form-outline mb-4">
                <input type="text" name="username" id="username" class="form-control form-control-lg" required />
                <label class="form-label" for="username">Username</label>
                @error('name')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
              </div>

              <!-- Password input field -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                <label class="form-label" for="password">Password</label>
                @error('password')
                    <p style="color:red;">{{ $message }}</p>
                @enderror
              </div>

              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" value="login">
                Login
              </button>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
