# Create database & table
```
CREATE DATABASE rickandmorty;
USE rickandmorty;
CREATE TABLE `character` (
	id INT AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	status ENUM('Alive', 'Dead', 'unknown') NOT NULL,
	species VARCHAR(20) NOT NULL,
	gender ENUM('Female', 'Male', 'Genderless', 'unknown') NOT NULL,
	origin LONGTEXT NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO `character` VALUES (1, 'Rick Sanchez', 'Alive', 'Human', 'Male', '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}');
INSERT INTO `character` VALUES (2, 'Morty Smith', 'Alive', 'Human', 'Male', '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}');
```

# Edit .env with DB credentials

# Start app
```
php -S localhost:8000 -t public
```

# Unit test
```
vendor/bin/phpunit
```