@vite('resources/css/app.css')
<div class="">
    <div class="flex flex-col   h-full items-center justify-center  p-4 space-y-4 antialiased text-gray-900 bg-gray-100">
        <div class="w-full px-8 max-w-lg space-y-6 bg-white rounded-md py-16">
            <h1 class=" mb-6 text-3xl font-bold text-center">
                Don't worry
            </h1>
            <p class="text-center mx-12">We are here to help you to recover your password. Enter the email address you used
                when you joined and we'll send you instructions to reset your password.</p>
            <form method="POST" action="{{ route('filament.password.email') }}">
                @csrf

                <input class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-primary-100"
                       type="email" name="email" placeholder="Email address" required="">
                <div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <button type="submit"
                            class="w-[50%] mt-5 px-4 py-2 font-medium text-center text-white bg-indigo-600 transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1">
                     Vraag aan
                    </button>
                </div>
            </form>
            <div class="text-sm text-gray-600 items-center flex justify-between">

                <a href="/admin" class="text-gray-800 cursor-pointer hover:text-blue-500 inline-flex items-center ml-4">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                              clip-rule="evenodd" />
                    </svg>
                  Back</a>
                <a href="mailto:info@techyourtalentamsterdam.nl" class="hover:text-blue-500 cursor-pointer">Need help?</a>
            </div>
        </div>
    </div>
</div>
