<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OffreResource\Pages;
use App\Models\Offre;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OffreResource extends Resource
{
    protected static ?string $model = Offre::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Job Offers';
    protected static ?string $modelLabel = 'Job Offer';
    protected static ?string $pluralModelLabel = 'Job Offers';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Offer Information')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Title')->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Description')->required(),
                    Forms\Components\TextInput::make('domain')
                        ->label('Domain'),
                    Forms\Components\TextInput::make('location')
                        ->label('Location'),
                    Forms\Components\Select::make('contract_type')
                        ->label('Contract Type')
                        ->options([
                            'CDI' => 'CDI',
                            'CDD' => 'CDD',
                            'Stage' => 'Internship',
                            'Freelance' => 'Freelance',
                        ]),
                    Forms\Components\DatePicker::make('deadline')
                        ->label('Deadline'),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publish Offer'),
                ]),

            Forms\Components\Section::make('Associated Test')
                ->schema([
                    Forms\Components\Select::make('test_id')
                        ->label('Select Test')
                        ->options(Test::pluck('name', 'id'))
                        ->searchable()
                        ->placeholder('Select a test...'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->label('Domain'),
                Tables\Columns\TextColumn::make('contract_type')
                    ->label('Contract')->badge(),
                Tables\Columns\TextColumn::make('test.name')
                    ->label('Associated Test')->default('None'),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')->boolean(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffres::route('/'),
            'create' => Pages\CreateOffre::route('/create'),
            'edit' => Pages\EditOffre::route('/{record}/edit'),
        ];
    }
}