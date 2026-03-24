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
    protected static ?string $navigationLabel = 'Applications';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'in_progress' => 'In Progress',
                    'validated' => 'Validated',
                    'rejected' => 'Rejected',
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
                    ->label('Candidate')->searchable(),
                Tables\Columns\TextColumn::make('offre.title')
                    ->label('Offer')->default('Free Candidate'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'validated' => 'success',
                        'rejected' => 'danger',
                        'in_progress' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('current_level')
                    ->label('Current Level'),
                Tables\Columns\TextColumn::make('main_score')
                    ->label('Main Score'),
                Tables\Columns\TextColumn::make('secondary_score')
                    ->label('Secondary Score'),
            ])
            ->actions([
                Tables\Actions\Action::make('voir_reponses')
                    ->label('View Answers')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record) => route('filament.admin.resources.application-progresses.edit', $record)),

                Tables\Actions\Action::make('valider')
                    ->label('Validate Level')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Validate Level')
                    ->modalDescription('The candidate will move to the next level.')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'validated',
                            'current_level' => $record->current_level + 1,
                        ]);
                        \Filament\Notifications\Notification::make()
                            ->title('Level validated! Candidate moved to the next level.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'in_progress'),

                Tables\Actions\Action::make('rejeter')
                    ->label('Reject Level')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Level')
                    ->modalDescription('The application will be rejected.')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        \Filament\Notifications\Notification::make()
                            ->title('Level rejected!')
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