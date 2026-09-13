<footer class="site-footer">

    <div class="container footer-grid">

        <div class="footer-brand">

            <a href="{{ url('/') }}" class="logo footer-logo">
                <span class="logo-star">★</span>

                <span class="logo-text">
                    ONG <strong>DKL</strong>
                </span>
            </a>

            <p>
                Parce que chaque enfant mérite une chance.
            </p>

            <p>
                Nous accompagnons les enfants et les jeunes
                vers un avenir meilleur.
            </p>

        </div>


        <div class="footer-column">

            <h3>Navigation</h3>

            <a href="{{ url('/') }}">Accueil</a>

            <a href="{{ url('/a-propos') }}">À propos</a>

            <a href="{{ url('/projets') }}">Nos projets</a>

            <a href="{{ url('/actualites') }}">Actualités</a>

        </div>


        <div class="footer-column">

            <h3>Participer</h3>

            <a href="{{ url('/don') }}">
                Faire un don
            </a>

            <a href="{{ url('/volontaire') }}">
                Devenir volontaire
            </a>

            <a href="{{ url('/projets') }}">
                Soutenir un projet
            </a>

        </div>


        <div class="footer-column">

            <h3>Contact</h3>

            <p>Kinshasa, RDC</p>

            <p>+243 XXX XXX XXX</p>

            <p>contact@ongdkl.org</p>

        </div>

    </div>


    <div class="footer-bottom">

        <div class="container">

            <p>
                © {{ date('Y') }} ONG DKL.
                Tous droits réservés.
            </p>

        </div>

    </div>

</footer>