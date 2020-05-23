<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(\App\Models\ElasticsearchRepository $client, Request $request)
    {
        $articles = $client->search($request->q);
        return $articles;
    }
}
