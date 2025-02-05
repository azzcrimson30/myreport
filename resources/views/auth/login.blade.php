<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet"> <!-- Added custom CSS -->
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center m-3">
            <h3 class="text-center m-4" style="color: blue">Welcome to Company Management System</h3><hr>
            <div class="col-md-4">
                <div class="card shadow-lg mt-4"> <!-- Added shadow for depth -->
                    <h4 class="card-header text-center" style="background-color: lightblue">Login</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.authenticate') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('emailPassword'))
                                <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                                @endif
                            </div>

                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success btn-block">Sign In</button> <!-- Fixed typo from 'Signin' to 'Sign In' -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
