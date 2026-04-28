<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Create Account') }} - Staffing2Earn</title>
    @vite(['resources/css/global.css', 'resources/css/navbar.css', 'resources/css/auth/register.css'])
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
            <h2>Staffing2Earn</h2>
        </div>
        <ul class="nav-links">
            <li><a href="/">{{ __('Home') }}</a></li>
            <li><a href="/#about">{{ __('About') }}</a></li>
            <li>
                <div style="display:flex;align-items:center;gap:4px;">
                    <a href="{{ route('lang.switch', 'fr') }}" style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale()==='fr' ? '#667eea' : '#d1d5db' }};background:{{ app()->getLocale()==='fr' ? '#667eea' : 'transparent' }};color:{{ app()->getLocale()==='fr' ? '#fff' : '#6b7280' }};">FR</a>
                    <a href="{{ route('lang.switch', 'en') }}" style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale()==='en' ? '#667eea' : '#d1d5db' }};background:{{ app()->getLocale()==='en' ? '#667eea' : 'transparent' }};color:{{ app()->getLocale()==='en' ? '#fff' : '#6b7280' }};">EN</a>
                    <a href="{{ route('lang.switch', 'ar') }}" style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale()==='ar' ? '#667eea' : '#d1d5db' }};background:{{ app()->getLocale()==='ar' ? '#667eea' : 'transparent' }};color:{{ app()->getLocale()==='ar' ? '#fff' : '#6b7280' }};">AR</a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="register-container">
        <h2>{{ __('Create your account') }}</h2>
        <p class="register-subtitle">{{ __('Join Staffing2Earn and find your next opportunity') }}</p>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

<<<<<<< HEAD
        <form method="POST" action="{{ route('auth.register.post') }}">
=======
        <form method="POST" action="{{ route('auth.register.post') }}" enctype="multipart/form-data">
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
            @csrf

            <div class="form-section">
                <h3 class="section-title">{{ __('Personal Information') }}</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">{{ __('First Name') }} <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name"
                            value="{{ old('first_name') }}" required autofocus
                            placeholder="{{ __('John') }}">
                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">{{ __('Last Name') }} <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name"
                            value="{{ old('last_name') }}" required
                            placeholder="{{ __('Doe') }}">
                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">{{ __('Email Address') }} <span class="required">*</span></label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}" required
                        placeholder="john.doe@example.com">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">{{ __('Security') }}</h3>

                <div class="form-group">
                    <label for="password">{{ __('Password') }} <span class="required">*</span></label>
                    <div class="input-password">
                        <input type="password" id="password" name="password" required
                            placeholder="{{ __('Minimum 8 characters') }}">
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">👁</button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }} <span class="required">*</span></label>
                    <div class="input-password">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="{{ __('Repeat your password') }}">
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">👁</button>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
=======
            <div class="form-section">
                <h3 class="section-title">{{ __('Your CV') }}</h3>

                <div class="form-group">
                    <label for="cv_path">{{ __('Upload your CV') }} <span class="optional">({{ __('optional') }})</span></label>
                    <div class="file-upload-area" id="dropZone">
                        <input type="file" id="cv_path" name="cv_path"
                            accept=".pdf,.doc,.docx" class="file-input"
                            onchange="updateFileName(this)">
                        <div class="file-upload-label">
                            <span class="file-icon">📄</span>
                            <span id="fileLabel">{{ __('Click or drag your CV here') }}</span>
                            <small>PDF, DOC, DOCX — {{ __('Max 5MB') }}</small>
                        </div>
                    </div>
                    @error('cv_path')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
            <button type="submit" class="btn-register">
                {{ __('Create my account') }} →
            </button>
        </form>

        <div class="back-link">
            {{ __('Already have an account?') }}
            <a href="{{ route('auth.login') }}">{{ __('Login') }}</a>
        </div>

        <div class="back-link" style="margin-top: 0.5rem;">
            <a href="/">← {{ __('Back to home') }}</a>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
<<<<<<< HEAD
=======

        function updateFileName(input) {
            const label = document.getElementById('fileLabel');
            label.textContent = input.files[0]?.name ?? '{{ __('Click or drag your CV here') }}';
        }

        const dropZone = document.getElementById('dropZone');
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('drag-over'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (file) {
                document.getElementById('cv_path').files = e.dataTransfer.files;
                document.getElementById('fileLabel').textContent = file.name;
            }
        });
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    </script>

</body>
</html>