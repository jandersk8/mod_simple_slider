<?php
/**
 * @package     BR Simple Slider
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

// 1. Pega o objeto Document para adicionar CSS/JS
$doc = Factory::getDocument();
$modulePath = Uri::root(true) . '/modules/mod_simple_slider';

// 2. Adiciona CSS e JS (Defer JS para performance)
// IMPORTANTE: Só carrega os assets se não houver erro de configuração.
if (empty($error)) {
    $doc->addStyleSheet($modulePath . '/assets/css/style.css');
    $doc->addScript($modulePath . '/assets/js/script.js', ['version' => 'auto'], ['defer' => true]);
}

// 3. Checa e exibe o erro
if (!empty($error)) : ?>
    <div class="br-slider-error">
        <p style="color: red; font-weight: bold; padding: 10px; border: 1px dashed red; background-color: #ffe0e0;">
            <?php echo htmlspecialchars($error); ?>
        </p>
        <p style="margin-top: 5px; font-size: 0.9em;">
            Please correct the module configuration settings (Folder Name).
        </p>
    </div>
<?php 
    // Se há um erro, paramos a execução do módulo aqui.
    return; 
endif; 

// --- Se não houver erro, renderiza o Slider (código original) ---

$sliderId = 'br-slider-' . $module->id;
$interval = (int)$duration * 1000; 

// Segurança: Limpa o valor da altura antes de imprimir no HTML
$safeHeight = htmlspecialchars($height, ENT_QUOTES, 'UTF-8');
?>

<div id="<?php echo $sliderId; ?>" class="br-simple-slider-container" 
     data-interval="<?php echo $interval; ?>" 
     style="height: <?php echo $safeHeight; ?>;">
     
    <?php foreach ($images as $index => $image) : ?>
        <?php 
            // A primeira imagem ganha a classe 'active'
            $activeClass = ($index === 0) ? 'active' : ''; 
        ?>
        <div class="br-slide <?php echo $activeClass; ?>">
            <img src="<?php echo $image; ?>" alt="Slider Image <?php echo $index + 1; ?>" loading="lazy">
        </div>
    <?php endforeach; ?>
</div>