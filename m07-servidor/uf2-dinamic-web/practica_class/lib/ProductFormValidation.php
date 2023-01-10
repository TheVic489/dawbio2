<?php
require_once 'model/Product.php';

/**
 * Description of ItemFormValidation
 * Provides validation to get data from item form.
 * @author ProvenSoft
 */
class ProductFormValidation {
    
    /**
     * validates and gets data from item form.
     * @return Product the item with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $userObj = null;
        $id = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }
        $description = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }
        $price = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'price')) {
            $price = filter_input(INPUT_POST, 'price'); 
        }
        $stock = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'stock')) {
            $stock = filter_input(INPUT_POST, 'stock'); 
        }
        //if (!empty($id) && !empty($title) && !empty($content)) { 
            //they exists and they are not empty
            $prodObj = new Product($id,$description,$price,$stock);
        //}
        return $prodObj;
    }
    
}
