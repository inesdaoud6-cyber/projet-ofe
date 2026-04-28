<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
<<<<<<< HEAD
=======
use App\Models\Block;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;
<<<<<<< HEAD
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Groups';
=======
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Configuration';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.groups');
    }

    public static function getModelLabel(): string
    {
        return __('admin.group');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.groups');
    }
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    public static function form(Form $form): Form
    {
        return $form->schema([
<<<<<<< HEAD
            Forms\Components\TextInput::make('name')->required()->maxLength(255)->label('Name'),
            Forms\Components\TextInput::make('order')->required()->numeric()->default(0)->label('Order'),
            Forms\Components\Select::make('block_id')->relationship('block', 'name')->required()->label('Block'),
=======
            Forms\Components\Select::make('block_id')
                ->label('Block')
                ->options(Block::pluck('name', 'id'))
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('name')
                ->label(__('admin.group_name'))
                ->required(),
            Forms\Components\TextInput::make('order')
                ->label(__('admin.order'))
                ->numeric()
                ->default(0),
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('block.name')->label('Block')->searchable(),
                Tables\Columns\TextColumn::make('order')->label('Order')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array { return []; }

=======
                Tables\Columns\TextColumn::make('block.name')
                    ->label('Block')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.group_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('admin.order'))
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__('admin.delete')),
            ]);
    }

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit'   => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}