<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cv_path')
                    ->maxLength(255),
                Forms\Components\TextInput::make('photo_path')
                    ->maxLength(255),
                Forms\Components\TextInput::make('current_level_id')
                    ->numeric(),
                Forms\Components\TextInput::make('current_level')
                    ->required(),
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
            \Filament\Tables\Columns\TextColumn::make('user.name')
                ->label('Nom')
                ->searchable(),
            \Filament\Tables\Columns\TextColumn::make('user.email')
                ->label('Email')
                ->searchable(),
            \Filament\Tables\Columns\TextColumn::make('status')
                ->label('Statut')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'approved' => 'success',
                    'rejected' => 'danger',
                    default => 'warning',
                }),
            \Filament\Tables\Columns\IconColumn::make('cv_path')
                ->label('CV')
                ->boolean()
                ->trueIcon('heroicon-o-document')
                ->falseIcon('heroicon-o-x-mark'),
            \Filament\Tables\Columns\TextColumn::make('created_at')
                ->label('Date')
                ->dateTime()
                ->sortable(),
        ])
        ->actions([
            \Filament\Tables\Actions\Action::make('voir_cv')
                ->label('Voir CV')
                ->icon('heroicon-o-document')
                ->url(fn ($record) => $record->cv_path 
                    ? asset('storage/' . $record->cv_path) 
                    : null)
                ->openUrlInNewTab()
                ->visible(fn ($record) => $record->cv_path !== null),
            \Filament\Tables\Actions\EditAction::make(),
        ]);
}


    public static function getRelations(): array
    {
        return [
            //
        ];
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
