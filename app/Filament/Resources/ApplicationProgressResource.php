<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationProgressResource\Pages;
use App\Models\ApplicationProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationProgressResource extends Resource
{
    protected static ?string $model = ApplicationProgress::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Candidatures';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'En attente',
                    'in_progress' => 'En cours',
                    'validated' => 'Validé',
                    'rejected' => 'Rejeté',
                ])
                ->required(),
            Forms\Components\TextInput::make('current_level')
                ->numeric(),
            Forms\Components\TextInput::make('main_score')
                ->numeric(),
            Forms\Components\TextInput::make('secondary_score')
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('candidate.user.name')
                    ->label('Candidat')->searchable(),
                Tables\Columns\TextColumn::make('offre.title')
                    ->label('Offre')->default('Candidat Libre'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'validated' => 'success',
                        'rejected' => 'danger',
                        'in_progress' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('current_level')
                    ->label('Level actuel'),
                Tables\Columns\TextColumn::make('main_score')
                    ->label('Score Principal'),
                Tables\Columns\TextColumn::make('secondary_score')
                    ->label('Score Secondaire'),
            ])
            ->actions([
                Tables\Actions\Action::make('voir_reponses')
                    ->label('Voir Réponses')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record) => route('filament.admin.resources.application-progresses.edit', $record)),

                Tables\Actions\Action::make('valider')
                    ->label('Valider Level')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Valider le niveau')
                    ->modalDescription('Le candidat passera au niveau suivant.')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'validated',
                            'current_level' => $record->current_level + 1,
                        ]);
                        \Filament\Notifications\Notification::make()
                            ->title('Level validé ! Candidat passé au niveau suivant.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'in_progress'),

                Tables\Actions\Action::make('rejeter')
                    ->label('Rejeter Level')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Rejeter le niveau')
                    ->modalDescription('La candidature sera rejetée.')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        \Filament\Notifications\Notification::make()
                            ->title('Level rejeté !')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'in_progress'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

 public static function getPages(): array
{
    return [
        'index' => Pages\ListApplicationProgresses::route('/'),
        'edit' => Pages\EditApplicationProgress::route('/{record}/edit'),
    ];
}
}
