<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Espace d'administration de l'ONG DKL"
    >

    <title>
        @yield('title', 'Administration - ONG DKL')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >
</head>

<body>

<div class="admin-layout">

    {{-- =========================
        SIDEBAR
    ========================== --}}
    <aside class="admin-sidebar" id="adminSidebar">

        {{-- Logo --}}
        <div class="admin-logo">

            <h2>ONG DKL</h2>

            <span>
                Administration
            </span>

        </div>


        {{-- Navigation --}}
        <nav class="admin-nav">

            {{-- Dashboard --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>


            {{-- Projets --}}
            <a
                href="{{ route('admin.projects.index') }}"
                class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">📁</span>
                <span>Projets</span>
            </a>


            {{-- Dons --}}
            <a
                href="{{ route('admin.donations.index') }}"
                class="{{ request()->routeIs('admin.donations.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">💰</span>
                <span>Dons</span>
            </a>


            {{-- Bénévoles --}}
            <a href="{{route('admin.volunteers.index')}}" >
                <span class="nav-icon">👥</span>
                <span>Bénévoles</span>
            </a>


            {{-- Actualités --}}
            <a
                href="{{ route('admin.news.index') }}"
                class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">📰</span>
                <span>Actualités</span>
            </a>


            {{-- Messages --}}
            <a href="{{ route('admin.contacts.index') }}">
                <span class="nav-icon">✉️</span>
                <span>Messages</span>
            </a>


            {{-- Séparateur --}}
            <div class="nav-separator"></div>


            {{-- Site public --}}
            <a
                href="{{ route('home') }}"
                target="_blank"
            >
                <span class="nav-icon">🌐</span>
                <span>Voir le site</span>
            </a>

        </nav>


        {{-- =========================
            UTILISATEUR
        ========================== --}}
        <div class="admin-sidebar-bottom">

            <div class="admin-user">

                <div class="admin-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="admin-user-info">

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <small>
                        {{ auth()->user()->email }}
                    </small>

                </div>

            </div>


            {{-- Déconnexion --}}
            <form
                action="{{ route('admin.logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >
                    <span>🚪</span>
                    <span>Déconnexion</span>
                </button>

            </form>

        </div>

    </aside>


    {{-- =========================
        CONTENU PRINCIPAL
    ========================== --}}
    <div class="admin-main">

        {{-- TOPBAR --}}
        <header class="admin-topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    aria-label="Ouvrir le menu"
                >
                    ☰
                </button>

                <div class="topbar-title">

                    <strong>
                        @yield(
                            'page-title',
                            'Espace Administrateur'
                        )
                    </strong>

                </div>

            </div>


            <div class="admin-topbar-user">

                <span class="topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>

                <span>
                    {{ auth()->user()->name }}
                </span>

            </div>

        </header>


        {{-- CONTENU --}}
        <main class="admin-content">

            {{-- Messages globaux --}}

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif


            @yield('content')

        </main>

    </div>

</div>


{{-- JavaScript --}}
<script src="{{ asset('js/admin.js') }}"></script>

@stack('scripts')

</body>

</html>