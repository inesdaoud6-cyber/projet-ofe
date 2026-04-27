@extends('layouts.app')

@section('title', 'Staffing2Earn')

@section('content')

    <section class="hero">
        <div class="hero-bg"></div>
        <div class="orb-1 hero-orb"></div>
        <div class="orb-2 hero-orb"></div>
        <div class="orb-3 hero-orb"></div>

        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    {{ __('Smart Tests') }}
                </div>

                <h1>
                    {{ __('Welcome to Staffing2Earn') }}<br>
                    <span class="accent">{{ __('Candidate Management') }}</span>
                </h1>

                <p class="hero-desc">
                    {{ __('An intelligent recruitment platform that connects talent with the best opportunities.') }}
                </p>

                <div class="hero-actions">
                    <a href="{{ route('auth.login') }}" class="btn-primary">
                        {{ __('Get Started') }}
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>

                    <a href="#how" class="btn-secondary">
                        {{ __('About') }}
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-num">100%</div>
                        <div class="stat-label">{{ __('In Progress') }}</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-num">{{ __('Smart Tests') }}</div>
                        <div class="stat-label">{{ __('Take the Test') }}</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-num">{{ __('Validated') }}</div>
                        <div class="stat-label">{{ __('Score') }}</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="card-float card-float-top">
                    <div class="card-header">
                        <div class="card-icon icon-navy">📋</div>
                        <div>
                            <div class="card-title">{{ __('My Applications') }}</div>
                            <div class="card-sub">{{ __('In Progress') }}</div>
                        </div>
                    </div>

                    <div class="progress-bar">
                        <div class="progress-fill fill-navy"></div>
                    </div>
                    <div class="progress-label">
                        <span>{{ __('Questions') }}</span>
                        <span>78%</span>
                    </div>

                    <div style="margin-top:10px">
                        <div class="progress-bar">
                            <div class="progress-fill fill-magenta"></div>
                        </div>
                        <div class="progress-label">
                            <span>{{ __('Score') }}</span>
                            <span>{{ __('Validated') }}</span>
                        </div>
                    </div>

                    <div style="margin-top:10px">
                        <div class="progress-bar">
                            <div class="progress-fill fill-cyan"></div>
                        </div>
                        <div class="progress-label">
                            <span>{{ __('Status') }}</span>
                            <span>65%</span>
                        </div>
                    </div>
                </div>

                <div class="card-float card-float-bottom">
                    <div class="card-header">
                        <div class="card-icon icon-magenta">💼</div>
                        <div>
                            <div class="card-title">{{ __('Apply to an Offer') }}</div>
                            <div class="card-sub">{{ __('Start New Application') }}</div>
                        </div>
                    </div>

                    <div class="offre-row">
                        <div class="offre-dot dot-navy"></div>
                        <div>
                            <div class="offre-title">{{ __('Free Application') }}</div>
                            <div class="offre-domain">Tech</div>
                        </div>
                        <span class="badge-new">{{ __('Pending') }}</span>
                    </div>

                    <div class="offre-row">
                        <div class="offre-dot dot-magenta"></div>
                        <div>
                            <div class="offre-title">{{ __('Apply to an Offer') }}</div>
                            <div class="offre-domain">Management</div>
                        </div>
                        <span class="badge-new">{{ __('In Progress') }}</span>
                    </div>

                    <div class="offre-row">
                        <div class="offre-dot dot-cyan"></div>
                        <div>
                            <div class="offre-title">{{ __('Smart Tests') }}</div>
                            <div class="offre-domain">Finance</div>
                        </div>
                        <span class="badge-new">{{ __('Validated') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="avantages">
        <div class="section-tag">{{ __('About Staffing2Earn') }}</div>
        <h2 class="section-title">{{ __('Candidate Management') }}</h2>

        <p class="section-desc">
            {{ __('An intelligent recruitment platform that connects talent with the best opportunities.') }}
        </p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon fi-1">🎯</div>
                <div class="feature-title">{{ __('Smart Tests') }}</div>
                <p class="feature-desc">{{ __('Create and manage multi-level assessment tests') }}</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-2">⏱️</div>
                <div class="feature-title">{{ __('Track candidates throughout recruitment') }}</div>
                <p class="feature-desc">{{ __('Analyze performance and results easily') }}</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-3">✅</div>
                <div class="feature-title">{{ __('Test Results') }}</div>
                <p class="feature-desc">
                    {{ __('This is your personal recruitment space. Start your journey with us today.') }}</p>
            </div>
        </div>
    </section>

    <section class="how" id="how">
        <div class="section-tag">{{ __('Status') }}</div>
        <h2 class="section-title">{{ __('Start Your First Application') }}</h2>

        <p class="section-desc">
            {{ __('Apply without a specific offer. The admin will suggest a suitable test for you.') }}
        </p>

        <div class="steps">
            <div class="step">
                <div class="step-num sn1">1</div>
                <div class="step-title">{{ __('Apply to an Offer') }}</div>
                <p class="step-desc">{{ __('Apply to a specific job offer published by the company.') }}</p>
            </div>

            <div class="step">
                <div class="step-num sn2">2</div>
                <div class="step-title">{{ __('Submit My CV') }}</div>
                <p class="step-desc">{{ __('Upload your CV') }}</p>
            </div>

            <div class="step">
                <div class="step-num sn3">3</div>
                <div class="step-title">{{ __('Take the Test') }}</div>
                <p class="step-desc">{{ __('Answer all questions then click "Submit"') }}</p>
            </div>

            <div class="step">
                <div class="step-num sn4">4</div>
                <div class="step-title">{{ __('Test Results') }}</div>
                <p class="step-desc">{{ __('View Results') }}</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-orb cta-orb-1"></div>
        <div class="cta-orb cta-orb-2"></div>

        <div class="cta-inner">
            <h2>{{ __('Welcome to Staffing2Earn') }}</h2>

            <p>{{ __('An intelligent recruitment platform that connects talent with the best opportunities.') }}</p>

            <a href="{{ route('auth.login') }}" class="btn-cta">
                {{ __('Get Started') }}
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </section>

@endsection