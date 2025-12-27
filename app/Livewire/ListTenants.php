<?php

namespace App\Livewire;

use App\Models\Tenant;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListTenants extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render(): View
    {
        return view('livewire.list-tenants', [
            'tenants' => Tenant::query()
                ->where('is_active', true)
                ->whereHas('domains')
                ->orderBy('created_at', 'desc')
                ->paginate(6),
        ]);
    }
}
