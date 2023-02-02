<?php
namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/WarehouseProducts.php';
require_once 'model/Product.php';

use proven\store\model\persist\StoreDb   as DbConnect;
use proven\store\model\WarehouseProducts as WarehouseProducts;
use proven\store\model\Product as Product;

/**
 * WarehouseProducts database persistence class.
 * @author ProvenSoft
 * 
 * TODO
 */
class WarehouseDaoProducts {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for warehouseProducts.
     */
    private static string $TABLE_NAME = 'warehousesproducts';
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
        $this->queries['SELECT_WHERE_WAREHOUSE_ID'] = \sprintf(
                "select * from %s where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_PRODUCT_ID'] = \sprintf(
            "select * from %s where product_id = :product_id", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (warehouse_id, product_id, stock) values (:warehouse_id, :product_id, :stock)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set warehouse_id = :warehouse_id, product_id = :product_id, stock = :stock where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );
        $this->queries['DELETE'] = \sprintf(
                "delete from %s where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );              
    }

    /**
     * fetches a row from PDOStatement and converts it into an warehouseproduct object.
     * @param $statement the statement with query data.
     * @return WarehouseProducts|false object with retrieved data or false in case of error.
     */
    private function fetchTocategory($statement): mixed {
        $row = $statement->fetch();
        if ($row) {
            $warehouseid = intval($row['warehouseid']);
            $productid = $row['productid'];
            $stock = $row['stock'];

            return new WarehouseProducts($warehouseid, $productid, $stock);
        } else {
            return false;
        }
    }    
    
    /**
     * selects an warehouseProducts given its id.
     * @param warehouseProducts the warehouseProducts to search.
     * @return warehouseProducts object being searched or null if not found or in case of error.
     */
    public function select(WarehouseProducts $warehouseProducts): ?WarehouseProducts {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_ID']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_INT);
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
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetch();
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }

    /**
     * selects all entitites in database.
     * return array of warehouseProducts objects.
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
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetchAll(); 
                    //or in one single sentence:
                    // $data = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getProductId();
//            print "Error Message <br>".$e->getMessage();
//            print "Stack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }
    /**
     * selects w entitites in database.
     * return array of warehouseProducts objects.
     */
    public function selectWarehouseProductWhereProductId( Product $product): array {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_PRODUCT_ID']);
            $stmt->bindValue(':product_id', $product->getId(), \PDO::PARAM_INT);
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
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetch();
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }
    /**
     * selects entitites in database where field value.
     * return array of warehouseProducts objects.
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
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetchAll(); 
                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'WarehouseProducts');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getProductId();
//            print "Error Message <br>".$e->getMessage();
//            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }

    /**
     * inserts a new warehouseProducts in database.
     * @param warehouseProducts the warehouseProducts object to insert.
     * @return number of rows affected.
     */
    public function insert(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_STR);
            $stmt->bindValue(':product_id', $warehouseProducts->getProductId(), \PDO::PARAM_STR);
            $stmt->bindValue(':stock', $warehouseProducts->getStock(), \PDO::PARAM_STR);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;
    }

    /**
     * updates warehouseProducts in database.
     * @param warehouseProducts the warehouseProducts object to update.
     * @return number of rows affected.
     */
    public function update(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_STR);
            $stmt->bindValue(':product_id', $warehouseProducts->getProductId(), \PDO::PARAM_STR);
            $stmt->bindValue(':stock', $warehouseProducts->getStock(), \PDO::PARAM_STR);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;  
    }

    /**
     * deletes warehouseProducts from database.
     * @param warehouseProducts the warehouseProducts object to delete.
     * @return number of rows affected.
     */
    public function delete(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.            
            $stmt = $connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;        
    }    
    
}
