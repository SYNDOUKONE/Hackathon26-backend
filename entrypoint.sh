#!/bin/sh
set -e

# Désactiver proprement les modules MPM thread-safe et leurs configurations
a2dismod mpm_event || true
a2dismod mpm_worker || true

# Activer mpm_prefork qui est compatible avec le module PHP non thread-safe
a2enmod mpm_prefork

# Lancer le setup automatique (migrations et données minimales)
echo "Running setup script..."
/var/www/html/setup.sh

# Lancer Apache au premier plan
exec apache2-foreground
