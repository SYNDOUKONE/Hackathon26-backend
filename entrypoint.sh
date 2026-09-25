#!/bin/sh
set -e

# Désactiver les MPM conflictuels avant de lancer Apache
# On tente de supprimer les fichiers .load pour être certain qu'ils ne soient pas chargés
rm -f /etc/apache2/mods-enabled/mpm_prefork.load
rm -f /etc/apache2/mods-enabled/mpm_worker.load
a2enmod mpm_event

# Lancer Apache au premier plan (comme le fait l'image originale)
exec apache2-foreground
