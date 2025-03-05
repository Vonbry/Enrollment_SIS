<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </div>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <div class="form-grid">
                <!-- Left Column -->
                <div class="form-column">
                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>  

                    <!-- Role -->
                    <div class="form-group">
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="block mt-1 w-full rounded-md">
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Age -->
                    <div class="form-group">
                        <x-input-label for="age" :value="__('Age')" />
                        <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required />
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Right Column -->
                <div class="form-column">
                    <!-- Phone Number -->
                    <div class="form-group">
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender" class="block mt-1 w-full rounded-md">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    <!-- Year Level -->
                    <div>
                        <x-input-label for="year_level" :value="__('Year Level')" />
                        <input id="year_level" 
                               type="number" 
                               name="year_level" 
                               min="1" 
                               max="6"
                               class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               required />
                        <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
                    </div>

                    <!-- Course -->
                    <div>
                        <x-input-label for="course" :value="__('Course')" />
                        <select id="course" 
                                name="course" 
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <option value="">Select Course</option>
                            <option value="IT">Information Technology</option>
                            <option value="NURSING">Nursing</option>
                            <option value="ACCOUNTANCY">Accountancy</option>
                            <option value="BUSINESS AD">Business Administration</option>
                            <option value="EDUC">Education</option>
                        </select>
                        <x-input-error :messages="$errors->get('course')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>

            <x-primary-button class="register-button">
                {{ __('Register') }}
            </x-primary-button>

            <!-- Login Link -->
            <div class="login-link">
                Already have an account? 
                <a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
</x-guest-layout>
