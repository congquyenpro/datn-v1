<?php 

namespace App\Services;

use App\Models\AttributeValue; // Import model tương ứng

class AttributeValueService
{
    // Không cần lưu trữ repository nữa

    public function getAll()
    {
        return AttributeValue::all(); // Gọi trực tiếp từ model
    }

    public function getById($id)
    {
        return AttributeValue::find($id); // Gọi trực tiếp từ model
    }

    public function getAllValuesOfAttribute($attribute_id)
    {
        return AttributeValue::where('attribute_id', $attribute_id)->get(); // Gọi trực tiếp từ model
    }

    public function addNewValue($data)
    {
        $attribute_id = $data['attribute_id'];
        $value = $data['value'];
        $attributeValue = new AttributeValue();
        $attributeValue->attribute_id = $attribute_id;
        $attributeValue->value = $value;
        $attributeValue->save();
        return $attributeValue;
    }
    
}
