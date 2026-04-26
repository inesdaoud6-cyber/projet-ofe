<?php

namespace App\Filament\Candidate\Pages;

use App\Models\Temoignage;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class MonTemoignage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static string $view = 'filament.candidate.pages.mon-temoignage';
    protected static ?string $slug = 'mon-temoignage';
    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('nav.testimonials');
    }

    public function getTitle(): string
    {
        return __('nav.testimonials');
    }

    public ?array $data = [];
    public ?Temoignage $existing = null;

    public function mount(): void
    {
        $this->existing = Temoignage::where('user_id', auth()->id())->first();

        $this->form->fill([
            'contenu' => $this->existing?->contenu ?? '',
            'note'    => $this->existing?->note ?? 5,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('nav.testimonial'))->schema([
                    Textarea::make('contenu')
                        ->label(__('admin.content'))
                        ->placeholder(__('temoignage.placeholder'))
                        ->required()
                        ->rows(5)
                        ->maxLength(1000),

                    Select::make('note')
                        ->label(__('admin.rating'))
                        ->options([
                            1 => '⭐ 1 — ' . __('temoignage.very_bad'),
                            2 => '⭐⭐ 2 — ' . __('temoignage.bad'),
                            3 => '⭐⭐⭐ 3 — ' . __('temoignage.average'),
                            4 => '⭐⭐⭐⭐ 4 — ' . __('temoignage.good'),
                            5 => '⭐⭐⭐⭐⭐ 5 — ' . __('temoignage.excellent'),
                        ])
                        ->default(5)
                        ->required(),
                ])->columns(1),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        Temoignage::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'contenu'     => $data['contenu'],
                'note'        => $data['note'],
                'is_approved' => false,
            ]
        );

        $this->existing = Temoignage::where('user_id', auth()->id())->first();

        Notification::make()
            ->title(__('temoignage.saved'))
            ->success()
            ->send();
    }
}