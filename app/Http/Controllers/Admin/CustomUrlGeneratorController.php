<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\UrlGenerator\BaseUrlGenerator;

class CustomUrlGeneratorController extends BaseUrlGenerator
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return config('filesystems.disks.public.url') . '/' . $this->getPathRelativeToRoot();
    }
}
