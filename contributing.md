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
php SeaBattle/generate_vertical.php
```
### Вертикальный кислотный морской бой
```bash
# Внутри контейнера
php SeaBattle/generate_vertical_acid.php
```
### Горизонтальный морской бой
```bash
# Через Makefile
make horizontal-sea-battle
# Внутри контейнера
php SeaBattle/generate_horizontal.php
```
### Шахматы
```bash
# Через Makefile
make chess-field
# Внутри контейнера
php Chess/generate_chess_field.php
```

# Полезное
### Преобразоване SVG в PNG
```bash
inkscape --export-type=png *.svg
```
