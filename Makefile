up:
	docker-compose build && docker-compose up --remove-orphans --force-recreate
chesss:
	docker-compose exec image-generator php generate_chess_field.php
shell:
	docker-compose exec image-generator sh
