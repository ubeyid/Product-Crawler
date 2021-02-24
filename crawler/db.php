<?php



class Db{


   /***********CONNECT DB START ******************************/
   public static function connect_db(){
         $DB_NAME='googlestore';
         $SERVER_NAME = "localhost";
         $USER_NAME = "root";
         $PASSWORD = "";

      try {
           $conn = new PDO("mysql:host=$SERVER_NAME;dbname=$DB_NAME;charset=utf8", $USER_NAME, $PASSWORD);
            // set the PDO error mode to exception
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $conn;
         } catch(PDOException $e) {

           echo "Connection failed: " . $e->getMessage(); 
      
         }
   }
   /***********CONNECT DB END ***********************************/


   /***********CLOSE CONNECTION START *****************************/
   public static function close_connection($db){
       $db=null;
    }
   /***********CLOSE CONNECTION END *******************************/


   /***********INSERT PRODUCT DB START*******************************/
    public static function insert_product_into_database(Product $product){

       $sql = "INSERT INTO products SET 
                     product_title = ?,
                     title_self_link = ?, 
                     product_price = ?,
                     product_price_second = ?,
                     product_price_currency = ?,
                     product_image_url = ?,
                     product_page_url = ?,
                     page_icon_url = ?,
                     is_product_ssl = ?,
                     is_product_secure = ?,
                     product_last_update_time = ?,
                     website_domain = ?";

       $values=array($product->get_product_title(), 
                     $product->get_title_self_link(),
                     $product->get_product_price(),
                     $product->get_product_price_second(),
                     $product->get_product_price_currency(),
                     $product->get_product_image_url(),
                     $product->get_product_page_url(),
                     $product->get_page_icon_url(),
                     $product->get_is_product_ssl(),
                     $product->get_is_product_secure(),
                     $product->get_product_last_update_time(),
                     $product->get_website_domain());

       $db=Db::connect_db();
       $query=$db->prepare($sql);
       $insert=$query->execute($values);
       $db=null;
       if( $query->rowCount() > 0 ){
          //echo "Ürün Veritabanına eklendi...";
          
          return true;

       }else{
          return false;
       }
      

    }
   /***********INSERT PRODUCT DB END*******************************/


   /***********CHECK IF PRODUCT PAGE URL IS AVAILABLE OR NOT START****************/
   public static function check_if_product_page_url_is_available($url){
      $db=Db::connect_db();
      $query = $db->query("SELECT * FROM products WHERE product_page_url = '{$url}'")->fetch(PDO::FETCH_ASSOC);
      
      $db=null;
      if ( $query ){
          
          return true;
      }else{
          
          return false;
      }
      
   }
   /***********CHECK IF PRODUCT PAGE URL IS AVAILABLE OR NOT START****************/


   /***********UPDATE PRODUCT IN DATABASE START****************/

     public static function update_product_from_database($url,Product $product){
         $db=Db::connect_db();
         $sql="UPDATE products SET 
                     product_title = ?,
                     title_self_link = ?, 
                     product_price = ?,
                     product_price_second = ?,
                     product_price_currency = ?,
                     product_image_url = ?,
                     product_page_url = ?,
                     page_icon_url = ?,
                     is_product_ssl = ?,
                     is_product_secure = ?,
                     product_last_update_time = ?,
                     website_domain = ?
                     WHERE product_page_url = ?";

         $query = $db->prepare($sql);

         $update = $query->execute(array(
                  $product->get_product_title(),
                  $product->get_title_self_link(),
                  $product->get_product_price(),
                  $product->get_product_price_second(),
                  $product->get_product_price_currency(),
                  $product->get_product_image_url(),
                  $product->get_product_page_url(),
                  $product->get_page_icon_url(),
                  $product->get_is_product_ssl(),
                  $product->get_is_product_secure(),
                  $product->get_product_last_update_time(),
                  $product->get_website_domain(),
                  $url ));

          $db=null;

          if ( $query ){

            //print "güncelleme başarılı!";
            return true;

         }else{

          return false;

         }

      }
  /***********UPDATE PRODUCT IN DACTABASE END****************/


  /***********DELETE PRODUCT IN DATABASE START****************/
      public static function delete_product_from_database($url){
         $sql='DELETE FROM products WHERE product_page_url=?';
         $db=Db::connect_db();
         $query=$db->prepare($sql);
         $delete=$query->execute(array($url));
         $db=null;
         if( $query->rowCount() > 0 ){
            //echo "Product has been deleted...";
            return true;
         }else{
            //echo "Product no found or could not delete product...";
            return false;
         }

      }
  /***********DELETE PRODUCT IN DATABASE END****************/
  

  /***********INSERT WEBSITE TO DATABASE START****************/ 
      public static function insert_website_into_database($website){
          
               $sql = "INSERT INTO websites SET 
               website_domain = ?";
            
               $values=array($website);
               
               $db=Db::connect_db();
               $query=$db->prepare($sql);
               $insert=$query->execute($values);
               $db=null;
               if( $query->rowCount() > 0 ){
                   //echo "Site Veritabanına eklendi...";
               
                   return true;
               
               }else{
                  //echo "Site Veritabanına eklenemed!!!...";
                   return false;
               }
                
      }
  /***********INSERT WEBSITE TO DATABASE END****************/


  /***********CHECK IF WEBSITE AVAILABALE IN DATABASE START****************/
      public static function check_if_website_available_in_database($website){

         $db=Db::connect_db();
         $query = $db->query("SELECT * FROM websites WHERE website_domain = '{$website}'")->fetch(PDO::FETCH_ASSOC);
         
         $db=null;
         if ( $query ){
             //echo "Site veritabanında mevcut";
             return true;
         }else{
             //echo "Site veritabanında mevcut değil";
             return false;
         }    
   
      }
  /***********CHECK IF WEBSITE AVAILABALE IN DATABASE END****************/
 


  /***********DELETE WEBSITE FROM DATABASE START****************/
      public static function delete_website_from_database($website){
         if(Db::check_if_website_available_in_database($website)){
                $sql='DELETE FROM websites WHERE website_domain=?';
                $db=Db::connect_db();
                $query=$db->prepare($sql);
                $delete=$query->execute(array($website));
                $db=null;
                if( $query->rowCount() > 0 ){
                   //echo "Site silindi...";
                   return true;
                }else{
                  // echo "Site silinemedi...";
                   return false;
                }
       
         }else{
            //echo "Site veritabanında olmadığı için silinemedi...";
            return false;
         }

    
      }
  /***********DELETE WEBSITE FROM DATABASE END****************/

    
  /***********QUERY FOR ALL WEBSİTES STAR****************/
  public static function get_all_websites_from_database(){

          $websites=array();
        
          $db=Db::connect_db();
          $query = $db->query("SELECT * FROM websites", PDO::FETCH_ASSOC);
          $db=null;
       if ( $query->rowCount() ){
            foreach( $query as $row ){
                 $websites[]=$row['website_domain'];
                 
            }

       }else{

          return null;
       }
    
       return $websites;
  }
  /***********QUERY FOR ALL WEBSİTES END****************/


               
               
}

?>