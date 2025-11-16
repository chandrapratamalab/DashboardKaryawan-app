<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Shift</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e40af;
            --gray-light: #f8fafc;
            --gray: #6b7280;
            --gray-dark: #374151;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-dark);
            margin: 0;
        }

        .logo p {
            color: var(--gray);
            margin: 5px 0 0 0;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--gray-dark);
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 45px 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex !important; /* Force display */
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            z-index: 10; /* Higher z-index */
            opacity: 1 !important; /* Force opacity */
            visibility: visible !important; /* Force visibility */
        }

        .password-toggle:hover {
            color: var(--primary);
            background-color: rgba(59, 130, 246, 0.1);
        }

        .password-toggle:focus {
            outline: none;
            color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        }

        .password-toggle.active {
            color: var(--primary);
        }

        /* Hide lock icon in password field */
        .password-field .input-icon {
            display: none;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .demo-section {
            background: var(--gray-light);
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .demo-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-dark);
            margin-bottom: 8px;
        }

        .demo-item {
            font-size: 0.75rem;
            color: var(--gray);
            margin-bottom: 4px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: none;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border-left: 4px solid #16a34a;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo & Header -->
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h1>Sistem Shift</h1>
                <p>Kelola jadwal dengan mudah</p>
            </div>

            <!-- Alerts -->
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">   
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-group password-field">
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        <button type="button" class="password-toggle" id="password-toggle" aria-label="Tampilkan password">
                            <i class="fas fa-eye"></i>
                        </button>
                        <!-- Remove the lock icon -->
                    </div>
                </div>

                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>

            <!-- Demo Section -->
            <div class="demo-section">
                <div class="demo-title">Akun Demo:</div>
                <div class="demo-item">Admin: admin@example.com / password</div>
                <div class="demo-item">User: user@example.com / password</div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple form enhancement
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = '#3b82f6';
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.style.borderColor = '#e5e7eb';
                    }
                });
            });

            // Password toggle functionality
            const passwordToggle = document.getElementById('password-toggle');
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordToggle.querySelector('i');
            
            // Ensure button is always visible
            function ensureButtonVisibility() {
                passwordToggle.style.display = 'flex';
                passwordToggle.style.opacity = '1';
                passwordToggle.style.visibility = 'visible';
                passwordToggle.style.pointerEvents = 'auto';
            }

            // Initialize button visibility
            ensureButtonVisibility();

            passwordToggle.addEventListener('click', function() {
                // Toggle password visibility
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon and active state
                if (type === 'text') {
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                    passwordToggle.classList.add('active');
                    passwordToggle.setAttribute('aria-label', 'Sembunyikan password');
                } else {
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                    passwordToggle.classList.remove('active');
                    passwordToggle.setAttribute('aria-label', 'Tampilkan password');
                }
                
                // Re-ensure visibility after click
                ensureButtonVisibility();
            });

            // Keyboard accessibility for password toggle
            passwordToggle.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    passwordToggle.click();
                }
            });

            // Monitor password input events to ensure button stays visible
            passwordInput.addEventListener('input', ensureButtonVisibility);
            passwordInput.addEventListener('focus', ensureButtonVisibility);
            passwordInput.addEventListener('blur', ensureButtonVisibility);
            passwordInput.addEventListener('change', ensureButtonVisibility);

            // Additional safety: check button visibility periodically
            setInterval(ensureButtonVisibility, 1000);
        });
    </script>
</body>
</html>