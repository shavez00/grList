<?php
class grDbAccess implements grDbInterface {
	private $con = NULL;
	
	public function __construct() {
	    try {
	      //create our pdo object
        $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        //set how pdo will handle errors
        $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      } catch (PDOException $e) {
        echo "Error creating PDO connection, at line " . __LINE__. " in file " . __FILE__ . "</br>";
        echo $e->getMessage() . "</br>";
        exit;
      }
  }

  public function getGrListId($userId, $grName = NULL) {
	  if ($userId!==NULL) try {
            //this would be our query.
            $sql = "SELECT * FROM groceryList WHERE userId = :userId";
            //prepare the statements
            $stmt = $this->con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "userId", $userId, PDO::PARAM_STR );
            $stmt->execute();
            $grList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $grList;
        } catch (PDOException $e) {
          echo "Error with getGrListId method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
          echo $e->getMessage() . "</br>";
          exit;
        }
    if ($grName!==NULL && $userId==NULL) try {
            //this would be our query.
            $sql = "SELECT * FROM groceryList WHERE grName = :grName";
            //prepare the statements
            $stmt = $this->con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "grName", $grName, PDO::PARAM_STR );
            $stmt->execute();
            $grList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $grList;
        } catch (PDOException $e) {
          echo "Error with getGrListId method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
          echo $e->getMessage() . "</br>";
          exit;
        }
        throw new Exception("No userId or Name given in getGrListId method!");
  }

  public function setGrListId($userId, $grName = NULL) {
	  if (empty($this->getGrListId(NULL, $grName))) try {
		  $sql = "INSERT INTO groceryList(userId, grName) VALUES(:userId, :grName)";
            
       $stmt = $this->con->prepare( $sql );
       //$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
       $stmt->bindValue( "userId", $userId, PDO::PARAM_INT );
       $stmt->bindValue( "grName", $grName, PDO::PARAM_STR );
       $stmt->execute();
       $result = $this->con->lastInsertId();
       return $result;
      } catch( PDOException $e ) {
	      echo "Error in the setGrListId method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
        echo $e->getMessage() . "</br>";
        exit;
      }
  }
  
  public function getGrListItems($grListId) {
	  try {
		        $sql=NULL;
		        $stmt=NULL;
            //this would be our query.
            $sql = "SELECT * FROM grListANDItemsIntersection WHERE grListId = :grListId";
            //prepare the statements
            $stmt = $this->con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "grListId", $grListId, PDO::PARAM_STR );
            $stmt->execute();
            $grListItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $grListItems;
        } catch (PDOException $e) {
          echo "Error with getGrListItems method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
          echo $e->getMessage() . "</br>";
          exit;
        }
  }

  public function setItem(array $itemArray) {
	  if ($itemArray["item"] == NULL) throw new Exception("Item name needs to be set!");
    try {
            //this would be our query.
            $sql = "SELECT * FROM items WHERE item LIKE :item";
            //if (isset($itemArray["measure"])) if ($itemArray["measure"] != NULL) $sql = $sql . " AND measure = :measure";
            //prepare the statements
            $stmt = $this->con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "item", "%" . $itemArray["item"] . "%", PDO::PARAM_STR );
            $stmt->execute();
            $existingItem = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          echo "Error with getGrListId method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
          echo $e->getMessage() . "</br>";
          exit;
        }
        if (!empty($existingItem)) {
	        return $existingItem;
	      } else {
		      try {
		        $sql = "INSERT INTO items(item, measure) VALUES(:item, :measure)";
            
            $stmt = $this->con->prepare( $sql );
            $stmt->bindValue( "item", $itemArray["item"], PDO::PARAM_STR );
            $stmt->bindValue( "measure", $itemArray["measure"], PDO::PARAM_STR );
            $stmt->execute();
            $result = $this->con->lastInsertId();
            return $result;
          } catch( PDOException $e ) {
	          echo "Error in the setItem method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
            echo $e->getMessage() . "</br>";
            exit;
          }
	      }
  }
}

?>