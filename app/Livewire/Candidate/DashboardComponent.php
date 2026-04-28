<?php

namespace App\Livewire\Candidate;

<<<<<<< HEAD
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ApplicationProgress;
use App\Models\Candidate;
use App\Models\CandidateNotification;

#[Layout('components.layouts.app')]
=======
use App\Models\ApplicationProgress;
use App\Models\Candidate;
use App\Models\CandidateNotification;
use Livewire\Component;

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
class DashboardComponent extends Component
{
    public string $userName = '';
    public int $totalApplications = 0;
    public int $pendingApplications = 0;
    public int $completedApplications = 0;
    public $recentApplications;
    public int $unreadCount = 0;
    public bool $isAdminViewing = false;

    public function mount(): void
    {
        $this->loadData();
    }

    public function loadData(): void
    {
<<<<<<< HEAD
        $user      = auth()->user();
        if (!$user) return;
        
=======
        $user = auth()->user();
        if (! $user) return;

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
        $candidate = Candidate::where('user_id', $user->id)->first();

        $this->userName       = $user->name;
        $this->isAdminViewing = $user->can('view-all-applications');
        $this->unreadCount    = CandidateNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        if (! $candidate) {
            $this->recentApplications = collect();
            return;
        }

        $applications = ApplicationProgress::where('candidate_id', $candidate->id)
            ->with(['offre'])
            ->get();

        $this->totalApplications     = $applications->count();
        $this->pendingApplications   = $applications->where('status', 'pending')->count();
        $this->completedApplications = $applications->where('status', 'validated')->count();
        $this->recentApplications    = $applications->sortByDesc('created_at')->take(5);
    }

    public function refreshData(): void
    {
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.candidate.dashboard-component');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
