<?php

/**
 * @author Mygento Team
 * @copyright 2023-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Image
 */

namespace Mygento\Image\Model\Resolver;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\TypeResolverInterface;

class RichImageInterfaceType implements TypeResolverInterface
{
    public function resolveType(array $data): string
    {
        $resolvedType = $data['entityType'] ?? null;
        if ($resolvedType) {
            return $resolvedType;
        }

        throw new GraphQlInputException(
            __('Concrete type for %1 not implemented', ['RichImageInterface']),
        );
    }
}
