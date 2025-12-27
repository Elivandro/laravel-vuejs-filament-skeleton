<div class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold text-gray-800">
            Tenants disponíveis
        </h2>
        <p class="mt-2 text-gray-500">
            Conheça os projetos ativos na plataforma
        </p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($tenants as $tenant)
                <a href="http://{{ $tenant->domains()->first()->domain }}" target="_blank" wire:key="tenant-{{ $tenant->id }}">
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6">
                    
                        @if ($tenant->logo)
                            <div class="flex justify-center mb-4">
                                <img
                                    src="{{ $tenant->logo }}"
                                    alt="{{ $tenant->name }}"
                                    class="h-20 object-contain rounded-full"
                                >
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold text-gray-800 text-center">
                            {{ $tenant->name }}
                        </h3>

                        <p class="text-sm text-gray-500 text-center mt-2 line-clamp-3">
                            {{ $tenant->description }}
                        </p>


                        <div class="mt-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $tenant->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $tenant->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                        </div>

                    </div>
                </a>
        @empty
            <p class="col-span-full text-center text-gray-500">
                Nenhum tenant encontrado.
            </p>
        @endforelse

    </div>

    <div class="mt-10">
        {{ $tenants->links() }}
    </div>

</div>
