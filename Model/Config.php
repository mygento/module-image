<?php

/**
 * @author Mygento Team
 * @copyright 2023-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Image
 */

namespace Mygento\Image\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const PATH = 'system/upload_configuration';

    public function __construct(private ScopeConfigInterface $scopeConfig) {}

    public function getImageQuality(string $format): ?int
    {
        $path = self::PATH . '/' . $format . '_quality';
        $value = $this->scopeConfig->getValue($path);

        return $value !== null ? (int) $value : null;
    }

    public function isProgressiveEnabled(): bool
    {
        $path = self::PATH . '/jpg_progressive';

        return $this->scopeConfig->isSetFlag($path);
    }

    public function isInterlaceEnabled(): bool
    {
        $path = self::PATH . '/png_interlaced';

        return $this->scopeConfig->isSetFlag($path);
    }
}
