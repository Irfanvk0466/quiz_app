@extends('layout/common-layout')

@section('space-work')

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" id="successMessage">
                 <p style="color:green;">{{ Session::get('success') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

            <form action="{{ route('studentRegister') }}" method="POST">
                @csrf

                <!-- Name field -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" name="name" id="form3Example1cg" class="form-control form-control-lg" value="{{ old('name') }}" />
                  <label class="form-label" for="form3Example1cg">Username</label>
                  @error('name')
                      <p style="color:red;">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Email field -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" value="{{ old('email') }}" />
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                  @error('email')
                      <p style="color:red;">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Password field -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cg">Password</label>
                  @error('password')
                      <p style="color:red;">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Confirm password field -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" name="password_confirmation" id="form3Example4cdg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                  @error('password_confirmation')
                      <p style="color:red;">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-center">
                  <button type="submit" value="register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                    Register
                  </button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a>
                </p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
