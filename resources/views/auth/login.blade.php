@include('layouts.auth.authheader')


{{--  start reactjs or vuejs  --}}
<div id="app">
    
    
    {{--  Page Wrapper  --}}
    <section class="vh-100 d-flex justify-content-center align-items-center">
        
        <div class="bg-white p-4">
            <h5 class="mb-3">Sign In</h5>
            <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="form-group mb-3">
                    <input type="email" id="email" class="form-control form-control-sm rounded-0 @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" autofocus placeholder="Username" />

                    {{-- @error('email')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>                        
                    @enderror --}}

                </div>
        
                <!-- Password -->
                <div class="form-group mb-3">
                    <input type="password" id="password" class="form-control form-control-sm rounded-0 @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="password" />

                    {{-- @error('email')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>                        
                    @enderror --}}

                </div>

                <div class="form-group mb-3">

                    <div class="d-flex ">
                        <div class="form-check">
                            <label for="remember_me" class="form-label">Remember Me</label>
                            <input type="checkbox" id="remember_me" class="form-check-input" name="remember" value="{{old('password')}}" {{old('remember') ? 'checked' : ''}}/>
                        </div>

                        <div class="ms-auto">
                            <a href="{{route('password.request')}}" class=""><i class="fas fa-lock me-1"></i> Forgot Password ?</a>
                        </div>
                    </div>
                    
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info rounded-0">Login</button>
                </div>
        
            
            </form>

            {{-- bootstrap loader  --}}
            <div></div>

            {{-- social login --}}
            <div class="row">
                <small class="text-center text-muted mt-3">Sign in with</small>
                <div class="col-12 text-center mt-2">
                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="javascript:void(0);" class="btn" title="Login with Github"><i class="fab fa-github"></i></a>
                </div>
            </div>

            {{-- login link --}}
            <div class="row">
                <div class="col-12 text-center mt-2">
                    <small class="">Don't have an account ? <a href="{{route('register')}}" class="text-primary ms-1">SignUp</a></small>
                </div>
            </div>

            {{-- login policy --}}
            <div class="row">
                <div class="col-12 text-center text-muted mt-2">
                    <small class="">By clicking signup, you agree to our <a href="javascript:void(0);" class="fw-bold"> Terms</a></small>
                </div>
            </div>
        </div>

        

    </section>
    {{--  Page Wrapper  --}}

</div>
{{--  end reactjs or vuejs  --}}


@include('layouts.auth.authfooter')


{{-- 

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
