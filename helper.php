<?php
/**
 * @package     BR Simple Slider
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;

class ModSimpleSliderHelper
{
    /**
     * Retrieves the list of image URLs from the specified folder.
     * Returns an array with 'images' and 'error' keys.
     * * @param   string  $folderName  The folder name inside /images/
     * @return  array   List of images and error status
     */
    public static function getImages($folderName)
    {
        $folderName = trim($folderName, '/');
        $path = JPATH_SITE . '/images/' . $folderName;
        
        $images = [];
        $error = null; // Assume no error initially

        // 3. Verifica se existe (PHP Nativo)
        if (is_dir($path)) {
            
            // 4. Lê os arquivos da pasta (PHP Nativo)
            $files = scandir($path);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                // 5. Filtra apenas imagens usando Regex
                if (preg_match('/(?i)\.(jpg|jpeg|png|webp|gif)$/', $file)) {
                    $images[] = Uri::root(true) . '/images/' . $folderName . '/' . $file;
                }
            }
            
            if (empty($images)) {
                 $error = 'BR Simple Slider: Configuration Warning. Folder found, but no valid images (.jpg, .png, etc.) were detected.';
            }

        } else {
            // Se a pasta não existe, registra o erro
            $error = 'BR Simple Slider: Error. Image folder "' . htmlspecialchars($folderName) . '" not found at /images/ - Please check module settings.';
        }

        return [
            'images' => $images,
            'error' => $error
        ];
    }
}
?>