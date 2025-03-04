# EquiSplit

## Git Hooks

Il faut d'abord setup l'environnement virtuel de Python, l'activer puis installer les dépendances.

```bash
python3 -m venv .venv
source .venv/bin/activate
pip install -r requirements.txt
```

Puis activer les hooks utilisés par les fichiers de configuration.

```bash
pre-commit install
pre-commit install --hook-type commit-msg
pre-commit install --hook-type pre-push
```

## Back-end

Il faut d'abord naviguer dans le dossier `api` puis installer les dépendances.

```bash
cd api/
composer install
```

Puis, toujours dans le dossier `api`, il faut démarrer la base de données MariaDB via Docker,
qui sera alors disponible sur le port 3306 de votre localhost.

```bash
docker compose up
```

Il faut ensuite exécuter les migrations de Symfony et charger les données de test.

```bash
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --quiet --purge-with-truncate
```

Puis générer les clefs publiques et privées relatives à l'API.

```bash
php bin/console lexik:jwt:generate-keypair
```

Et finalement lancer le serveur.

```bash
symfony server:start --no-tls
```

Vous pouvez maintenant accéder à la documentation de l'API via l'url http://localhost:8000/api
