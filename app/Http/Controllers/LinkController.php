<?php

namespace App\Http\Controllers;

use App\Services\LinkService;


class LinkController extends Controller
{
    public function index(LinkService $linkService)
    {
        $nuxUser = session('nuxUser');
        $link = $linkService->makeLinkForUser($nuxUser);

        return view('link.index', ['link' => route('pageA.index', $link->link)]);
    }

    public function newLink(LinkService $linkService)
    {
        $nuxUser = session('nuxUser');
        $link = $linkService->makeNewLinkForUser($nuxUser);

        return view('link.newLink', ['link' => route('pageA.index', $link->link)]);
    }

    public function deactivateLink(LinkService $linkService)
    {
        $nuxUser = session('nuxUser');
        $linkService->deactivateLinkForUser($nuxUser);

        return response()->redirectToRoute('auth.index');
    }
}
