@if(request()->routeIs('welcome'))
    <footer class="py-6 text-center text-gray-500 border-t border-gray-100">
        © {{ date('Y') }} – Boilerplate Multi-Tenancy em Laravel
    </footer>
@endif