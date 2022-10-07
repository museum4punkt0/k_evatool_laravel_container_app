#!/usr/bin/make

SHELL = /bin/sh

magic: ## perform all install actions
	cp .env.example .env
	mkdir -p ./packages/twoavy/evaluation-tool
	cd packages/twoavy
	git clone https://github.com/museum4punkt0/k_evatool_laravel_container_app.git ./packages/twoavy/evaluation-tool
	git -C ./packages/twoavy/evaluation-tool checkout develop
	docker-compose build
	docker-compose up -d
	docker-compose exec k_evatool composer install
	docker-compose exec k_evatool php artisan migrate:fresh --seed
	docker-compose exec k_evatool php artisan passport:install
	docker-compose exec k_evatool php artisan users:create-admin

fresh: ## perform all install actions
	rm -rf ./packages
	rm -rf ./vendor
	rm .env
	make magic
