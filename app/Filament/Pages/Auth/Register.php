<?php

namespace App\Filament\Pages\Auth;

use App\Models\Tenant;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Events\Registered;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components;
use Illuminate\Support\HtmlString;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class Register extends BaseRegister
{
    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->callHook('beforeFill');
        $this->form->fill();
        $this->callHook('afterFill');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\Wizard::make([
                    Components\Wizard\Step::make('Organização')
                        ->schema([
                            $this->getTenantNameFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'tenancy' : ''),
                            $this->getTenantDescriptionFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'descrição do tenancy' : ''),
                            $this->getTenantLogoFormComponent(),
                        ]),
                    Components\Wizard\Step::make('Registro')
                        ->schema([
                            $this->getNameFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'Joe Doe' : ''),
                            $this->getEmailFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'teste@teste.com' : ''),
                            $this->getPasswordFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'password' : ''),
                            $this->getPasswordConfirmationFormComponent()
                                ->default(fn(): string => app()->isLocal() ? 'password' : ''),
                            $this->getAcceptTermsFormComponent()
                                ->default(fn(): bool => app()->isLocal() ? true : false),
                        ]),
                ]),
            ])->statePath('data');
    }

    protected function getTenantNameFormComponent(): Component
    {
        return TextInput::make('tenant.name')
            ->label(__('filament-panels::auth/pages/register.form.name.label'))
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getTenantDescriptionFormComponent(): Component
    {
        return Textarea::make('tenant.description')
            ->label('Descrição')
            ->autosize(false);
    }

    protected function getTenantLogoFormComponent(): Component
    {
        return FileUpload::make('tenant.logo')
            ->label('logo')
            ->image()
            ->disk('s3')
            ->directory('tenants/logos')
            ->visibility('public')
            ->imagePreviewHeight('150')
            ->maxSize(2048)
            ->preserveFilenames(false);
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label(__('filament-panels::auth/pages/register.form.name.label'))
            ->required()
            ->maxLength(255);
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label(__('filament-panels::auth/pages/register.form.email.label'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel());
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('filament-panels::auth/pages/register.form.password.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->rule(Password::default())
            ->showAllValidationMessages()
            ->dehydrateStateUsing(fn($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::auth/pages/register.form.password.validation_attribute'));
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::auth/pages/register.form.password_confirmation.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->dehydrated(false);
    }

    protected function getAcceptTermsFormComponent(): Component
    {
        return Checkbox::make('accept_terms')
            ->label('Aceito os termos de uso')
            ->helperText(fn() => new HtmlString(
                '<style>
                    .terms-link {
                        font-weight: bold;
                        text-decoration: none;
                    }
                    .terms-link:hover {
                        text-decoration: underline;
                    }
                </style>
                <span>Ao continuar, você aceita os
                        <a href="#" target="_blank" class="terms-link">
                        termos de uso
                        </a>.
                </span>'
            ))
            ->accepted()
            ->validationMessages([
                'required' => 'O :attribute é obrigatório.',
                'accepted' => 'Para continuar você deve aceitar os termos de uso.'
            ])
            ->required();
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function (): Model {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        event(new Registered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function handleRegistration(array $data): Model
    {
        $tenantData = $data['tenant'];
        unset($data['tenant'], $data['accept_terms']);

        $logoPath = $tenantData['logo'] ?? null;
        $logoUrl = $logoPath ? Storage::disk('s3')->url($logoPath) : null;

        $tenant = Tenant::create([
            'name' => $tenantData['name'],
            'description' => $tenantData['description'] ?? null,
            'logo' => $logoUrl,
        ]);

        $user = $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;
    }
}
