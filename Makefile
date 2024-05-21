
init:
	docker compose build --no-cache
	docker compose up -d
	docker compose exec php bin/console d:m:migrate --no-interaction
	docker compose exec php bin/console d:fixtures:load  --no-interaction
