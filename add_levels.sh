#!/bin/sh
set -e

echo "📚 Adding study levels to the database..."

php artisan tinker --execute="
\$levels = [
    'Licence 1',
    'Licence 2',
    'Licence 3',
    'Master 1',
    'Master 2',
    'Doctorat'
];

foreach (\$levels as \$level) {
    App\Models\Niveau::firstOrCreate(['libelle' => \$level]);
}
echo '✅ Study levels added successfully!';
"

echo "✨ Setup complete!"
