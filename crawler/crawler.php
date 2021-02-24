<?php

error_reporting(E_ALL);
require('product-functions.php');
require_once('db.php');
//include('Product.php');


$visited_links=array();
$visiting=array();
$inserted=array();
$updated=array();
$deleted=array();

function crawl_product_pages($url){
      global $visited_links;
      global $visiting;
      global $inserted;
      global $updated;
      global $deleted;
      $pageString=curl($url);
      $html=new DomDocument();
      $internalErrors = libxml_use_internal_errors(true);
      @$html->loadHTML($pageString);
      libxml_use_internal_errors($internalErrors);
      $xpath=new DOMXpath($html);
  
      $links=$xpath->query('//a');
      
      
      foreach ($links as $link)  {
                  
                  # code...
                  $href =  $link->getAttribute("href");
                  $href=check_href($url,$href);
                   
                  if(!$href){
                    continue;

                  }

                  if(in_array($href,$visited_links)){
                        continue;
                  }
    
       ############# CHECKING URL FOR SAVING PRODUCTS START ###########################
                 echo substr($href,0,65).".:Sayfasında arama yapılıyor..."."\n";
                
                 $pageString=curl($href);
                 
                 if(Db::check_if_product_page_url_is_available($href)){
                      //echo("Url is in database product")."\n";
                         if(check_if_product($pageString)){
           
                                  $product=collect_product_all_info($href,$pageString);
                                  if(!$product){

                                    $visited_links[]=$href;
                                    $visiting[]=$href;
                                    continue;

                                  }
                               
                                   if(Db::update_product_from_database($href,$product)){
                                    echo "Ürün veritabanında güncellemesi yapıldı..."."\n";
                                     $updated[]=$href;
                                    } 
                                 
                                 
                          }else{
                                
                                if(Db::delete_product_from_database($href)){
                                  echo "Ürün silindi..."."\n";
                                  $deleted[]=$href;
                                }

                          }
          
                  }else{
                     //echo("Url is not in the database").'\n';

                         if(check_if_product($pageString)){
                               //echo("Url is product").'\n';
                                $product=collect_product_all_info($href,$pageString);
                                if(!$product){
                                    
                                  $visited_links[]=$href;
                                  $visiting[]=$href;
                                  continue;

                                }

                                if(Db::insert_product_into_database($product)){
                                    echo "Ürün veritabanına eklendi..."."\n";
                                    $inserted[]=$href;
  
                                } 
                                
                         }else{
                             echo "Ürün aramaya devam ediliyor..."."\n";
                             $visited_links[]=$href;
                             $visiting[]=$href;
                             continue;
                         }
                 }
           
        ############# CHECKING URL FOR SAVING PRODUCTS END ###########################
   
                $visited_links[]=$href;
                $visiting[]=$href;
              
      }

       /*********** THIS PREVENTS INFINITLY CRAWLING THE SAME PAGE ******* */
      echo substr($url,0,65).".".":Sayfasının  taraması bitti ..."."\n";
      echo "Toplamda ".sizeof($visited_links)." link tarandı..."."\n";
      echo "Toplamda ".sizeof($inserted)." Ürün veritabanına eklendi..."."\n";
      echo "Toplamda ".sizeof($updated)." Ürün güncellendi..."."\n";
      echo "Toplamda ".sizeof($deleted)." Ürün silindi..."."\n";

      sleep(5);
      array_shift($visiting);
      foreach ($visiting as $index=>$site) {
            
           echo substr($site,0,65).".".":Sayfası taranmaya başlandı!!!..."."\n"; 
           sleep(3);        
           if(!$site){
             continue;
           }
           crawl_product_pages($site);
      }
   

}



//$urls=Db::get_all_websites_from_database();
$urls=["https://www.trendyol.com/"];
function start_crawling_websites($urls){

   foreach ($urls as $url) {

        crawl_product_pages($url) ;

   }

}
start_crawling_websites($urls);

echo "Tüm Websiteler Tarandı...";
sleep(10);

                              
    

?>











<?php

/*  array_push($product,array('product_title'=>$product_title, 
 'title_self_link'=>$title_self_link,
 'product_price'=>$product_price,
 'product_price_second'=>$product_price_second,
 'product_price_currency'=>$product_price_currency,
 'product_image_url'=>$product_image_url,
 'product_page_url'=>$product_page_url,
 'page_icon_url'=>$page_icon_url,
 'is_product_ssl'=>$is_product_ssl,
 'is_product_secure'=>$is_product_secure,
 'product_last_update_time'=>$product_last_update_time                         
 )); */

?>