<?php

namespace App\Validators;

class NewProductValidator {

    public function validateData(array $data): array
    {
        if(empty($data['sku']) || !is_string($data['sku'])) {
            throw new \InvalidArgumentException('Invalid SKU');
        }

        if(empty($data['name']) || !is_string($data['name'])) {
            throw new \InvalidArgumentException('Invalid Name');
        }

        if(!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            throw new \InvalidArgumentException('Invalid price');
        }

        if(!isset($data['type'])) {
            throw new \InvalidArgumentException('Invalid type');
        }

        switch (strtolower($data['type'])) {
            case 'book':
                if (!isset($data['weight']) || !is_numeric($data['weight']) || $data['weight'] <= 0) {
                    throw new \InvalidArgumentException('Invalid weight for book');
                }
                break;
            case 'dvd':
                if (!isset($data['size']) || !is_numeric($data['size']) || $data['size'] <= 0) {
                    throw new \InvalidArgumentException('Invalid size for DVD');
                }
                break;
            case 'furniture':
                if (
                    !isset($data['height']) || !is_numeric($data['height']) || $data['height'] <= 0 ||
                    !isset($data['width'])  || !is_numeric($data['width'])  || $data['width'] <= 0 ||
                    !isset($data['length']) || !is_numeric($data['length']) || $data['length'] <= 0
                ) {
                    throw new \InvalidArgumentException('Invalid dimensions for furniture');
                }
                break;
            default:
                throw new \InvalidArgumentException('Unsupported product type');
        }

        $data['sku']    = htmlspecialchars($data['sku']);
        $data['name']   = htmlspecialchars($data['name']);

        return $data;
    }
}