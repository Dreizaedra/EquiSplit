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
