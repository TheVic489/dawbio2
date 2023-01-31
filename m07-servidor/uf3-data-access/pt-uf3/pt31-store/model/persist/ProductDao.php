<?php
namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/Product.php';

use proven\store\model\persist\StoreDb as DbConnect;
use proven\store\model\Product as Product;

/**
 * Product database persistence class.
 * @author ProvenSoft
 */
class ProductDao {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for product.
     */
    private static string $TABLE_NAME = 'products';
    /**
     * queries to database.
     */
    private array $queries;
    
    /**
     * constructor.
     */
    public function __construct() { 
        $this->dbConnect = new DbConnect();
        $this->queries = array();
        $this->initQueries();    
    }           

    /**
     * defines queries to database.
     */
    private function initQueries() {
        //query definition.
        $this->queries['SELECT_ALL'] = \sprintf(
                "select * from %s", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_ID'] = \sprintf(
                "select * from %s where id = :id", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_CODE'] = \sprintf(
            "select * from %s where code = :code", 
            self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_CODE_AND_ID'] = \sprintf(
            "select * from %s where code = :code and id = :id", 
            self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_CATEGORY_ID'] = \sprintf(
            "select * from %s where category_id = :category_id", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(                                                                    
                "insert into %s (id, code, description, price, category_id) values (:id, :code, :description, :price, :category_id)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set id = :id, code = :code, description = :description, price = :price, category_id = :category_id where id = :id", 
                self::$TABLE_NAME
        );
        $this->queries['DELETE'] = \sprintf(
                "delete from %s where id = :id", 
                self::$TABLE_NAME
        );              
    }

    /**
     * fetches a row from PDOStatement and converts it into an product object.
     * @param $statement the statement with query data.
     * @return Product|false object with retrieved data or false in case of error.
     */
    private function fetchTocategory($statement): mixed {
        $row = $statement->fetch();
        if ($row) {
            $id = intval($row['id']);
            $code = $row['code'];
            $description = $row['description'];
            $price = $row['price'];
            $category_id = $row['category_id'];

            return new Product($id, $code, $description, $price, $category_id);
        } else {
            return false;
        }
    }    
    
    /**
     * selects an product given its id.
     * @param product the product to search.
     * @return product object being searched or null if not found or in case of error.
     */
    public function select(Product $product): ?Product {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_ID']);
            $stmt->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    // //set fetch mode.
                    // $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // // get one row at the time
                    // if ($u = $this->fetchTocategory($stmt)){
                    //     $data = $u;
                    // }
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Product::class);
                    $data = $stmt->fetch();
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getCode();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }

    /**
     * selects all entitites in database.
     * return array of product objects.
     */
    public function selectAll(): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_ALL']);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                   //fetch in class mode and get array with all data.                   
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Product::class);
                    $data = $stmt->fetchAll(); 
                    //or in one single sentence:
                    // $data = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Product::class);
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getCode();
//            print "Error Message <br>".$e->getMessage();
//            print "Stack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }

    /**
     * selects entitites in database where field value.
     * return array of product objects.
     */
    public function selectWhere(string $fieldname, string $fieldvalue): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $query = sprintf("select * from %s where %s = '%s'", 
                self::$TABLE_NAME, $fieldname, $fieldvalue);
            $stmt = $connection->prepare($query);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Product::class);
                    $data = $stmt->fetchAll(); 
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Product');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getCode();
//            print "Error Message <br>".$e->getMessage();
//            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }

    /**
     * inserts a new product in database.
     * @param product the product object to insert.
     * @return number of rows affected.
     */
    public function insert(Product $product): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
            $stmt->bindValue(':code', $product->getCode(), \PDO::PARAM_STR);
            $stmt->bindValue(':description', $product->getDescription(), \PDO::PARAM_STR);
            $stmt->bindValue(':price', $product->getPrice(), \PDO::PARAM_STR);
            $stmt->bindValue(':category_id', $product->getCategoryId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;
    }

    /**
     * updates product in database.
     * @param product the product object to update.
     * @return number of rows affected.
     */
    public function update(Product $product): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
            $stmt->bindValue(':code', $product->getCode(), \PDO::PARAM_STR);
            $stmt->bindValue(':description', $product->getDescription(), \PDO::PARAM_STR);
            $stmt->bindValue(':price', $product->getPrice(), \PDO::PARAM_BOOL);
            $stmt->bindValue(':category_id', $product->getCategoryId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            print "Error Code <br>".$e->getCode();
            print "Error Message <br>".$e->getMessage();
            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;  
    }

    /**
     * deletes product from database.
     * @param product the product object to delete.
     * @return number of rows affected.
     */
    public function delete(Product $product): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.            
            $stmt = $connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(':id', $product->getId(), \PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getCode();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;        
    }    
    
}
