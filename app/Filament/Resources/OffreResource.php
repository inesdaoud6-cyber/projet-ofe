<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OffreResource\Pages;
<<<<<<< HEAD
use App\Models\Offre;
use App\Models\Test;
=======
use App\Models\CandidateNotification;
use App\Models\Offre;
use App\Models\Test;
use App\Models\User;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
<<<<<<< HEAD
=======
use Filament\Notifications\Notification;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

class OffreResource extends Resource
{
    protected static ?string $model = Offre::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
<<<<<<< HEAD
    protected static ?string $navigationLabel = 'Job Offers';
    protected static ?string $modelLabel = 'Job Offer';
    protected static ?string $pluralModelLabel = 'Job Offers';
=======
    protected static ?string $navigationGroup = 'Recrutement';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('nav.job_offers');
    }

    public static function getModelLabel(): string
    {
        return __('nav.job_offer');
    }

    public static function getPluralModelLabel(): string
    {
        return __('nav.job_offers');
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public static function form(Form $form): Form
    {
        return $form->schema([
<<<<<<< HEAD
            Forms\Components\Section::make('Offer Information')->schema([
                Forms\Components\TextInput::make('title')->label('Title')->required(),
                Forms\Components\Textarea::make('description')->label('Description')->required(),
                Forms\Components\TextInput::make('domain')->label('Domain'),
                Forms\Components\TextInput::make('location')->label('Location'),
                Forms\Components\Select::make('contract_type')->label('Contract Type')
                    ->options(['CDI' => 'CDI', 'CDD' => 'CDD', 'Stage' => 'Internship', 'Freelance' => 'Freelance']),
                Forms\Components\DatePicker::make('deadline')->label('Deadline'),
                Forms\Components\Toggle::make('is_published')->label('Publish Offer'),
            ]),
            Forms\Components\Section::make('Associated Test')->schema([
                Forms\Components\Select::make('test_id')->label('Select Test')
                    ->options(Test::pluck('name', 'id'))->searchable()->placeholder('Select a test...'),
=======
            Forms\Components\Section::make(__('admin.offer_info'))->schema([
                Forms\Components\TextInput::make('title')->label(__('admin.title'))->required(),
                Forms\Components\Textarea::make('description')->label(__('admin.description'))->required(),
                Forms\Components\TextInput::make('domain')->label(__('admin.domain')),
                Forms\Components\TextInput::make('location')->label(__('admin.location')),
                Forms\Components\Select::make('contract_type')
                    ->label(__('admin.contract_type'))
                    ->options(['CDI' => 'CDI', 'CDD' => 'CDD', 'Stage' => 'Stage', 'Freelance' => 'Freelance']),
                Forms\Components\DatePicker::make('deadline')->label(__('admin.deadline')),
                Forms\Components\Toggle::make('is_published')->label(__('admin.publish')),
            ])->columns(2),

            Forms\Components\Section::make(__('admin.associated_test'))->schema([
                Forms\Components\Select::make('test_id')
                    ->label(__('admin.select_test'))
                    ->options(Test::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder(__('admin.choose_test')),
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('domain')->label('Domain'),
                Tables\Columns\TextColumn::make('contract_type')->label('Contract')->badge(),
                Tables\Columns\TextColumn::make('test.name')->label('Associated Test')->default('None'),
                Tables\Columns\IconColumn::make('is_published')->label('Published')->boolean(),
                Tables\Columns\TextColumn::make('deadline')->label('Deadline')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array { return []; }

=======
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->label(__('admin.domain')),
                Tables\Columns\TextColumn::make('contract_type')
                    ->label(__('admin.contract_type'))
                    ->badge(),
                Tables\Columns\TextColumn::make('test.name')
                    ->label(__('admin.associated_test'))
                    ->default(__('admin.none')),
                Tables\Columns\IconColumn::make('is_published')
                    ->label(__('admin.published'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('deadline')
                    ->label(__('admin.deadline'))
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('applicationProgresses_count')
                    ->label(__('admin.applications'))
                    ->counts('applicationProgresses'),
            ])
            ->actions([
                Tables\Actions\Action::make('notifier_tous')
                    ->label(__('admin.notify_candidates'))
                    ->icon('heroicon-o-bell')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading(__('admin.notify_all_heading'))
                    ->modalDescription(__('admin.notify_all_desc'))
                    ->action(function ($record) {
                        $candidats = User::where('is_admin', false)->get();
                        foreach ($candidats as $candidat) {
                            CandidateNotification::create([
                                'user_id'  => $candidat->id,
                                'type'     => 'offre',
                                'title'    => '💼 ' . __('admin.new_offer_published'),
                                'message'  => __('admin.new_offer_msg', ['title' => $record->title]),
                                'offre_id' => $record->id,
                            ]);
                        }
                        Notification::make()->title($candidats->count() . ' ' . __('admin.candidates_notified'))->success()->send();
                    })
                    ->visible(fn ($record) => $record->is_published),

                Tables\Actions\EditAction::make()->label(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
            ]);
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOffres::route('/'),
            'create' => Pages\CreateOffre::route('/create'),
            'edit'   => Pages\EditOffre::route('/{record}/edit'),
        ];
    }
}