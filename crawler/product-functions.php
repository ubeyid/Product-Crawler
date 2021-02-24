<?php
include("Product.php");

error_reporting(0);
/**********GETTING PAGE CONTENT FROM CURL PHP START ****************************/
function curl($url){
    $headers[]  = "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13";
    $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
    $headers[]  = "Accept-Language:en-us,en;q=0.5";
    $headers[]  = "Accept-Encoding:gzip,deflate";
    $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $headers[]  = "Keep-Alive:115";
    $headers[]  = "Connection:keep-alive";
    $headers[]  = "Cache-Control:max-age=0";
    
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;

}
/**********GETTING PAGE CONTENT FROM CURL PHP END**********************************/


/**********REMOVING NON ASCII CHAR FROM STRING(TURN IT UTF-8)  START**************/
function remove_turkish_chars($str){
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', ')', '(');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o','','');
    return str_replace($a, $b, $str);
  
}
/**********REMOVING NON ASCII CHAR FROM STRING(TURN IT UTF-8) END*****************/


/**********TURNING STRING TO SELF LINK START*************************************/
function turn_string_to_self_link($str){
    return trim(strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
    array('', '-', ''), remove_turkish_chars($str))),'-');
}
/**********TURNING STRING TO SELF LINK END*************************************/


/**********REMOVE EXTENSIN FROM DOMAIN IE facebook.com will be facebook START******/
function remove_extension_from_domain($domain){
    if($domain){
        $new_domain=explode('.',$domain)[1];
        return $new_domain;
    }else{
        return null;
    }
   
}
/**********REMOVE EXTENSIN FROM DOMAIN IE facebook.com will be facebook END*******/


/**********GETTING DOMAIN NAME FROM URL START*************************************/
//getting domain name from url
function get_website_domain($url){
    $url_array=explode('/',$url);
    $new_url= $url_array[2];
    
    return($new_url);
  }
//finding and correcting url
function find_web_url($url){

    $explode=explode('/',$url);
    return $explode[0].'//'.$explode[1].$explode[2];
}
/**********GETTING DOMAIN NAME FROM URL END*************************************/


/**********CORRECTING RELATIVE URL TO ABSOLUTE URL START***************************/
//correcting url
function turn_relative_link_to_absolute_link($url,$link){
   return check_href($url,$link);
}
/**********CORRECTING RELATIVE URL TO ABSOLUTE URL END*******************************/


/**********CORRECTING PRODUCT PRICE AND PRICE CURRENCY START***********************/
//correct product work
function correct_product_priceCurrency($priceCurrency){
    if($priceCurrency === ""){
        return null;
    }else{
        return strtoupper($priceCurrency);
    }
    
}
function correct_product_price($price){
    if($price === ""){
        return null;
    }
    $search='.';
    $replace='';
    $search2=",";
    $replace2=".";

    //turn all alfa numeric char to none
    $search3='/[^0-9,\.]/im';
    $replace3='';
    $price=preg_replace($search3,$replace3,$price);

    $colon=strpos($price,',');
    $point=strpos($price,'.');

    if($colon !== false && $point !== false){
        $price=str_replace($search,$replace,$price);
        $price=str_replace($search2,$replace2,$price);
    }elseif($colon !== false && $point === false){
        $price=str_replace($search2,$replace2,$price);
    }elseif($colon === false && $point === false){
        $price=$price.'.00';
    }
    
    $price_length=strlen($price);
    $point_index=strpos($price,'.');
    $price_to_point=substr($price,0,$point_index);
    $point_to_end=substr($price,$point_index+1,$price_length-$point_index);
    if(strlen($point_to_end) === 1){
        $price=$price.'0';
    }elseif(strlen($point_to_end) > 2){
        $price=$price_to_point.'.'.substr($point_to_end,0,2);
    }

  
 return (float)trim($price);
}
/**********CORRECTİING PRODUCT PRICE AND PRICE CURRENCY END**********************/


//getting page info
/**********GETTING PAGE ICON INFO START*************************************/
function get_page_icon($pageString,$url){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);

    if(check_page_icon($xpath,$url)){

        return check_page_icon($xpath,$url);

    }elseif(check_page_shortcut_icon($xpath,$url)){

        return check_page_shortcut_icon($xpath,$url);

    }else{
        return null;
    }
}
function check_page_icon($xpath,$url){
    
    $elements=$xpath->query("//link[@rel='icon']");

    if($elements !== false && count($elements) >0){

        $element=$elements->item(0);

        $content=$element->getAttribute('href');

        if($content === ""){
            return null;
        }else{
            return turn_relative_link_to_absolute_link($url,$content);
        }
    }else{
        return null;
    }
}
function check_page_shortcut_icon($xpath,$url){
    $elements=$xpath->query("//link[@rel='shortcut icon']");
    if($elements !== false && count($elements) >0){
        $element=$elements->item(0);
        $content=$element->getAttribute('href');

        if($content === ""){
            return null;
        }else{
            return turn_relative_link_to_absolute_link($url,$content);
        }
    }else{
        return null;
    }
}
/**********GETTING PAGE ICON INFO END*************************************/

/**********REMOVING BACK SLASH FROM URL THAT CONTAIN IT START********************/
//removing back slash from url
function remove_back_slash_from_url($url){
    $pattern='/\\\\/im';
    return preg_replace($pattern,"",$url);
}
/**********REMOVING BACK SLASH FROM URL THAT CONTAIN IT END************************/


/**********FINDING SECOND PRİCE FROM FIRST PRICE START************************/
//finding second price for product
function find_product_second_price($price){
  $price=(float)($price);
  $second_price=$price+$price*0.1;
  return correct_product_price($second_price);
}
/**********FINDING SECOND PRİCE FROM FIRST PRICE END*************************/


/**********CHECKING WEBSITE IF IT HAS SSL CERTIFICATE OR NOT START**************/
//checking website has ssl sertificate or not from just url
function is_product_has_ssl($url){
    $pattern='/https:/im';
  preg_match($pattern,$url,$matches);
  if(count($matches) > 0){
      return 1;
  }else{
      return 0;
  }
}
/**********CHECKING WEBSITE IF IT HAS SSL CERTIFICATE OR NOT END*****************/


/****CHECKING WEBSITE IF IT IS SECURE OR NOT (GÜVEN DAMGASI TÜRKİYE İÇİN) START*****/
//check is product page secure ( güven damgasi) 
function is_product_secure($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);

    $elements=$xpath->query('//a');
    foreach($elements as $element){
        $href=$element->getAttribute('href');
        $pattern='/https:\/\/www\.guvendamgasi\.org/im'; 
        preg_match($pattern,$href,$match);
        if(count($match) > 0){
            return $href;
        }else{
            continue;
        }
    }
    return 0;
}
/*****CHECKING WEBSITE IF IT IS SECURE OR NOT (GÜVEN DAMGASI TÜRKİYE İÇİN) END*****/


/**********GETTING DATE FOR DESCRIBING PRODUCT LAST UPDATE TIME START*************/
function get_date(){

  date_default_timezone_set('Europe/Istanbul');

    $date=date('Y-m-d');
    return $date;
}
/**********GETTING DATE FOR DESCRIBING PRODUCT LAST UPDATE TIME END***************/

############################## GET LD JSON PRODUCT INFO START##############################
function get_ld_json_product_price_and_currency($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $elements=$xpath->query('//script[@type="application/ld+json"]');
  if($elements !== false && count($elements) >0){
          $product=array();
          foreach($elements as $element){

               $textContent=$element->textContent;
               $textContent=trim($textContent);
               $textContent=preg_replace('/\s/im',"",$textContent);
               $textContent=json_decode($textContent,1);

               $type= @$textContent["@type"];

               if($type){
                            if(strtolower($type) == "product"){
                                {
                                    //getting priceCurrency
                                   $priceCurrency=@$textContent["offers"]["priceCurrency"];
                                   if($priceCurrency){
                                       $product["priceCurrency"]=@$textContent["offers"]["priceCurrency"];
            
                                   }else{
                                       $priceCurrency=@$textContent["offers"][0]["priceCurrency"];
                                       if( $priceCurrency){
                                           $product["priceCurrency"]=@$textContent["offers"][0]["priceCurrency"];
                                           
                                       }
                                   }
            
                                 }
                               
                               {
                                   //getting price
                                     
                                     $price=@$textContent["offers"]["price"];
                                     if($price){
                                         $product["price"]=@$textContent["offers"]["price"];
                                        
                                     }else{
                                         $price=@$textContent["offers"][0]["price"];
                                         if( $price){
                                             $product["price"]=@$textContent["offers"][0]["price"];
                                         }
                                     }
                               }
                               {   
            
                                   //getting lowPrice
                                   $lowPrice=@$textContent["offers"]["lowPrice"];
                                   if($lowPrice){
                                       $product["lowPrice"]=@$textContent["offers"]["lowPrice"];
                                      
                                   }else{
                                       $lowPrice=@$textContent["offers"][0]["lowPrice"];
                                       if( $lowPrice){
                                           $product["lowPrice"]=@$textContent["offers"][0]["lowPrice"];
                                       }
                                   }
            
                               }
                               {
                                   //GETTING HIGH PRICE
                                   $highPrice=@$textContent["offers"]["highPrice"];
                                   if($highPrice){
                                       $product["highPrice"]=@$textContent["offers"]["highPrice"];
                                      
                                   }else{
                                       $highPrice=@$textContent["offers"][0]["highPrice"];
                                       if( $highPrice){
                                           $product["highPrice"]=@$textContent["offers"][0]["highPrice"];
                                       }
                                   }
            
                               }
            
                              {
                                  //SELECTING PRICE
                                  if(@!$product["price"] && @$product["lowPrice"]){
                                      $product["price"]=$product["lowPrice"];
                                   }if(@!$product["price"] && @!$product["lowPrice"] && $product["highPrice"]){
                                      $product["price"]=$product["highPrice"];
                                   }
                              }
            
                               
                               //correcting price
                               $product["price"]=correct_product_price(@$product["price"]);
                               //correcting priceCurrenc
                               $product["priceCurrency"]=correct_product_priceCurrency(@$product["priceCurrency"]);
                              
                               if($product["priceCurrency"] == null || $product["price"] == null){
                               //checking if one of them is null it meand there is no product here
                                return false;
                              }else{
                                  return $product;
                              }
                         
                                

                               //if type is not product continue
                             }else{
                                 continue;
                             }
                      //if there is no type continue       
                    }else{
                     continue;
                    }
               
                
                          
                      
            }
         // print_r($product);
         return false;
  }else{
     return false;
  }
}

function get_ld_json_product_image($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $elements=$xpath->query('//script[@type="application/ld+json"]');
  if($elements !== false && count($elements) >0){
          $product=array();
          foreach($elements as $element){

               $textContent=$element->textContent;
               $textContent=trim($textContent);
               $textContent=preg_replace('/\s/im',"",$textContent);
               $textContent=json_decode($textContent,1);

               $type= @$textContent["@type"];
                if($type){
                           if(strtolower($type) == "product"){
                                       
                                {
                                    //finding image
                                     $image=@$textContent["image"];
                                    if(is_string($image)){
                                        $product["image"]=$image;
                                    }else{
                                         if(is_string(@$textContent["image"][0])){
           
                                             $product["image"]=@$textContent["image"][0];
           
                                         }else{
           
                                             if(is_string(@$image["url"])){
           
                                                 $product["image"]=@$image["url"];
              
                                             }else{
                                                  
                                                  if(is_string(@$image[0]["url"])){
                                                  
                                                     $product["image"]=@$image[0]["url"];
                  
                                                  }
                                             
                                              }
           
           
                                         }
           
                                     }
           
                                 } 
                                  
                           
                                  
                                   if($product["image"] == null){
                                   //checking if one of them is null it meand there is no product here
                                    return null;
                                  }else{
                                      return $product["image"];
                                  }
                                 
                             //if type is not product continue     
                          }else{
                              continue;
                          }


                         //if there is no type continue;      
                        }else{
                         continue;
                        }

                             
                        
               }
         // print_r($product);
         return false;
  }else{
     return false;
  }
}

function check_ld_json_is_product($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $elements=$xpath->query('//script[@type="application/ld+json"]');
  if($elements !== false && count($elements) >0){
          $product=array();
          foreach($elements as $element){

               $textContent=$element->textContent;
               $textContent=trim($textContent);
               $textContent=preg_replace('/\s/im',"",$textContent);
               $textContent=json_decode($textContent,1);
               
               $type= @$textContent["@type"];

                   if($type){
                                if(strtolower($type) == "product"){
                                      return true;
                                   
                                 }else{
                                     continue;
                                 }
                        }else{
                         continue;
                        }
            }
         
         return false;
  }else{
     return false;
  }
}


function get_ld_json_title($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $elements=$xpath->query('//script[@type="application/ld+json"]');
  if($elements !== false && count($elements) >0){
          $product=array();
          foreach($elements as $element){

               $textContent=$element->textContent;
               $textContent=trim($textContent);
               
               $textContent=json_decode($textContent,1);

               $type= @$textContent["@type"];

               if($type){
                            if(strtolower($type) == "product"){
                                $name= @$textContent["name"];
   
                                if($name){
             
                                      return $name;
             
                                     }else{
             
                                      continue;
             
                                     }


                               //if type is not product continue
                             }else{
                                 continue;
                                }
                     //if there is no type continue 
                    }else{
                     continue;
                    }

            }
         
         return false;
  }else{
     return false;
  }
}
############################## GET LD JSON PRODUCT INFO END##############################



############################## GET OG PRODUCT INFO START##############################


function get_og_product_price_and_currency($pageString){
  $html=new DomDocument();
  $internalErrors = libxml_use_internal_errors(true);
  @$html->loadHTML($pageString);
  libxml_use_internal_errors($internalErrors);
  $xpath=new DOMXpath($html);
  
  $product=array();


  {
      if(check_og_is_product($pageString)){
        {
            //getting product price
             $price=@$xpath->query('//head/meta[@property="og:price:amount"]')->item(0);
              
             if($price){
                $product["price"]=@$price->getAttribute("content");
             }else{
                $product["price"]=null;
             }
             
         
            
        
        }

       {
            //getting priceCurrency
              $priceCurrency=@$xpath->query('//head/meta[@property="og:price:currency"]')->item(0);
            
              if($priceCurrency){
                $product["priceCurrency"]=@$priceCurrency->getAttribute("content");
              }else{
                $product["priceCurrency"]=null;
              }
              
       
        } 
        {
            //correcting product price
                if(@$product["price"]){
                  $product["price"]=correct_product_price($product["price"]);
                }
               
            
             
             
             //correcting product priceCurrency
               if(@$product["priceCurrency"]){
                  $product["priceCurrency"]=correct_product_priceCurrency($product["priceCurrency"]);
               }
                
             
             
         
        }
        {
              //check if is product info available
              if($product["price"] == null || $product["priceCurrency"] == null ){
                  return false;
              }else{
                  return $product;
              }
        }
 

  
      }else{
          return false;
      }
   
 }
 

 

}

function get_og_product_image($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $product=array();
  
  
    {
       if(check_og_is_product($pageString)){
              //getting image
              $image=@$xpath->query('//head/meta[@property="og:image"]')->item(0);
              if($image){
                 $image=@$image->getAttribute("content");
                 return $image;
              }else{
                 return false;
              }
            
       }else{
           return false;
       }
        
    }
   
}


function check_og_is_product($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $product=array();
  
  
    {
        //getting page tpe
        $type=@$xpath->query('//head/meta[@property="og:type"]')->item(0);
        if($type){
            $type=@$type->getAttribute("content");
            if(strtolower($type) == "product"){
               return true;

            }else{
                return false;
            }
        }else{
            return false;
        }
    }
   
}


function get_og_product_title($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);

    {
        if(check_og_is_product($pageString)){
             //getting title
             $title=@$xpath->query('//head/meta[@property="og:title"]')->item(0);
             if($title){
           
               $title=@$title->getAttribute("content");
               return $title;
           
             }else{
           
               return false;
             }
        }else{
            return false;
        }
    }
  
}
############################## GET OG PRODUCT INFO END################################

############################## CHECK IF ITEMPROP IS PRODUCT START################################
function check_itemprop_is_product($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $product=array();
  
  
    {
        //getting page tpe
        $type=@$xpath->query('//*[@itemtype="http://schema.org/Product"]')->item(0);
        if($type){
            return true;
        }else{
            return false;
        }
    }

}
############################## CHECK IF ITEMPROP IS PRODUCT END################################

############################## GET ITEMPROP PRICE AND CURRENCY START################################
function get_itemprop_product_price_and_currency($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $product=array();
  
  
    {
        //getting page tpe
        $type=@$xpath->query('//*[@itemtype="http://schema.org/Product"]')->item(0);
        if($type){
             
            $price=null;
                //GETTING PRICE
            $priceEl=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//*[@itemtype="http://schema.org/Offer"]//*[@itemprop="price"]')->item(0);
            $lowPriceEl=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//*[@itemtype="http://schema.org/Offer"]//*[@itemprop="lowPrice"]')->item(0);
            $highPriceEl=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//*[@itemtype="http://schema.org/Offer"]//*[@itemprop="highPrice"]')->item(0);
            //CHECKING PRICES
            if($priceEl){
                $price=$priceEl;
            }elseif($lowPriceEl){
                $price=$lowPriceEl;
            }elseif($highPriceEl){
                $price=$highPriceEl;
            }else{
                return false;
            }
            
            if($price){
                $pr=$price->getAttribute("content");
                if($pr){
                    $product["price"]= $pr;
                }else{
                    $pr=$price->textContent;
                    if($pr){
                        $product["price"]= $pr;
                    }else{
                        return false;
                    }
                }

            }else{
                return false;
            }
            //GETTING PRICE CURRENCY
            $priceCurrencyEl=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//*[@itemtype="http://schema.org/Offer"]//*[@itemprop="priceCurrency"]')->item(0);
             if($priceCurrencyEl){
                 $prCurrency=$priceCurrencyEl->getAttribute("content");
                 if($prCurrency){
                     $product["priceCurrency"]=$prCurrency;
                 }else{
                    $prCurrency=$priceCurrencyEl->textContent;
                    if($prCurrency){
                        $product["priceCurrency"]=$prCurrency;
                    }
                 }
             }
             
             //GETTING PRICE CURRENCY IF PRICE EXIST BUT CURRENCY  NOT EXIST
            
             if( !$product["priceCurrency"] ){

                $product["priceCurrency"]="TRY";

             }
             //END OF THE GETTING PRICE CURRENCY FROM PRICE

             $product["price"]=correct_product_price($product["price"]);
             $product["priceCurrency"]=correct_product_priceCurrency($product["priceCurrency"]);
             
             if(!$product["price"] || !$product["priceCurrency"]){
                 return null;
             }else{
                return $product;
             }
             
         //if it is not product   
        }else{
            return false;
        }
    }

}
############################## GET ITEMPROP PRICE AND CURRENCY END################################

############################## GET ITEMPROP IMAGE START################################
function get_itemprop_product_image($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    {
        $type=@$xpath->query('//*[@itemtype="http://schema.org/Product"]')->item(0);
        if($type){
              
            
            $imgs=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//img[@itemprop="image"]');
            if($imgs){

                foreach ($imgs as $img) {
                    # code...
                    $src=$img->getAttribute("src");
                    if($src){
                        return $src;
                    }else{
                        continue;
                    }
    
                }

            }
            
        
            $as=@$xpath->query('//*[@itemtype="http://schema.org/Product"]//a[@itemprop="image"]');
            
            if($as){
                foreach ($as as $a) {
                    # code...
                    $href=$a->getAttribute("href");
                    if($href){
                        return $href;
                    }else{
                        continue;
                    }
    
                }
            }
           
           return false;
        }else{
            return false;
        }
    }

}

############################## GET ITEMPROP IMAGE END################################


############################## CHECK IF PRODUCT AVAILABLE START################################
function check_if_product($pageString){

       if(check_og_is_product($pageString) || check_ld_json_is_product($pageString) || check_itemprop_is_product($pageString)){
           return true;
       }else{
           return false;
       }
    
}

############################## CHECK IF PRODUCT AVAILABLE END################################

############################## GET PRODUCT PRICE AND CURRENCY START################################

function get_product_price_and_currency($pageString){

       if(get_ld_json_product_price_and_currency($pageString)){
           
           return get_ld_json_product_price_and_currency($pageString);
      
       }elseif(get_og_product_price_and_currency($pageString)){
      
           return get_og_product_price_and_currency($pageString);
           
       }elseif(get_itemprop_product_price_and_currency($pageString)){

           return get_itemprop_product_price_and_currency($pageString);

       }
}

############################## GET PRODUCT PRICE AND CURRENCY END################################

function get_product_image($pageString){

     if(get_ld_json_product_image($pageString)){

         return get_ld_json_product_image($pageString);

     }elseif(get_og_product_image($pageString)){

         return get_og_product_image($pageString);

     }elseif(get_itemprop_product_image($pageString)){

         return get_itemprop_product_image($pageString);

     }
}
function get_product_title($pageString){

      if(get_ld_json_title($pageString)){

          return get_ld_json_title($pageString);

      }elseif(get_og_product_title($pageString)){

          return get_og_product_title($pageString);

      }else{

        return get_title_from_page($pageString);

      }

}
function get_title_from_page($pageString){
    $html=new DomDocument();
    $internalErrors = libxml_use_internal_errors(true);
    @$html->loadHTML($pageString);
    libxml_use_internal_errors($internalErrors);
    $xpath=new DOMXpath($html);
    
    $title=$xpath->query('//title')->item(0);

    return $title->textContent;
}
############################## GET PRODUCT IMAGE  START################################



function get_first_image($images){
    $first_image=explode(',',$images)[0];
    return $first_image;
}
/**********COLLECT PRODUCT ALL INFO FROM THE OTHER FUNCTIONS START***************/
function collect_product_all_info($url,$pageString){
      
    $price_and_currency=get_product_price_and_currency($pageString);
    $product_image_url=get_first_image(get_product_image($pageString));//for trendyol there is a bug its json syntax
    $product_title=get_product_title($pageString);
    $product_price=@$price_and_currency["price"];
    $product_price_currency=@$price_and_currency["priceCurrency"];
    $product_page_url=$url;
    $is_product_ssl=is_product_has_ssl($product_page_url);
    $title_self_link=remove_extension_from_domain(@parse_url($product_page_url)["host"]).'-'.turn_string_to_self_link($product_title);
    $page_icon_url=get_page_icon($pageString,$url);
    $product_price_second=find_product_second_price($product_price);
    $is_product_secure=is_product_secure($pageString);
    $product_last_update_time=get_date();
    $website_domain=@parse_url($product_page_url)["host"];
     
    if(!$product_image_url      ||
       !$product_title          ||
       !$product_price          ||
       !$product_price_currency ||
       !$product_page_url       ||
       !$page_icon_url ){
           return null;
       }
      $product=new Product(trim($product_title),
            trim($title_self_link),
            trim($product_image_url),
            trim($product_price),
            trim($product_price_currency),
            trim($page_icon_url),
            trim($product_price_second),
            trim($product_page_url),
            trim($is_product_ssl),
            trim($is_product_secure),
            trim($product_last_update_time),
            trim($website_domain));

      return $product;      
}
/**********COLLECT PRODUCT ALL INFO FROM THE OTHER FUNCTIONS END***************/


/**********TURNING RELATIVE URL TO ABSOLUTE URL START ***************/
 function check_href($url,$href){
    $l =  $href;
    // Process all of the links we find. This is covered in part 2 and part 3 of the video series.
    if (substr($l, 0, 1) == "/" && substr($l, 0, 2) != "//") {
        $l = parse_url($url)["scheme"]."://".parse_url($url)["host"].$l;
    } else if (substr($l, 0, 2) == "//") {
        $l = parse_url($url)["scheme"].":".$l;
    } else if (substr($l, 0, 2) == "./") {
        $l = parse_url($url)["scheme"]."://".parse_url($url)["host"].dirname(parse_url($url)["path"]).substr($l, 1);
    } else if (substr($l, 0, 1) == "#") {
        $l = parse_url($url)["scheme"]."://".parse_url($url)["host"].parse_url($url)["path"].$l;
    } else if (substr($l, 0, 3) == "../") {
        $l = parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$l;
    } else if (substr($l, 0, 11) == "javascript:") {
        return null;
    } else if (substr($l, 0, 5) != "https" && substr($l, 0, 4) != "http") {
        $l = parse_url($url)["scheme"]."://".parse_url($url)["host"]."/".$l;
    }
  
    return $l;
} 
/**********TURNING RELATIVE URL TO ABSOLUTE URL END ***************/


 ?>


