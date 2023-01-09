<?php
require_once 'model/Product.php';
require_once 'model/persist/ProductPersistFileDao.php';

/**
 * Description of ProductFormValidation
 * Provides validation to get data from Product form.
 * @author Victor
 */
class ProductFormValidation {

    /**
     * validates and gets data from Product form.
     * @return Product|null the Product with the given data or null if data is not present and valid.
     */
    public static function getData(): Product|null {

        $ProductObj = null;
        $dao = new ProductPersistFileDao("files/products.txt" , ";");

        $id = 0;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }

        $description = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }

        $price = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'price')) {
            $sprice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT); 
            $price = floatval($sprice); 

        }

        $stock = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'stock')) {
            $sstock = filter_input(INPUT_POST, 'stock');
            $stock = intval($sstock); 
        }

        if ((!$dao->repeatedId($id))) { 
            //they exists and they are not empty
            $ProductObj = new Product($id, $description, $price, $stock);
        
        }else{
            $ProductObj = null;
        }
        return $ProductObj;
    }
    
        /**
     * Get if from form and returns it
     * @return int $id
     */
    public static function getId2Find() {
        $id = null;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }
        return $id;
    }

    public static function getDataForm(): Product|null {

        $ProductObj = null;
        $dao = new ProductPersistFileDao("files/products.txt" , ";");

        $id = 0;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }

        $description = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'description')) {
            $description = filter_input(INPUT_POST, 'description'); 
        }

        $price = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'price')) {
            $sprice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT); 
            $price = floatval($sprice); 

        }

        $stock = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'stock')) {
            $sstock = filter_input(INPUT_POST, 'stock');
            $stock = intval($sstock); 
        }
        //they exists and they are not empty
        $ProductObj = new Product($id, $description, $price, $stock);
        
        return $ProductObj;
    }
}