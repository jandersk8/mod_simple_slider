<?php
/**
 * @package     BR Simple Slider
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

// Inclui o arquivo Helper
require_once __DIR__ . '/helper.php';

// 1. Pega as configurações do painel
$folderName = $params->get('folder_path', 'headers');
$duration   = $params->get('slide_duration', 4);
$height     = $params->get('slider_height', '500px');

// 2. Busca a lista de imagens e o status de erro usando o Helper
$result = ModSimpleSliderHelper::getImages($folderName);

$images = $result['images']; // Lista de imagens (pode ser vazia)
$error = $result['error'];   // Mensagem de erro (pode ser null)

// 3. Passa os dados para o layout
// O template deve ser carregado se houver imagens OU se houver uma mensagem de erro para exibir.
if (!empty($images) || !empty($error)) {
    require ModuleHelper::getLayoutPath('mod_simple_slider', $params->get('layout', 'default'));
}
?>