<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Millhouse Bakery') }} — Create account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Work+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #2B1B14;
            --card: #FBF3E4;
            --card-edge: #F1E4CC;
            --ink: #3A2519;
            --ink-soft: #8A7460;
            --jam: #B23A48;
            --jam-hover: #98303D;
            --wheat: #C98B2E;
            --line: #E6D8BF;
            --error: #A32D2D;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: var(--bg);
        }

        body {
            font-family: 'Work Sans', sans-serif;
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 32px 20px;
            background:
                radial-gradient(ellipse at 50% -10%, #3a2417 0%, transparent 55%),
                var(--bg);
        }

        .scene {
            width: 100%;
            max-width: 380px;
        }

        .mark {
            display: flex;
            justify-content: center;
            margin-bottom: 6px;
        }

        .mark svg {
            display: block;
        }

        .steam-line {
            stroke: #E8C77E;
            stroke-width: 1.6;
            fill: none;
            stroke-linecap: round;
            opacity: 0.55;
            transform-origin: center bottom;
            animation: rise 5.5s ease-in-out infinite;
        }

        .steam-line.s2 {
            animation-delay: .6s;
            opacity: 0.4;
        }

        .steam-line.s3 {
            animation-delay: 1.2s;
            opacity: 0.3;
        }

        @keyframes rise {
            0% {
                transform: translateY(2px) scaleY(0.9);
                opacity: 0;
            }

            18% {
                opacity: 0.55;
            }

            70% {
                opacity: 0.15;
            }

            100% {
                transform: translateY(-9px) scaleY(1.05);
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .steam-line {
                animation: none;
                opacity: 0.35;
            }
        }

        h1.brand {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 26px;
            color: #F6E9D3;
            text-align: center;
            margin: 4px 0 2px;
            letter-spacing: 0.2px;
        }

        p.tagline {
            text-align: center;
            color: #B8A489;
            font-size: 13px;
            margin: 0 0 28px;
            letter-spacing: 0.3px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--card-edge);
            border-radius: 14px;
            padding: 32px 30px 28px;
            box-shadow: 0 24px 48px -20px rgba(0, 0, 0, 0.55);
        }

        .card h2 {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            font-size: 21px;
            margin: 0 0 4px;
            color: var(--ink);
        }

        .card .sub {
            font-size: 13.5px;
            color: var(--ink-soft);
            margin: 0 0 20px;
        }

        .errors {
            background: #FCEBEB;
            color: var(--error);
            border: 1px solid #F0A0A0;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .field input {
            width: 100%;
            height: 42px;
            padding: 0 13px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: #FFFDF9;
            font-family: 'Work Sans', sans-serif;
            font-size: 14.5px;
            color: var(--ink);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .field input.invalid {
            border-color: var(--error);
        }

        .field input::placeholder {
            color: #B7A88C;
        }

        .field input:hover {
            border-color: #D8C39E;
        }

        .field input:focus {
            outline: none;
            border-color: var(--jam);
            box-shadow: 0 0 0 3px rgba(178, 58, 72, 0.15);
        }

        .field .hint {
            font-size: 12px;
            color: var(--error);
            margin-top: 5px;
        }

        button.submit {
            height: 44px;
            border: none;
            border-radius: 8px;
            background: var(--jam);
            color: #FBF3E4;
            font-family: 'Work Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.2px;
            cursor: pointer;
            margin-top: 4px;
            transition: background .15s ease, transform .05s ease;
        }

        button.submit:hover {
            background: var(--jam-hover);
        }

        button.submit:active {
            transform: scale(0.98);
        }

        button.submit:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(178, 58, 72, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0 18px;
        }

        .divider .l {
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .divider span {
            font-size: 12px;
            color: var(--ink-soft);
        }

        .signin {
            text-align: center;
            font-size: 13.5px;
            color: var(--ink-soft);
        }

        .signin a {
            color: var(--wheat);
            font-weight: 600;
            text-decoration: none;
        }

        .signin a:hover {
            text-decoration: underline;
        }

        .foot {
            text-align: center;
            margin-top: 22px;
            font-size: 11.5px;
            color: #7A6A55;
        }
    </style>
</head>

<body>

    <div class="scene">

        <div class="mark">
            <svg width="64" height="52" viewBox="0 0 64 52">
                <path class="steam-line s1" d="M22 20 C 18 14, 26 10, 22 4"></path>
                <path class="steam-line s2" d="M32 22 C 28 15, 36 11, 32 4"></path>
                <path class="steam-line s3" d="M42 20 C 38 14, 46 10, 42 4"></path>
                <ellipse cx="32" cy="38" rx="21" ry="10" fill="#3A2519"></ellipse>
                <ellipse cx="32" cy="35" rx="21" ry="10" fill="#F6E9D3"></ellipse>
                <path d="M14 33 C 20 27, 44 27, 50 33" stroke="#3A2519" stroke-width="1.4" fill="none"
                    opacity="0.35"></path>
            </svg>
        </div>

        <h1 class="brand">{{ config('app.name', 'Millhouse Bakery') }}</h1>
        <p class="tagline">Fresh from the oven, every morning</p>

        <div class="card">
            <h2>Create your account</h2>
            <p class="sub">Join us for early access to the daily bake list.</p>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name"
                        class="{{ $errors->has('name') ? 'invalid' : '' }}" value="{{ old('name') }}"
                        placeholder="Your full name" autocomplete="name" required autofocus>
                    @error('name')
                        <p class="hint">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        class="{{ $errors->has('email') ? 'invalid' : '' }}" value="{{ old('email') }}"
                        placeholder="name@example.com" autocomplete="email" required>
                    @error('email')
                        <p class="hint">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="{{ $errors->has('password') ? 'invalid' : '' }}" placeholder="At least 8 characters"
                        autocomplete="new-password" required>
                    @error('password')
                        <p class="hint">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Re-enter your password" autocomplete="new-password" required>
                </div>

                <button type="submit" class="submit">Create account</button>
            </form>

            <div class="divider">
                <div class="l"></div><span>or</span>
                <div class="l"></div>
            </div>

            <p class="signin">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>

        <p class="foot">&copy; {{ date('Y') }} {{ config('app.name', 'Millhouse Bakery') }}</p>

    </div>

</body>

</html>
