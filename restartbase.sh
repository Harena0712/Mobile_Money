rm writable/database.db
touch writable/database.db


php spark migrate
php spark db:seed DatabaseSeeder