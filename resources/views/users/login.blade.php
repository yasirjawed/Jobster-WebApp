<x-layout>
    <x-card class="!p-5 !rounded !max-w-md !mx-auto">
        <header class="text-center">
            <a href="/" class="text-left flex"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
            <h2 class="text-2xl font-bold uppercase">
                Log In
            </h2>
            <p class="">Log in to post gigs</p>
        </header>
        <form method="POST" action="/user/authenticate">
            @csrf
            <div class="">
                <label for="email" class="inline-block text-lg">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ @old('email') }}"/>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4" >
                <label for="password" class="inline-block text-lg">
                    Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4" >
                <a href="{{ URL::to('googleLogin') }}">
                    <button type="button" class="px-4 py-2 border flex gap-2 border-slate-200 dark:border-slate-700 rounded-lg text-slate-700 dark:text-slate-200 hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300 hover:shadow transition duration-150" style="display:flex;width: 100%; justify-content: center">
                        <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
                        <span>Login with Google</span>
                    </button>
                </a>
            </div>
            <div class="" style="width: 100% !important">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"  style="display:flex;width: 100%; justify-content: center">
                    Sign In
                </button>
            </div>

            <div class="mt-4">
                <p>
                    Don't have an account?
                    <a href="/register" class="text-laravel">Register</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>
