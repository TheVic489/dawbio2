<?php
require_once 'model/Product.php';
require_once 'model/persist/ProductPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author Pau Figueras
 */
class ProductFormValidation {

	/**
	 * From form, return the Product with the matching ID
	 * Throes an Exception if product is not found
	 * @return User The matching product
	 */
	public static function getFindData(): Product {
		$fileDao = new ProductPersistFileDao('files/products.txt', ';');
		if (filter_has_var(INPUT_POST, 'id')) {
			$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
		} else {
			throw new Exception("No ID provided");
		}
		$product = $fileDao->searchProdById($id);
		if (!is_null($product)) {
			return $product;
		} else {
			throw new Exception("Product not found");
		}
	}

	/**
	 * From form, build a new product from it's data for later operations.
	 * Throws an informative Exception in case it errors at some stage
	 * @return Product The built product
	 */
	public static function getData(): Product {
		$id = (filter_has_var(INPUT_POST, 'id')) ? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) : throw new Exception("id invalid");
		$desc = (filter_has_var(INPUT_POST, 'desc')) ? htmlspecialchars($_POST['desc']) : throw new Exception("desc invalid");
		$price = (filter_has_var(INPUT_POST, 'price')) ? filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT) : throw new Exception("price invalid");
		$stock = (filter_has_var(INPUT_POST, 'stock')) ? filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT) : throw new Exception("stock invalid");

		if ($id == 0) {
			throw new Exception("id invalid");
		}

		$updatedProd = new Product(intval($id), $desc, floatval($price), intval($stock));
		return $updatedProd;
	}
    
}
