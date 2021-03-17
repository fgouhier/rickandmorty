<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Interfaces\CharacterInterface;
use Exception;


class CharacterController extends Controller
{

    private $characterInterface;

    public function __construct(CharacterInterface $characterInterface)
    {
        $this->characterInterface = $characterInterface;
    }

    public function show($id): Response
    {
        if (!is_numeric($id)) {
            $code = 400;
            $result = 'Id must be an integer';
        } else {
            try {
                $code = 200;
                $result = $this->characterInterface->getCharacter($id);
            } catch (Exception $e) {
                $code = 500;
                $result = $e->getMessage();
            }
        }

        return new Response($result, $code);
    }

    private function testCharacterRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'species' => 'required',
            'gender' => 'required',
            'origin' => 'required',
        ]);
    }

    public function create(Request $request): Response
    {
        $code = 201;
        $msg = 'The character has been created';

        $this->testCharacterRequest($request);

        try {
            $result = $this->characterInterface->createCharacter($request);

            if (!$result) {
                $code = 400;
                $msg = 'A problem occurred during the character\'s creation, please retry';
            }
        } catch (Exception $e) {
            $code = 500;
            $msg = $e->getMessage();
        }

        return new Response($msg, $code);
    }

    public function update($id, Request $request): Response
    {
        $code = 200;
        $msg = 'The Character has been updated';

        $this->testCharacterRequest($request);

        if (!is_numeric($id)) {
            $msg = 'Id must be an integer';
        } else {
            try {
                $result = $this->characterInterface->updateCharacter($id, $request);

                if ($result === 0) {
                    $msg = 'Nothing to update';
                }
            } catch (Exception $e) {
                $code = 500;
                $msg = $e->getMessage();
            }
        }

        return new Response($msg, $code);
    }
}
