<header class="site-header">

    <div class="container navbar">

        <a href="{{ route('home') }}" class="logo">
            <span class="logo-star">★</span>

            <span class="logo-text">
                ONG <strong>DKL</strong>
            </span>
        </a>

        <button
            type="button"
            class="menu-toggle"
            id="menuToggle"
            aria-label="Ouvrir le menu"
        >
            ☰
        </button>

        <nav class="nav-menu" id="navMenu">

            {{-- Accueil --}}
            <a
                href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'active' : '' }}"
            >
                Accueil
            </a>

            {{-- À propos --}}
           

            {{-- Projets publics --}}
            <a
                href="{{ route('projects.index') }}"
                class="{{ request()->routeIs('projects.*') ? 'active' : '' }}"
            >
                Nos projets
            </a>

            {{-- Actualités --}}
            <a
                href="{{ route('news.index') }}"
                class="{{ request()->routeIs('news.*') ? 'active' : '' }}"
            >
                Actualités
            </a>

            {{-- Contact --}}
            <a
                href="{{ route('contact') }}"
                class="{{ request()->routeIs('contact*') ? 'active' : '' }}"
            >
                Contact
            </a>

            {{-- Donation --}}
            <a
                href="{{ route('donations.create') }}"
                class="btn btn-donate"
            >
                Faire un don
            </a>

        </nav>

    </div>

</header>