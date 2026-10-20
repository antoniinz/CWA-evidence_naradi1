<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Evidence techniky')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --app-bg: #f4f6fb;
            --app-primary: #4f46e5;
            --app-primary-dark: #4338ca;
            --app-text-muted: #6b7280;
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--app-bg);
            color: #1f2937;
        }

        /* Navigace */
        .app-nav {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        }
        .app-nav .navbar-brand {
            font-weight: 700;
            letter-spacing: -.01em;
        }
        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .15);
            margin-right: .6rem;
        }

        /* Karty */
        .card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(16, 24, 40, .06), 0 1px 2px rgba(16, 24, 40, .04);
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid #eef0f4;
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        /* Tlačítka */
        .btn { border-radius: .6rem; font-weight: 500; }
        .btn-primary {
            --bs-btn-bg: var(--app-primary);
            --bs-btn-border-color: var(--app-primary);
            --bs-btn-hover-bg: var(--app-primary-dark);
            --bs-btn-hover-border-color: var(--app-primary-dark);
            --bs-btn-active-bg: var(--app-primary-dark);
            --bs-btn-active-border-color: var(--app-primary-dark);
        }
        .btn-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Formuláře */
        .form-control, .form-select, .input-group-text { border-radius: .6rem; }
        .input-group > .form-control, .input-group > .form-select { border-top-left-radius: 0; border-bottom-left-radius: 0; }
        .input-group > .input-group-text { border-top-right-radius: 0; border-bottom-right-radius: 0; background: #f9fafb; color: var(--app-text-muted); }
        .input-group > .input-group-text:last-child { border-radius: 0 .6rem .6rem 0; }
        .form-control:focus, .form-select:focus {
            border-color: var(--app-primary);
            box-shadow: 0 0 0 .2rem rgba(79, 70, 229, .15);
        }
        .form-label { font-weight: 500; font-size: .875rem; }

        /* Tabulky */
        .table > :not(caption) > * > * { padding: .9rem 1.25rem; }
        .table thead th {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--app-text-muted);
            font-weight: 600;
            background: #fafbfc;
            border-bottom: 1px solid #eef0f4;
        }
        .table tbody tr:last-child td { border-bottom: 0; }

        /* Ikona zařízení v tabulce */
        .item-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eef2ff;
            color: var(--app-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* Statistické karty / filtry */
        .stat-card {
            display: block;
            text-decoration: none;
            color: inherit;
            padding: 1.1rem 1.25rem;
            border-radius: 1rem;
            background: #fff;
            border: 2px solid transparent;
            box-shadow: 0 1px 3px rgba(16, 24, 40, .06);
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 24, 40, .08);
            color: inherit;
        }
        .stat-card.active { border-color: var(--app-primary); }
        .stat-card .stat-label { font-size: .8rem; color: var(--app-text-muted); font-weight: 500; }
        .stat-card .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.2; }
        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Stav (odznak) */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-weight: 500;
            font-size: .8rem;
            padding: .35rem .75rem;
            border-radius: 999px;
        }
        .status-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        /* Detail */
        .info-tile .info-label {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--app-text-muted);
            font-weight: 600;
        }
        .info-tile .info-value { font-size: 1.05rem; font-weight: 600; }

        .empty-state { padding: 3rem 1rem; text-align: center; color: var(--app-text-muted); }
        .empty-state i { font-size: 2.5rem; opacity: .4; }

        .page-title { font-weight: 700; letter-spacing: -.02em; }
        .sticky-form { position: sticky; top: 1rem; }
    </style>
</head>
<body>

<nav class="navbar app-nav navbar-dark mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('equipment.index') }}">
            <span class="brand-icon"><i class="bi bi-tools"></i></span>
            Evidence techniky
        </a>
        <a href="{{ route('equipment.create') }}" class="btn btn-light btn-sm d-none d-sm-inline-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Nové zařízení
        </a>
    </div>
</nav>

<main class="container pb-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center" role="alert" id="flash">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zavřít"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Hláška o úspěchu zmizí po 4 sekundách
    const flash = document.getElementById('flash');
    if (flash) {
        setTimeout(() => bootstrap.Alert.getOrCreateInstance(flash).close(), 4000);
    }
</script>
</body>
</html>
