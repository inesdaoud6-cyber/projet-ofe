<?php

namespace App\Filament\Candidate\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Actions\Action;
use App\Models\Candidate;
use Filament\Notifications\Notification;

class UploadCV extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.candidate.pages.upload-c-v';
    protected static ?string $title = 'Upload My CV';
    protected static ?string $slug = 'upload-cv';

    public ?array $data = [];

    public function mount(): void
    {
        $candidate = Candidate::where('user_id', auth()->id())->first();
        if ($candidate) {
            $this->form->fill([
                'cv_path' => $candidate->cv_path,
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\FileUpload::make('cv_path')
                    ->label('Upload CV')
                    ->acceptedFileTypes(['application/pdf', 'application/msword'])
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
                'first_name' => auth()->user()->name ?? 'Unknown',
                'last_name' => '',
                'email' => auth()->user()->email,
            ]
        );

        $candidate->update(['cv_path' => $data['cv_path']]);

        Notification::make()
            ->title('CV uploaded successfully!')
            ->success()
            ->send();

        $this->redirect('/candidate/dashboard');
    }
}