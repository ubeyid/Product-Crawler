<?php

class Product{
    public $product_title;
    public $title_self_link;
    public $product_image_url;
    public $product_price;
    public $product_price_currency;
    public $page_icon_url;
    public $product_price_second;
    public $product_page_url;
    public $is_product_ssl;
    public $is_product_secure;
    public $product_last_update_time;
    public $website_domain;
    
    function __construct($product_title,
                         $title_self_link,
                         $product_image_url,
                         $product_price,
                         $product_price_currency,
                         $page_icon_url,
                         $product_price_second,
                         $product_page_url,
                         $is_product_ssl,
                         $is_product_secure,
                         $product_last_update_time,
                         $website_domain){

          $this->product_title=$product_title;
          $this->title_self_link=$title_self_link;
          $this->product_image_url=$product_image_url;
          $this->product_price=$product_price;
          $this->product_price_currency=$product_price_currency;
          $this->page_icon_url=$page_icon_url;
          $this->product_price_second=$product_price_second;
          $this->product_page_url=$product_page_url;
          $this->is_product_ssl=$is_product_ssl;
          $this->is_product_secure=$is_product_secure;
          $this->product_last_update_time=$product_last_update_time;
          $this->website_domain=$website_domain;

    }

    function get_product_title(){
        return $this->product_title;
    }
    function get_title_self_link(){
        return $this->title_self_link;
    }
    function get_product_image_url(){
        return $this->product_image_url;
    }
    function get_product_price(){
        return $this->product_price;
    }
    function get_product_price_currency(){
        return $this->product_price_currency;
    }
    function get_page_icon_url(){
        return $this->page_icon_url;
    }
    function get_product_price_second(){
        return $this->product_price_second;
    }
    function get_product_page_url(){
        return $this->product_page_url;
    }
    function get_is_product_ssl(){
        return $this->is_product_ssl;
    }
    function get_is_product_secure(){
        return $this->is_product_secure;
    }
    function get_product_last_update_time(){
        return $this->product_last_update_time;
    }
    function get_website_domain(){
        return $this->website_domain;
    }
}



?>