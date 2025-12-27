<?php

namespace App\Filament\Resources\Tenants;

use App\Filament\Resources\Tenants\Pages;
use App\Filament\Resources\Tenants\RelationManagers\DomainsRelationManager;
use App\Filament\Resources\Tenants\RelationManagers\UsersRelationManager;
use App\Filament\Resources\Tenants\Schemas\TenantForm;
use App\Filament\Resources\Tenants\Tables\TenantsTable;
use App\Models\Tenant;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    public static function form(Schema $schema): Schema
    {
        return TenantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TenantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            DomainsRelationManager::class,
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'     => Pages\ListTenants::route('/'),
            'create'    => Pages\CreateTenant::route('/create'),
            'view'      => Pages\ViewTenant::route('/{record}'),
            'edit'      => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $tenantId = auth()->user()?->tenant_id;

        return parent::getEloquentQuery()
            ->when(
                $tenantId,
                fn($query) => $query->where('id', $tenantId)
            );
    }
}
