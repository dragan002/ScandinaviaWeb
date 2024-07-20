<?php

namespace App\Validators;

class NewProductValidator {

    public function validateData(array $data): array
    {
        $errors = [];

        // Validate SKU
        if (empty($data['sku']) || !is_string($data['sku'])) {
            $errors['sku'] = "Please provide a valid SKU.";
        }

        // Validate Name
        if (empty($data['name']) || !is_string($data['name'])) {
            $errors['name'] = "Please provide a valid name.";
        }

        // Validate Price
        if (!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = "Please provide a valid price. It can't be less than or equal to 0.";
        }

        // Validate Type
        if (!isset($data['type'])) {
            $errors['type'] = "Please choose a type.";
        }

        // Type-specific validation
        switch (strtolower($data['type'])) {
            case 'book':
                if (!isset($data['weight']) || !is_numeric($data['weight']) || $data['weight'] <= 0) {
                    $errors['weight'] = "Please provide a valid weight for the book.";
                }
                break;
            case 'dvd':
                if (!isset($data['size']) || !is_numeric($data['size']) || $data['size'] <= 0) {
                    $errors['size'] = "Invalid size for DVD. It must be greater than 0.";
                }
                break;
            case 'furniture':
                if (!isset($data['height']) || !is_numeric($data['height']) || $data['height'] <= 0) {
                    $errors['height'] = "Please provide a valid height for furniture.";
                }
                if (!isset($data['width']) || !is_numeric($data['width']) || $data['width'] <= 0) {
                    $errors['width'] = "Please provide a valid width for furniture.";
                }
                if (!isset($data['length']) || !is_numeric($data['length']) || $data['length'] <= 0) {
                    $errors['length'] = "Please provide a valid length for furniture.";
                }
                break;
            default:
                $errors['type'] = 'Unsupported product type.';
                break;
        }

        if (count($errors) > 0) {
            throw new \InvalidArgumentException(json_encode($errors));
        }
        
        $data['sku']    = htmlspecialchars($data['sku']);
        $data['name']   = htmlspecialchars($data['name']);
        $data['price']  = htmlspecialchars($data['price']);  

        return $data;
    }
}
