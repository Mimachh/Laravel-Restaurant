ssh rzgf6652@expresso.o2switch.net 'cd ~/public_html/templates/resto && git pull origin main && make install'

install: .env public/storage vendor/autoload.php public/build/manifest.json
	php artisan cache:clear
	php artisan migrate

.env: 
	cp .env.example .env
	php artisan key:generate

public/storage:
	php artisan storage:link

vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php

public/build/manifest.json: package.json
	npm i
	npm run build