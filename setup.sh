#!/bin/sh
set -e

echo "🛠️ Running Application Setup..."

# 1. Run migrations
php artisan migrate --force

# 2. Create a default Hackathon if none exists
php artisan tinker --execute="
if (!App\Models\Hackaton::where('inscription', 1)->exists()) {
    App\Models\Hackaton::create(['pco_1' => 'Admin', 'pco_2' => 'Admin', 'annee' => '2026', 'inscription' => 1]);
    echo '✅ Default Hackathon created.';
} else {
    echo 'ℹ️ Hackathon already exists.';
}
"

# 3. Create a default Admin user if none exists
php artisan tinker --execute="
if (!App\Models\User::where('email', 'admin@hackathon.com')->exists()) {
    \$user = new App\Models\User;
    \$user->name = 'Admin';
    \$user->email = 'admin@hackathon.com';
    \$user->password = bcrypt('password');
    \$user->save();
    echo '✅ Default Admin user created.';
} else {
    echo 'ℹ️ Admin user already exists.';
}
"

echo "✨ Setup complete!"
