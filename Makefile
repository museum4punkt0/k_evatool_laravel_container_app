#!/usr/bin/make

SHELL = /bin/sh

magic: ## perform all install actions
	cp .env.example .env
	mkdir -p ./packages/twoavy/evaluation-tool
	cd packages/twoavy
	git clone git@github.com-twoavy-ms:museum4punkt0/k_evatool_laravel_package.git ./packages/twoavy/evaluation-tool
	git -C ./packages/twoavy/evaluation-tool checkout master
	docker-compose build
	docker-compose up -d
	docker-compose exec k_evatool composer install
	docker-compose exec k_evatool php artisan migrate
	docker-compose exec k_evatool php artisan passport:install
	docker-compose exec k_evatool php artisan users:create-admin
