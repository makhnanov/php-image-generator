up:
	docker-compose build && docker-compose up --remove-orphans --force-recreate
shell:
	docker-compose exec php-image-generator bash
vertical-sea-battle:
	docker-compose exec php-image-generator /usr/local/bin/php /app/SeaBattle/generate_vertical.php
horizontal-sea-battle:
	docker-compose exec php-image-generator /usr/local/bin/php /app/SeaBattle/generate_horizontal.php
chess-field:
	docker-compose exec php-image-generator /usr/local/bin/php /app/Chess/generate_chess_field.php
