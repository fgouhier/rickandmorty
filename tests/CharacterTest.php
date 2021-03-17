<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * Test get character
     *
     * @return void
     */
    public function testGetCharacter()
    {
        $character = new \StdClass();
        $character->id = 1;
        $character->name = 'Rick Sanchez';
        $character->status = 'Alive';
        $character->species = 'Human';
        $character->gender = 'Male';
        $character->origin = '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}';
        DB::shouldReceive("select")
            ->andReturn([$character]);

        $this->assertEquals(
            '[{"id":1,"name":"Rick Sanchez","status":"Alive","species":"Human","gender":"Male","origin":"{\"name\":\"Earth (C-137)\",\"url\":\"https:\/\/rickandmortyapi.com\/api\/location\/1\"}"}]', $this->get('character/1')->response->getContent()
        );
    }

    /**
     * Test get character with not numeric id
     *
     * @return void
     */
    public function testGetCharacterFail()
    {
        $this->assertEquals(
            'Id must be an integer', $this->get('character/a')->response->getContent()
        );
    }

    /**
     * Test create character
     *
     * @return void
     */
    public function testCreateCharacter()
    {
        DB::shouldReceive("insert")
            ->andReturn(true);

        $this->assertEquals(
            'The character has been created', $this->post('character', ['name' => 'Sully', 'status' => 'Dead', 'species' => 'human', 'gender' => 'Male', 'origin' => '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}'])->response->getContent()
        );
    }

    /**
     * Test create character without all required fields
     *
     * @return void
     */
    public function testCreateCharacterFail()
    {
        $this->assertEquals(
            '{"status":["The status field is required."],"species":["The species field is required."],"gender":["The gender field is required."],"origin":["The origin field is required."]}', $this->post('character', ['name' => 'Sully'])->response->getContent()
        );
    }

    /**
     * Test update character
     *
     * @return void
     */
    public function testUpdateCharacter()
    {
        DB::shouldReceive("update")
            ->andReturn(1);

        $this->assertEquals(
            'The Character has been updated', $this->patch('character/1', ['name' => 'Sully', 'status' => 'Dead', 'species' => 'human', 'gender' => 'Male', 'origin' => '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}'])->response->getContent()
        );
    }

    /**
     * Test update character with not numeric id
     *
     * @return void
     */
    public function testUpdateCharacterFail()
    {
        $this->assertEquals(
            'Id must be an integer', $this->patch('character/a', ['name' => 'Sully', 'status' => 'Dead', 'species' => 'human', 'gender' => 'Male', 'origin' => '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}'])->response->getContent()
        );
    }

    /**
     * Test update a character not in DB
     *
     * @return void
     */
    public function testUpdateCharacterNotInDb()
    {
        DB::shouldReceive("update")
            ->andReturn(0);

        $this->assertEquals(
            'Nothing to update', $this->patch('character/1', ['name' => 'Sully', 'status' => 'Dead', 'species' => 'human', 'gender' => 'Male', 'origin' => '{"name":"Earth (C-137)","url":"https://rickandmortyapi.com/api/location/1"}'])->response->getContent()
        );
    }
}
