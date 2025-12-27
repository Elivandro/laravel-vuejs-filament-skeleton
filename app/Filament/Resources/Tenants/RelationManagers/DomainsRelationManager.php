<?php

namespace App\Filament\Resources\Tenants\RelationManagers;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DomainsRelationManager extends RelationManager
{
    protected static string $relationship = 'Domains';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('domain')
                    ->prefix(fn(): string => app()->isLocal() ? 'http://' : 'https://')
                    ->suffix(fn(): string => config('tenancy.central_domain') ?? 'localhost/')
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $sanitized = str($state ?? '')
                            ->lower()
                            ->replace(' ', '')
                            ->replaceMatches('/[^a-z0-9.]/', '');

                        $set(
                            'domain',
                            "{$sanitized}." . config('tenancy.central_domain')
                        );
                    })
                    ->maxLength(20)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Domain')
            ->columns([
                TextColumn::make('domain')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y - H:i:s')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y - H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
