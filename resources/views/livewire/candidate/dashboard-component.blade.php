<div>
    @vite('resources/css/candidate-dashboard.css')

    @if($isAdminViewing)
    <div style="background:#fef3c7;border:1px solid #f59e0b;border-radius:10px;padding:0.75rem 1.25rem;margin-bottom:1.5rem;display:flex;align-items:center;justify-content:space-between;">
        <span style="color:#92400e;font-weight:600;">🛡️ Vous consultez cet espace en tant qu'administrateur</span>
        <a href="/admin" style="background:#f59e0b;color:#fff;padding:0.35rem 0.9rem;border-radius:6px;font-size:0.85rem;text-decoration:none;">← {{ __('Back to admin') }}</a>
    </div>
    @endif

    <div class="dash-hero">
        <div>
            <h1>👋 {{ __('Hello') }}, {{ $userName }} !</h1>
            <p>{{ __('Welcome to your candidate space. Manage your applications easily.') }}</p>
        </div>
        <a href="/candidate/notifications" class="dash-notif-btn">
            <span class="dash-notif-icon">🔔</span>
            @if($unreadCount > 0)
            <span class="dash-notif-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
            @endif
        </a>
    </div>

    <div class="dash-cards">
        <div class="dash-card">
            <div class="dash-card-icon blue">📋</div>
            <div>
                <div class="dash-card-value">{{ $totalApplications }}</div>
                <div class="dash-card-label">{{ __('Total applications') }}</div>
            </div>
        </div>
        <div class="dash-card">
            <div class="dash-card-icon cyan">⏳</div>
            <div>
                <div class="dash-card-value">{{ $pendingApplications }}</div>
                <div class="dash-card-label">{{ __('Pending') }}</div>
            </div>
        </div>
        <div class="dash-card">
            <div class="dash-card-icon purple">✅</div>
            <div>
                <div class="dash-card-value">{{ $completedApplications }}</div>
                <div class="dash-card-label">{{ __('Validated') }}</div>
            </div>
        </div>
    </div>

    <div class="dash-actions">
        <a href="/candidate/choix-candidature" class="dash-btn dash-btn-primary">🚀 {{ __('New application') }}</a>
        <a href="/candidate/take-test" class="dash-btn dash-btn-secondary">📝 {{ __('Take the test') }}</a>
    </div>

    <div class="dash-table-section">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <div class="dash-table-title">📌 {{ __('Recent applications') }}</div>
            <button wire:click="refreshData"
                wire:loading.attr="disabled"
                wire:target="refreshData"
                style="display:flex;align-items:center;gap:0.4rem;padding:0.35rem 0.9rem;border-radius:8px;border:1.5px solid #ede9fe;background:white;color:#1a1a8c;font-size:0.8rem;font-weight:700;cursor:pointer;">
                <span wire:loading.remove wire:target="refreshData">🔄 {{ __('Actualiser') }}</span>
                <span wire:loading wire:target="refreshData">⏳</span>
            </button>
        </div>

        @if($recentApplications && $recentApplications->count() > 0)
        <div class="app-cards-grid">
            @foreach($recentApplications as $app)
            <div class="app-card">
                <div class="app-card-header">
                    <span class="app-card-candidate">{{ $userName }}</span>
                    <span class="badge badge-{{ $app->status }}">
                        {{ match($app->status) {
                            'pending'     => __('Pending'),
                            'in_progress' => __('In Progress'),
                            'validated'   => __('Validated'),
                            'rejected'    => __('Rejected'),
                            default       => $app->status
                        } }}
                    </span>
                </div>
                <div class="app-card-title">
                    {{ $app->offre?->title ?? __('Open application') }}
                </div>
                <div class="app-card-meta">
                    <span>{{ __('Level') }} {{ $app->current_level }}</span>
                    <span style="font-weight:700;color:#1a1a8c;">{{ $app->main_score }}/100</span>
                </div>
                <div class="app-card-footer">
                    <span class="app-card-date">{{ $app->created_at->diffForHumans() }}</span>
                    <a href="/candidate/applications" class="app-card-details-btn">
                        {{ __('View details') }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">{{ __('No applications yet.') }}</div>
        @endif
    </div>
</div>