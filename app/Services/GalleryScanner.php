<?php

namespace App\Services;

/**
 * Class GalleryScanner
 * @package App\Services
 */

class GalleryScanner
{
    public function scanCategories()
    {
        $categories = [];

        $categoryFolders = scandir(public_path('images/gallery'));

        foreach ($categoryFolders as $categoryFolder) {
            if ($categoryFolder !== '.' && $categoryFolder !== '..') {
                $categoryPath = "images/gallery/$categoryFolder";
                $images = glob($categoryPath . '/*');

                if (!empty($images)) {
                    $categories[$categoryFolder] = $images;
                }
            }
        }

        return $categories;
    }
}
