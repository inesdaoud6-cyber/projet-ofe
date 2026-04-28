<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
<<<<<<< HEAD
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
=======
use App\Models\Group;
use App\Models\Question;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
<<<<<<< HEAD
    protected static ?string $navigationLabel = 'Tests';
=======
    protected static ?string $navigationGroup = 'Évaluations';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('admin.tests');
    }

    public static function getModelLabel(): string
    {
        return __('admin.test');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.tests');
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public static function form(Form $form): Form
    {
        return $form->schema([
<<<<<<< HEAD
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
=======
            Forms\Components\Section::make(__('admin.test_properties'))->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin.test_name'))
                    ->required()
                    ->placeholder('Ex : Test PHP Développeur Senior'),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.description'))
                    ->placeholder(__('admin.describe_skills')),
                Forms\Components\TextInput::make('eligibility_threshold')
                    ->label(__('admin.eligibility_threshold'))
                    ->numeric()
                    ->default(50),
                Forms\Components\TextInput::make('talent_threshold')
                    ->label(__('admin.talent_threshold'))
                    ->numeric()
                    ->default(80),
            ])->columns(2),
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('eligibility_threshold')->label('Eligibility %'),
                Tables\Columns\TextColumn::make('talent_threshold')->label('Talent %'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
=======
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.test_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('questions_count')
                    ->label(__('Questions'))
                    ->counts('questions')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('eligibility_threshold')
                    ->label(__('admin.eligibility_threshold'))
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('talent_threshold')
                    ->label(__('admin.talent_threshold'))
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Date'))
                    ->date('d/m/Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
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