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
    protected static ?string $navigationLabel = 'Candidates';
    protected static ?string $modelLabel = 'Candidate';
    protected static ?string $pluralModelLabel = 'Candidates';

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

                // FIX : Select à la place du TextInput
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending'     => 'Pending',
                        'in_progress' => 'In Progress',
                        'validated'   => 'Validated',
                        'rejected'    => 'Rejected',
                    ])
                    ->default('pending'),

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
                    ->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'validated'   => 'success',
                        'rejected'    => 'danger',
                        'in_progress' => 'info',
                        default       => 'warning',
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
                    ->label('View CV')
                    ->icon('heroicon-o-document')
                    ->url(fn ($record) => $record->cv_path
                        ? asset('storage/' . $record->cv_path)
                        : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->cv_path !== null),

                Tables\Actions\Action::make('approuver')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve CV')
                    ->modalDescription('Are you sure you want to approve this candidate?')
                    ->action(function ($record) {
                        $record->update(['status' => 'validated']);
                        \Filament\Notifications\Notification::make()
                            ->title('Candidate approved!')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),

                Tables\Actions\Action::make('rejeter')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject CV')
                    ->modalDescription('Are you sure you want to reject this candidate?')
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        \Filament\Notifications\Notification::make()
                            ->title('Candidate rejected!')
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
            'index'  => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit'   => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
