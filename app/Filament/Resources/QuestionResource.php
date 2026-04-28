<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Block;
use App\Models\Group;
<<<<<<< HEAD
use App\Models\Question;
=======
use App\Models\Offre;
use App\Models\Question;
use App\Models\Test;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
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
<<<<<<< HEAD
    protected static ?string $navigationLabel = 'Questions';
=======
    protected static ?string $navigationGroup = 'Évaluations';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('Questions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.question');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Questions');
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public static function form(Form $form): Form
    {
        return $form->schema([
<<<<<<< HEAD
            Forms\Components\Section::make('Question Content')->schema([
                Forms\Components\Textarea::make('question_fr')
                    ->label('Question (Main Language)')->required()
=======
            Forms\Components\Section::make(__('admin.question_content'))->schema([
                Forms\Components\Textarea::make('question_fr')
                    ->label(__('admin.question_fr'))
                    ->required()
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $translations = TranslationService::translateToAll($state);
                            $set('question_en', $translations['en']);
                            $set('question_ar', $translations['ar']);
                        }
                    })->columnSpanFull(),
                Forms\Components\Textarea::make('question_en')
<<<<<<< HEAD
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
=======
                    ->label(__('admin.question_en'))
                    ->disabled()->columnSpanFull(),
                Forms\Components\Textarea::make('question_ar')
                    ->label(__('admin.question_ar'))
                    ->disabled()->columnSpanFull(),
            ]),

            Forms\Components\Section::make(__('admin.association'))->schema([
                Forms\Components\Select::make('block_id')
                    ->label('Block')
                    ->options(Block::pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                Forms\Components\Select::make('group_id')
                    ->label(__('admin.group'))
                    ->options(Group::pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                Forms\Components\Select::make('offre_id')
                    ->label(__('admin.associated_offer'))
                    ->options(Offre::where('is_published', true)->pluck('title', 'id'))
                    ->searchable()
                    ->nullable()
                    ->placeholder(__('admin.no_offer')),
            ])->columns(3),

            Forms\Components\Section::make(__('admin.configuration'))->schema([
                Forms\Components\Select::make('component')
                    ->label(__('admin.answer_type'))
                    ->options([
                        'radio' => __('admin.radio'),
                        'list'  => __('admin.list'),
                        'text'  => __('admin.free_text'),
                        'date'  => __('admin.date'),
                        'photo' => __('admin.photo'),
                    ])
                    ->required()
                    ->live(),

                Forms\Components\TagsInput::make('possible_answers')
                    ->label(__('admin.possible_answers'))
                    ->placeholder(__('admin.add_answer'))
                    ->visible(fn ($get) => in_array($get('component'), ['radio', 'list']))
                    ->live()
                    ->helperText(__('admin.press_enter')),

                Forms\Components\TextInput::make('level')
                    ->label(__('Level'))
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                    ->helperText(__('admin.level_hint')),

                Forms\Components\Select::make('classification')
                    ->label(__('admin.classification'))
                    ->options([
                        'primary'   => __('admin.primary'),
                        'secondary' => __('admin.secondary_class'),
                    ])
                    ->required(),

                Forms\Components\Toggle::make('obligatory')->label(__('admin.mandatory')),
                Forms\Components\Toggle::make('scorable')->label(__('admin.scored')),

                Forms\Components\Toggle::make('auto_evaluation')
                    ->label(__('admin.auto_correction'))
                    ->live(),

                Forms\Components\Select::make('correct_answer')
                    ->label(__('admin.correct_answer_select'))
                    ->options(fn ($get) => collect($get('possible_answers') ?? [])->mapWithKeys(fn ($a) => [$a => $a]))
                    ->visible(fn ($get) => (bool) $get('auto_evaluation') && in_array($get('component'), ['radio', 'list']))
                    ->searchable()
                    ->nullable(),

                Forms\Components\TextInput::make('correct_answer')
                    ->label(__('admin.correct_answer_text'))
                    ->visible(fn ($get) => (bool) $get('auto_evaluation') && $get('component') === 'text')
                    ->nullable(),

                Forms\Components\TextInput::make('max_note')->label(__('admin.max_score'))->numeric()->default(0),
                Forms\Components\TextInput::make('second_ratio')->label(__('admin.second_ratio'))->numeric()->default(0),
                Forms\Components\Textarea::make('user_note')->label(__('admin.candidate_note')),
                Forms\Components\Textarea::make('note_rule')->label(__('admin.scoring_rule')),
            ])->columns(2),
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('question_fr')->label('Question')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('component')->label('Type')->badge(),
                Tables\Columns\TextColumn::make('level')->label('Level')->badge(),
                Tables\Columns\TextColumn::make('classification')->label('Classification')->badge(),
                Tables\Columns\IconColumn::make('scorable')->label('Scored')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
=======
                Tables\Columns\TextColumn::make('question_fr')
                    ->label(__('admin.question'))
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('component')
                    ->label(__('admin.type'))
                    ->badge(),
                Tables\Columns\TextColumn::make('level')
                    ->label(__('Level'))
                    ->badge(),
                Tables\Columns\TextColumn::make('classification')
                    ->label(__('admin.classification'))
                    ->badge(),
                Tables\Columns\IconColumn::make('scorable')
                    ->label(__('admin.scored'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('auto_evaluation')
                    ->label('Auto')
                    ->boolean(),
                Tables\Columns\TextColumn::make('block.name')
                    ->label('Block')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('tests.name')
                    ->label(__('admin.tests'))
                    ->badge()
                    ->color('success')
                    ->separator(',')
                    ->placeholder(__('admin.no_test')),
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
            'index'  => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit'   => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}