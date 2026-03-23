<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Tests';

    public static function form(Form $form): Form
    {
        return $form->schema([
           Forms\Components\Section::make('Informations du test')
    ->schema([
        Forms\Components\TextInput::make('name')
            ->label('Nom du test')
            ->required()
            ->placeholder('Ex: Test Développeur PHP Senior, Test Marketing Manager...'),
        Forms\Components\Textarea::make('description')
            ->label('Description du test')
            ->placeholder('Décrivez les compétences évaluées dans ce test...'),
        Forms\Components\Select::make('offre_id')
            ->label('Offre d\'emploi liée')
            ->options(\App\Models\Offre::where('is_published', true)->pluck('title', 'id'))
            ->searchable()
            ->placeholder('Sélectionner une offre...'),
        Forms\Components\TextInput::make('eligibility_threshold')
            ->label('Seuil d\'éligibilité (%)')
            ->numeric()->default(50)
            ->helperText('Score minimum pour activer le bouton "I apply"'),
        Forms\Components\TextInput::make('talent_threshold')
            ->label('Seuil talent (%)')
            ->numeric()->default(80)
            ->helperText('Score pour notifier l\'admin d\'un profil à fort potentiel'),
    ]),
            Forms\Components\Section::make('Blocs du test')
                ->schema([
                    Forms\Components\CheckboxList::make('blocks')
                        ->label('Choisir les blocs de questions')
                        ->options(Block::pluck('name', 'id'))
                        ->columns(2),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')->searchable(),
                Tables\Columns\TextColumn::make('eligibility_threshold')
                    ->label('Seuil éligibilité'),
                Tables\Columns\TextColumn::make('talent_threshold')
                    ->label('Seuil talent'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')->date(),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}