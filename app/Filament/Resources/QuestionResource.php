<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Block;
use App\Models\Group;
use App\Models\Question;
use App\Services\TranslationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Questions';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Question Content')->schema([
                Forms\Components\Textarea::make('question_fr')
                    ->label('Question (Main Language)')->required()
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $translations = TranslationService::translateToAll($state);
                            $set('question_en', $translations['en']);
                            $set('question_ar', $translations['ar']);
                        }
                    })->columnSpanFull(),
                Forms\Components\Textarea::make('question_en')
                    ->label('Question (EN) — auto-translated')->disabled()->columnSpanFull(),
                Forms\Components\Textarea::make('question_ar')
                    ->label('Question (AR) — auto-translated')->disabled()->columnSpanFull(),
            ]),
            Forms\Components\Section::make('Configuration')->schema([
                Forms\Components\Select::make('block_id')->label('Block')
                    ->options(Block::pluck('name', 'id'))->searchable(),
                Forms\Components\Select::make('group_id')->label('Group')
                    ->options(Group::pluck('name', 'id'))->searchable(),
                Forms\Components\Select::make('component')->label('Response Type')
                    ->options(['radio' => 'Radio', 'list' => 'List', 'text' => 'Text', 'date' => 'Date', 'photo' => 'Photo'])
                    ->required()->live(),
                Forms\Components\TagsInput::make('possible_answers')->label('Possible Answers')
                    ->placeholder('Add an answer...')
                    ->visible(fn ($get) => in_array($get('component'), ['radio', 'list'])),
                Forms\Components\Select::make('level')->label('Level')
                    ->options([1 => 'Level 1', 2 => 'Level 2', 3 => 'Level 3'])->required(),
                Forms\Components\Select::make('classification')->label('Classification')
                    ->options(['primary' => 'Main', 'secondary' => 'Secondary'])->required(),
                Forms\Components\Toggle::make('obligatory')->label('Mandatory'),
                Forms\Components\Toggle::make('scorable')->label('Scored'),
                Forms\Components\Toggle::make('auto_evaluation')->label('Self-assessment'),
                Forms\Components\TextInput::make('max_note')->label('Maximum Score')->numeric()->default(0),
                Forms\Components\TextInput::make('second_ratio')->label('Secondary Ratio')->numeric()->default(0),
                Forms\Components\Textarea::make('user_note')->label('User Note'),
                Forms\Components\Textarea::make('note_rule')->label('Scoring Rule'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_fr')->label('Question')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('component')->label('Type')->badge(),
                Tables\Columns\TextColumn::make('level')->label('Level')->badge(),
                Tables\Columns\TextColumn::make('classification')->label('Classification')->badge(),
                Tables\Columns\IconColumn::make('scorable')->label('Scored')->boolean(),
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
            'index'  => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit'   => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}