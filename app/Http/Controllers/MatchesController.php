<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index()
{
    $matches = Matches::all();
    return $matches;
}

}
