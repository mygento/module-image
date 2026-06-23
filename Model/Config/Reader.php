<?php

/**
 * @author Mygento Team
 * @copyright 2023-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Image
 */

namespace Mygento\Image\Model\Config;

use Magento\Framework\Config\ReaderInterface;

class Reader implements ReaderInterface
{
    /**
     * @param string|null $scope
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function read($scope = null): array
    {
        return [];
        // if (function_exists('imageavif')) {
        //     $config['RichImageInterface']['fields']['avif'] = [
        //         'name' => 'avif',
        //         'type' => 'String',
        //         'arguments' => [],
        //         'deprecated' => [],
        //     ];
        // }
        // if (extension_loaded('imagick') && class_exists('Imagick') && \Imagick::queryFormats('AVIF')) {
        //     $config['RichImageInterface']['fields']['avif2'] = [
        //         'name' => 'avif2',
        //         'type' => 'String',
        //         'arguments' => [],
        //         'deprecated' => [],
        //     ];
        // }

        // if (function_exists('imagewebp')) {
        //     $config['RichImageInterface']['fields']['webp'] = [
        //         'name' => 'webp',
        //         'type' => 'String',
        //         'arguments' => [],
        //         'deprecated' => [],
        //     ];
        // }
        // if (extension_loaded('imagick') && class_exists('Imagick') && \Imagick::queryFormats('WEBP')) {
        //     $config['RichImageInterface']['fields']['webp2'] = [
        //         'name' => 'webp2',
        //         'type' => 'String',
        //         'arguments' => [],
        //         'deprecated' => [],
        //     ];
        // }
    }
}
