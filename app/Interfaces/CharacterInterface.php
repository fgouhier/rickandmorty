<?php

namespace App\Interfaces;

interface CharacterInterface {

	public function getCharacter(int $id): array;

	public function createCharacter(object $params): bool;

	public function updateCharacter(int $id, object $params): int;

}