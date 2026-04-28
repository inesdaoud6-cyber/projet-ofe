<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Models\Candidate;
<<<<<<< HEAD
=======
use App\Models\CandidateNotification;
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

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
<<<<<<< HEAD
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
=======
    protected static ?string $navigationGroup = 'Recrutement';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('nav.candidates');
    }

    public static function getModelLabel(): string
    {
        return __('nav.candidate');
    }

    public static function getPluralModelLabel(): string
    {
        return __('nav.candidates');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin.personal_info'))->schema([
                Forms\Components\TextInput::make('first_name')->label(__('First Name'))->required(),
                Forms\Components\TextInput::make('last_name')->label(__('Last Name'))->required(),
                Forms\Components\TextInput::make('phone')->label(__('admin.phone'))->tel(),
            ])->columns(3),

            Forms\Components\Section::make(__('admin.status_scores'))->schema([
                Forms\Components\Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'pending'     => __('Pending'),
                        'in_progress' => __('In Progress'),
                        'validated'   => __('Validated'),
                        'rejected'    => __('Rejected'),
                    ])
                    ->default('pending'),
                Forms\Components\TextInput::make('primary_score')->label(__('admin.primary_score'))->numeric(),
                Forms\Components\TextInput::make('secondary_score')->label(__('admin.secondary_score'))->numeric(),
            ])->columns(3),
        ]);
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
<<<<<<< HEAD
                    ->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
=======
                    ->label(__('admin.full_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('admin.phone')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending'     => __('Pending'),
                        'in_progress' => __('In Progress'),
                        'validated'   => __('Validated'),
                        'rejected'    => __('Rejected'),
                        default       => $state,
                    })
                    ->color(fn ($state) => match ($state) {
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
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
<<<<<<< HEAD
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
=======
                Tables\Columns\TextColumn::make('primary_score')
                    ->label(__('Score')),
                Tables\Columns\TextColumn::make('user.created_at')
                    ->label(__('Date'))
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options([
                        'pending'     => __('Pending'),
                        'in_progress' => __('In Progress'),
                        'validated'   => __('Validated'),
                        'rejected'    => __('Rejected'),
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('voir_cv')
                    ->label(__('admin.view_cv'))
                    ->icon('heroicon-o-document')
                    ->color('info')
                    ->url(fn ($record) => $record->cv_path ? asset('storage/' . $record->cv_path) : null)
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->cv_path !== null),

                Tables\Actions\Action::make('approuver')
<<<<<<< HEAD
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
=======
                    ->label(__('admin.approve'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'validated']);
                        CandidateNotification::create([
                            'user_id' => $record->user_id,
                            'type'    => 'validated',
                            'title'   => '✅ ' . __('admin.profile_approved'),
                            'message' => __('admin.profile_approved_msg'),
                        ]);
                        Notification::make()->title(__('admin.approved_notif'))->success()->send();
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),

                Tables\Actions\Action::make('rejeter')
<<<<<<< HEAD
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
=======
                    ->label(__('admin.reject'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'rejected']);
                        CandidateNotification::create([
                            'user_id' => $record->user_id,
                            'type'    => 'rejected',
                            'title'   => '❌ ' . __('admin.profile_rejected'),
                            'message' => __('admin.profile_rejected_msg'),
                        ]);
                        Notification::make()->title(__('admin.rejected_notif'))->danger()->send();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),

                Tables\Actions\Action::make('notifier_offre')
                    ->label(__('admin.notify_offer'))
                    ->icon('heroicon-o-bell')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('offre_id')
                            ->label(__('admin.suggest_offer'))
                            ->options(\App\Models\Offre::where('is_published', true)->pluck('title', 'id'))
                            ->required(),
                        Forms\Components\Textarea::make('message_custom')
                            ->label(__('admin.custom_message'))
                            ->placeholder(__('admin.custom_message_placeholder')),
                    ])
                    ->action(function ($record, array $data) {
                        $offre = \App\Models\Offre::find($data['offre_id']);
                        CandidateNotification::create([
                            'user_id'  => $record->user_id,
                            'type'     => 'offre',
                            'title'    => '💼 ' . __('admin.new_offer_title'),
                            'message'  => $data['message_custom'] ?: __('admin.new_offer_msg', ['title' => $offre->title]),
                            'offre_id' => $data['offre_id'],
                        ]);
                        Notification::make()->title(__('admin.notif_sent'))->success()->send();
                    }),

                Tables\Actions\EditAction::make()->label(__('Edit')),
            ])
            ->bulkActions([]);
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    }

    public static function getPages(): array
    {
        return [
<<<<<<< HEAD
            'index'  => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit'   => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
=======
            'index' => Pages\ListCandidates::route('/'),
            'edit'  => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
