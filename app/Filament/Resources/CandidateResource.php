<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('primary_score')
                    ->numeric(),
                Forms\Components\TextInput::make('secondary_score')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nom')->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'validated' => 'success',
                        'rejected' => 'danger',
                        'in_progress' => 'info',
                        default => 'warning',
                    }),
                Tables\Columns\IconColumn::make('cv_path')
                    ->label('CV')
                    ->boolean()
                    ->trueIcon('heroicon-o-document')
                    ->falseIcon('heroicon-o-x-mark'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('voir_cv')
                    ->label('Voir CV')
                    ->icon('heroicon-o-document')
                    ->url(fn ($record) => $record->cv_path
                        ? asset('storage/' . $record->cv_path)
                        : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->cv_path !== null),

                Tables\Actions\Action::make('approuver')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approuver le CV')
                    ->modalDescription('Êtes-vous sûr de vouloir approuver ce candidat ?')
                    ->action(function ($record) {
                        $record->update(['status' => 'validated']);
                        \Filament\Notifications\Notification::make()
                            ->title('Candidat approuvé !')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),

                Tables\Actions\Action::make('rejeter')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Rejeter le CV')
                    ->modalDescription('Êtes-vous sûr de vouloir rejeter ce candidat ?')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        \Filament\Notifications\Notification::make()
                            ->title('Candidat rejeté !')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),

                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}