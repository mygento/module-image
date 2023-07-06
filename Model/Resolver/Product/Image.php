<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Image
 */

namespace Mygento\Image\Model\Resolver\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Image implements ResolverInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param Field $field
     * @param type $context
     * @param ResolveInfo $info
     * @param array $value
     * @param array $args
     * @throws LocalizedException
     * @return array
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }
        /** @var Product $product */
        $product = $value['model'];
        $label = $value['name'] ?? null;

        return [
            'model' => $product,
            'image_type' => $field->getName(),
            'label' => $label,
        ];
    }
}
