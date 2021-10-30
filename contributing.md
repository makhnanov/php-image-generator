# Команды
- Сборка и запуск PHP cli контейнeра
```bash
make up
```
- Запуск bash внутри контейнера
```bash
make shell
```
# Генерация изображений
### Вертикальный морской бой
```bash
# Через Makefile
make vertical-sea-battle
# Внутри контейнера
php 
```
### Горизонтальный морской бой
```bash
# Через Makefile
make horizontal-sea-battle
# Внутри контейнера
php 
```
### Шахматы
```bash
# Через Makefile
make chess-field
# Внутри контейнера
php 
```

# Полезное
### Преобразоване svg в PNG
```bash
inkscape --export-type=png *.svg
```