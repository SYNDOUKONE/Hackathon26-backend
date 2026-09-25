#!/bin/sh
set -e

# Désactiver les MPM thread-safe (event et worker) pour éviter le crash avec le module PHP non thread-safe
# On supprime physiquement les fichiers de chargement pour éviter tout conflit
rm -f /etc/apache2/mods-enabled/mpm_event.load
rm -f /etc/apache2/mods-enabled/mpm_worker.load
a2enmod mpm_prefork

# Lancer Apache au premier plan
exec apache2-foreground
