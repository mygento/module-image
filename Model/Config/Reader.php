<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
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
        $config = [];
        $config['RichImage']['fields']['2x'] = [
            'name' => '2x',
            'type' => 'String',
            'arguments' => [],
            'deprecated' => [],
        ];
        $config['RichImage']['fields']['3x'] = [
            'name' => '3x',
            'type' => 'String',
            'arguments' => [],
            'deprecated' => [],
        ];
        if (function_exists('imageavif')) {
            $config['RichImage']['fields']['avif'] = [
                'name' => 'avif',
                'type' => 'String',
                'arguments' => [],
                'deprecated' => [],
            ];
        }
        if (extension_loaded('imagick') && class_exists('Imagick') && \Imagick::queryFormats('AVIF')) {
            $config['RichImage']['fields']['avif2'] = [
                'name' => 'avif2',
                'type' => 'String',
                'arguments' => [],
                'deprecated' => [],
            ];
        }

        if (function_exists('imagewebp')) {
            $config['RichImage']['fields']['webp'] = [
                'name' => 'webp',
                'type' => 'String',
                'arguments' => [],
                'deprecated' => [],
            ];
        }
        if (extension_loaded('imagick') && class_exists('Imagick') && \Imagick::queryFormats('WEBP')) {
            $config['RichImage']['fields']['webp2'] = [
                'name' => 'webp2',
                'type' => 'String',
                'arguments' => [],
                'deprecated' => [],
            ];
        }

        return $config;
    }
}
