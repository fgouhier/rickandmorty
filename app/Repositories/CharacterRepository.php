<?php

namespace App\Repositories;

use App\Interfaces\CharacterInterface;
use Illuminate\Support\Facades\DB;


class CharacterRepository implements CharacterInterface
{
	/**
	* Get Character by id
	*
	* @return array
	*/
	function getCharacter(int $id): array
	{
		$result = DB::select('SELECT * FROM `character` WHERE id = ?', [$id]);

		return $result;
	}

	/**
	* Create a Character
	*
	* @return bool
	*/
	function createCharacter(object $params): bool
	{
		$result = DB::insert('INSERT INTO `character` (name, status, species, gender, origin) VALUES (?, ?, ?, ?, ?)', [
			$params->name,
			$params->status,
			$params->species,
			$params->gender,
			$params->origin,
		]);

		return $result;
	}

	/**
	* Update a Character
	*
	* @return int
	*/
	function updateCharacter(int $id, object $params): int
	{
		$result = DB::update('UPDATE `character` SET name=?, status=?, species=?, gender=?, origin=? WHERE id = ?', [
			$params->name,
			$params->status,
			$params->species,
			$params->gender,
			$params->origin,
			$id
		]);

		return $result;
	}
}