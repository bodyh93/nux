<?php

namespace App\Services;

use App\Models\Link;
use App\Models\NuxUser;
use Str;

class LinkService
{
    public function makeLinkForUser(NuxUser $nuxUser): Link
    {
        $link = $nuxUser->link ?: Link::make([
            'link' => Str::uuid()
        ]);

        if (!$link->exists) {
            $link->nuxUser()->associate($nuxUser)->save();
        }

        return $link;
    }

    public function makeNewLinkForUser(NuxUser $nuxUser): Link
    {
        $link = $nuxUser->load('link')->link;
        $link->link = Str::uuid();
        $link->save();

        return $link;
    }

    public function deactivateLinkForUser(NuxUser $nuxUser)
    {
        $nuxUser->load('link')->link->delete();
    }
}
