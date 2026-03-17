<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use App\Models\Candidate;
use Filament\Notifications\Notification;

class UploadCV extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static string $view = 'filament.candidate.pages.upload-c-v';
    protected static ?string $title = 'Upload mon CV';
    protected static ?string $slug = 'upload-cv';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Mon CV')
                    ->schema([
                        FileUpload::make('cv')
                            ->label('Télécharger mon CV')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

  public function submit(): void
{
    $data = $this->form->getState();

    Candidate::updateOrCreate(
        ['user_id' => auth()->id()],
        [
            'cv_path' => $data['cv'],
            'first_name' => auth()->user()->name ?? 'N/A',
            'last_name' => '',
        ]
    );

    Notification::make()
        ->title('CV uploadé avec succès !')
        ->success()
        ->send();

    $this->redirect('/candidate/dashboard');
}
}