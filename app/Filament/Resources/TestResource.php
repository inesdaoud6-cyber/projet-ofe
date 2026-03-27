<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
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
            Forms\Components\Section::make('Test Information')->schema([
                Forms\Components\TextInput::make('name')->label('Test Name')->required()
                    ->placeholder('Ex: PHP Senior Developer Test'),
                Forms\Components\Textarea::make('description')->label('Description')
                    ->placeholder('Describe the skills evaluated...'),
                Forms\Components\TextInput::make('eligibility_threshold')
                    ->label('Eligibility Threshold (%)')->numeric()->default(50)
                    ->helperText('Minimum score to enable the "I apply" button'),
                Forms\Components\TextInput::make('talent_threshold')
                    ->label('Talent Threshold (%)')->numeric()->default(80)
                    ->helperText('Score to flag a high potential profile'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('eligibility_threshold')->label('Eligibility %'),
                Tables\Columns\TextColumn::make('talent_threshold')->label('Talent %'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit'   => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}