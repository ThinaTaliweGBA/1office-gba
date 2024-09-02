<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GBA\PersonService;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function store(Request $request)
    {
        $person = $this->personService->createPerson($request, '');
        return response()->json(['success' => true, 'person' => $person]);
    }
}
