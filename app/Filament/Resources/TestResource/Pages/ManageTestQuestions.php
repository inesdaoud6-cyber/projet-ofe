<?php

namespace App\Filament\Resources\TestResource\Pages;

use App\Filament\Resources\TestResource;
use App\Models\Group;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class ManageTestQuestions extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected static ?string $title = 'Gérer les questions';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Questions du test')->schema([
                Forms\Components\Select::make('filter_group_id')
                    ->label('Filtrer par Groupe')
                    ->options(Group::pluck('name', 'id'))
                    ->placeholder('Tous les groupes')
                    ->live()
                    ->dehydrated(false),

                Forms\Components\CheckboxList::make('questions')
                    ->label('Sélectionner les Questions')
                    ->relationship('questions', 'question_fr')
                    ->options(function (Get $get) {
                        $groupId = $get('filter_group_id');
                        $query = Question::query();
                        if ($groupId) {
                            $query->where('group_id', $groupId);
                        }
                        return $query->get()->mapWithKeys(function ($question) {
                            $group = $question->group?->name ?? '—';
                            $label = "[{$group}] " . \Illuminate\Support\Str::limit($question->question_fr, 80);
                            return [$question->id => $label];
                        });
                    })
                    ->bulkToggleable()
                    ->columns(1)
                    ->gridDirection('row')
                    ->helperText('Utilisez le filtre pour affiner la liste des questions.'),
            ]),
        ]);
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Questions mises à jour avec succès')
            ->success();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back_to_view')
                ->label('← Retour aux détails')
                ->url(fn () => TestResource::getUrl('view', ['record' => $this->record]))
                ->color('gray'),
        ];
    }
}