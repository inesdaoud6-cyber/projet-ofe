<?php

namespace App\Filament\Candidate\Pages;

use App\Models\Candidate;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class UploadCV extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static string $view = 'filament.candidate.pages.upload-c-v';
    protected static ?string $title = 'Upload My CV';
    protected static ?string $slug = 'upload-cv';

    public ?array $data = [];

    public function mount(): void
    {
        $candidate = Candidate::where('user_id', auth()->id())->first();

        $this->form->fill([
            'cv_path' => $candidate?->cv_path,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('cv_path')
                    ->label('Upload CV')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->maxSize(5120)
                    ->required(),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        $candidate = Candidate::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'first_name' => auth()->user()->name,
                'last_name'  => '',
                'email'      => auth()->user()->email,
            ]
        );

        $candidate->update(['cv_path' => $data['cv_path']]);

        Notification::make()->title('CV uploaded successfully!')->success()->send();

        $this->redirect(route('filament.candidate.pages.dashboard'));
    }
}