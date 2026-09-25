#!/bin/sh
set -e

# Désactiver proprement les modules MPM thread-safe et leurs configurations
a2dismod mpm_event || true
a2dismod mpm_worker || true

# Activer mpm_prefork qui est compatible avec le module PHP non thread-safe
a2enmod mpm_prefork

# Lancer Apache au premier plan
exec apache2-foreground
