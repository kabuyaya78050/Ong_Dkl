# Déploiement sur Render

Ce guide explique comment déployer cette application Laravel sur Render en utilisant Docker.

## 1. Vérifier les fichiers de déploiement

Assure-toi que ces fichiers sont présents dans le projet :

- `Dockerfile`
- `render.yaml`
- `docker/start.sh`
- `docker/nginx.conf`

## 2. Pousser le projet sur GitHub

```bash
git add .
git commit -m "Prepare app for Render"
git push origin main
```

## 3. Créer le service Render

1. Connecte-toi à Render.
2. Clique sur `New` puis `Web Service`.
3. Choisis le dépôt GitHub.
4. Sélectionne le bon repo.
5. Configure le service avec :
   - Runtime : `Docker`
   - Dockerfile Path : `./Dockerfile`
   - Root Directory : `/`

## 4. Utiliser le blueprint Render

Le projet contient déjà le fichier `render.yaml`.

En l’utilisant, Render créera automatiquement :
- le service web
- la base PostgreSQL
- les variables d’environnement liées à la base de données

## 5. Variables d’environnement

Les variables essentielles sont :

```env
APP_NAME="ONG DKL"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ton-app.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your_render_db_host
DB_PORT=5432
DB_DATABASE=ong_dkl
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
```

Le fichier `.env.render.example` contient un exemple prêt à compléter.

## 6. Ce que le conteneur fait au démarrage

Le script `docker/start.sh` exécute automatiquement :

```bash
php artisan key:generate --force --no-interaction || true
php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Cela permet d’appliquer les migrations et de préparer Laravel pour la production.

## 7. Port Render

Render injecte automatiquement la variable `PORT`.

Le conteneur est configuré pour écouter le port fourni par Render via nginx et PHP-FPM.

## 8. Vérification après le déploiement

Une fois le service lancé :

1. Ouvre l’URL Render affichée dans le dashboard.
2. Vérifie les logs si la page ne charge pas.
3. Contrôle les variables `DB_*`.
4. Vérifie que la base Postgres a bien été créée.

## 9. Dépannage rapide

### Erreur de base de données
Vérifie :
- `DB_HOST`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `DB_CONNECTION=pgsql`

### Erreur APP_KEY
Génère une clé Laravel dans Render ou laisse le script la générer automatiquement.

### Page 500
Vérifie les logs Render et confirme que les migrations se sont bien exécutées.

---

## 10. Commande locale de test

Tu peux tester le conteneur localement avec :

```bash
docker compose up --build
```

Puis ouvrir :

```text
http://localhost:8000
```

## 11. Résumé

Le projet est prêt pour Render avec un conteneur Docker, une base PostgreSQL et un démarrage Laravel compatible production.
