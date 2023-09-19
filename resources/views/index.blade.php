<x-layout>
    <x-slot:title>Accueil</x-slot:title>

    @error('email')
    <div class="rounded-md bg-red-50 p-4">
        <div class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
            </div>
        </div>
    </div>
    @enderror

    @if (session('status'))
    <div class="rounded-md bg-green-50 p-4">
        <div class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Listing des fonctionnalités -->
    <section>
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Une API REST pour accéder à des milliers de films</h2>
                <p class="mt-4 text-lg text-gray-500">Ac euismod vel sit maecenas id pellentesque eu sed consectetur. Malesuada adipiscing sagittis vel nulla nec.</p>
            </div>
            <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">
                <!-- Start feature -->
                @foreach($arguments as $argument)
                    <x-argument :title="$argument['title']" :body="$argument['body']"></x-argument>
                @endforeach
                <!-- End feature -->
            </dl>
        </div>
    </section>

    <!-- Newsletter -->
    <section>
        <div class="max-w-7xl mx-auto px-4 pb-12 sm:px-6 lg:pb-16 lg:px-8">
            <div class="px-6 py-6 bg-indigo-700 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
                <div class="xl:w-0 xl:flex-1">
                    <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">Vous voulez connaître nos actus?</h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-indigo-200">Inscrivez-vous à notre super newsletter !</p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                    <form method="POST" action="{{route('newsletter')}}" class="sm:flex" novalidate>
                        @csrf
                        <label for="email" class="sr-only">Adresse e-mail</label>
                        <input id="email" value="" name="email" type="email" class="w-full border-white px-5 py-3 placeholder-gray-500 focus:ring-offset-indigo-700 focus:ring-white focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-md" placeholder="Entrez votre adresse e-mail">
                        <button type="submit" class="mt-3 w-full flex items-center justify-center px-5 py-3 border border-transparent shadow text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">M'abonner</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
