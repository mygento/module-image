<?php

/**
 * @author Mygento Team
 * @copyright 2023-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Image
 */

namespace Mygento\Image\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mygento\ImageCommon\Model\ImageProcessor;

class Common implements ResolverInterface
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        private ImageProcessor $processor,
        protected string $type = 'default',
        protected string $field = 'image',
        protected string $entityType = 'RichImage',
        protected string $srcPath = '',
        protected string $outputPath = 'cache',
        protected int $width = 0,
        protected ?int $height = null,
        protected bool $thumbnail = false,
        protected ?int $thumbWidth = null,
        protected ?int $thumbHeight = null,
        protected bool $lqip = false,
    ) {}

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param ContextInterface $context
     * @throws LocalizedException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null,
    ): array {
        $fields = $info->getFieldSelection(1);

        $filepath = $this->getFilePath($this->field, $value, '/');
        if ($filepath === null) {
            throw new GraphQlInputException(__('File path should be specified'));
        }

        $result = $this->process([
            'type' => $this->type,
            'entityType' => $this->entityType,
            'thumbnail' => null,
        ], $fields, $filepath, $this->width, $this->height);

        if ($this->thumbnail && $this->thumbWidth && isset($fields['thumbnail'])) {
            $result['thumbnail'] = $this->process([
                'type' => $this->type,
                'entityType' => $this->entityType,
                'thumbnail' => null,
            ], $fields['thumbnail'], $filepath, $this->thumbWidth, $this->thumbHeight);
        }

        return $result;
    }

    public function getFilePath(string $path, ?array $value = null, string $separator = '/'): ?string
    {
        if ($value === null || $path === '') {
            return null;
        }

        $keys = explode($separator, $path);

        foreach ($keys as $key) {
            if (!is_array($value) || !array_key_exists($key, $value)) {
                return null;
            }
            $value = $value[$key];
        }

        return is_string($value) ? ltrim($value, '/') : null;
    }

    private function process(array $result, array $fields, string $filepath, int $width, ?int $height = null): array
    {
        $result['width'] = $width;
        $result['height'] = $height;
        if (isset($fields['default'])) {
            $result['default'] = $this->processor->process(
                path: $filepath,
                sourceDir: $this->srcPath,
                outputDir: $this->outputPath,
                width: $width,
                height: $height,
                lqip: $this->lqip,
            );
        }
        if (isset($fields['avif'])) {
            $result['avif'] = $this->processor->process(
                path: $filepath,
                sourceDir: $this->srcPath,
                outputDir: $this->outputPath,
                width: $width,
                height: $height,
                ext: 'avif',
                lqip: $this->lqip,
            );
        }
        if (isset($fields['webp'])) {
            $result['webp'] = $this->processor->process(
                path: $filepath,
                sourceDir: $this->srcPath,
                outputDir: $this->outputPath,
                width: $width,
                height: $height,
                ext: 'webp',
                lqip: $this->lqip,
            );
        }

        return $result;
    }
}
