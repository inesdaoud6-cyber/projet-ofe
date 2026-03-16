<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
    \Filament\Forms\Components\Section::make('Contenu de la question')
    ->schema([
        \Filament\Forms\Components\Textarea::make('question_fr')
            ->label('Question (langue principale)')
            ->required()
            ->live(debounce: 1000)
            ->afterStateUpdated(function ($state, callable $set) {
                if (!empty($state)) {
                    $translations = \App\Services\TranslationService::translateToAll($state);
                    $set('question_en', $translations['en']);
                    $set('question_ar', $translations['ar']);
                }
            })
            ->columnSpanFull(),

        \Filament\Forms\Components\Textarea::make('question_en')
            ->label('Question (EN) — traduit automatiquement')
            ->disabled()
            ->columnSpanFull(),

        \Filament\Forms\Components\Textarea::make('question_ar')
            ->label('Question (AR) — traduit automatiquement')
            ->disabled()
            ->columnSpanFull(),
    ]),
        \Filament\Forms\Components\Section::make('Configuration')
            ->schema([
                \Filament\Forms\Components\Select::make('block_id')
                ->label('Bloc')
             ->options(\App\Models\Block::pluck('name', 'id'))
             ->searchable(),

        \Filament\Forms\Components\Select::make('group_id')
            ->label('Groupe')
            ->options(\App\Models\Group::pluck('name', 'id'))
            ->searchable(),
                \Filament\Forms\Components\Select::make('component')
                    ->label('Type de réponse')
                    ->options([
                        'radio' => 'Radio',
                        'list'  => 'Liste',
                        'text'  => 'Texte',
                        'date'  => 'Date',
                        'photo' => 'Photo',
                    ])->required()->reactive(),
                \Filament\Forms\Components\Select::make('level')
                    ->label('Niveau')
                    ->options([1 => 'Level 1', 2 => 'Level 2', 3 => 'Level 3'])
                    ->required(),
                \Filament\Forms\Components\Select::make('classification')
                    ->label('Classification')
                    ->options(['primary' => 'Main', 'secondary' => 'Secondary'])
                    ->required(),
                \Filament\Forms\Components\Toggle::make('obligatory')->label('Obligatoire'),
                \Filament\Forms\Components\Toggle::make('scorable')->label('Notée'),
                \Filament\Forms\Components\Toggle::make('auto_evaluation')->label('Auto-évaluation'),
                \Filament\Forms\Components\TextInput::make('max_note')
                    ->label('Note maximale')->numeric(),
                \Filament\Forms\Components\TextInput::make('second_ratio')
                    ->label('Ratio secondaire')->numeric(),
                \Filament\Forms\Components\Textarea::make('user_note')
                    ->label('Remarque utilisateur'),
                \Filament\Forms\Components\Textarea::make('note_rule')
                    ->label('Règle de calcul'),
            ]),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
