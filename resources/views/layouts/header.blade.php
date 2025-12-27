@if(request()->routeIs('welcome'))
    <header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-8 py-4 bg-white shadow">
        <h1 class="text-2xl font-bold text-blue-600">
            <a href="{{  route('welcome') }}">
                Boilerplate
            </a>
        </h1>
        <div class="space-x-4">
            @if(Route::has('filament.admin.auth.login'))
                @auth
                    <a class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg"
                        href="{{ route('filament.admin.pages.dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a class="px-4 py-2 text-sm font-semibold text-blue-600 border border-blue-600 rounded-lg"
                        href="{{  route('filament.admin.auth.login') }}">
                        Login
                    </a>
        
                    <a class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg"
                        href="{{ route('filament.admin.auth.register') }}">
                        Criar conta
                    </a>
                @endauth
            @endif
        </div>
    </header>
@endif