<?php

namespace App\Filament\Candidate\Pages;

use App\Models\Candidate;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class AccountSettings extends Page
{
    use InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.candidate.pages.account-settings';
    protected static ?string $title = 'Paramètres du Compte';
    protected static ?string $slug = 'account-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();
        $candidate = Candidate::where('user_id', $user->id)->first();

        $this->form->fill([
            'name'                    => $user->name,
            'email'                   => $user->email,
            'first_name'              => $candidate?->first_name ?? '',
            'last_name'               => $candidate?->last_name ?? '',
            'phone'                   => $candidate?->phone ?? '',
            'current_password'        => '',
            'new_password'            => '',
            'new_password_confirmation' => '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Personal Information'))
                    ->schema([
                        TextInput::make('first_name')
                            ->label(__('First Name'))
                            ->required(),
                        TextInput::make('last_name')
                            ->label(__('Last Name'))
                            ->required(),
                        TextInput::make('phone')
                            ->label(__('admin.phone'))
                            ->tel(),
                    ])->columns(2),

                Section::make(__('Account'))
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom d\'utilisateur')
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required(),
                    ])->columns(2),

                Section::make('Changer le mot de passe')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Mot de passe actuel')
                            ->password()
                            ->dehydrated(false),
                        TextInput::make('new_password')
                            ->label('Nouveau mot de passe')
                            ->password()
                            ->minLength(8)
                            ->dehydrated(false),
                        TextInput::make('new_password_confirmation')
                            ->label('Confirmer')
                            ->password()
                            ->dehydrated(false),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        if (! empty($data['current_password']) && ! empty($data['new_password'])) {
            if (! Hash::check($data['current_password'], $user->password)) {
                Notification::make()->title('Mot de passe actuel incorrect')->danger()->send();
                return;
            }
            if ($data['new_password'] !== $data['new_password_confirmation']) {
                Notification::make()->title('La confirmation du mot de passe ne correspond pas')->danger()->send();
                return;
            }
            $user->update(['password' => Hash::make($data['new_password'])]);
        }

        $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        Candidate::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'phone'      => $data['phone'],
            ]
        );

        $this->mount();

        Notification::make()->title('Modifications enregistrées !')->success()->send();
    }
}