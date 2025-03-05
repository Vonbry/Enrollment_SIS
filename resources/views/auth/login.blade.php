<x-guest-layout>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="remember-forgot">
                <label for="remember_me" class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="login-button">
                {{ __('Log in') }}
            </x-primary-button>

            <!-- Register Link -->
            <div class="register-link">
                Don't have an account? 
                <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </div>

    <style>
    .login-container {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }

    .logo {
        width: 150px;
        height: auto;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #4a5568;
        font-size: 0.875rem;
    }

    .forgot-password {
        color: #3498db;
        font-size: 0.875rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .forgot-password:hover {
        color: #2980b9;
    }

    .login-button {
        width: 100%;
        padding: 0.75rem;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .login-button:hover {
        background-color: #2980b9;
    }

    .error-message {
        color: #e74c3c;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .register-link {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.875rem;
        color: #4a5568;
    }

    .register-link a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        margin-left: 0.25rem;
        transition: color 0.2s;
    }

    .register-link a:hover {
        color: #2980b9;
        text-decoration: underline;
    }
    </style>
</x-guest-layout>
