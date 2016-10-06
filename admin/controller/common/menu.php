<?php
class ControllerCommonMenu extends Controller {  
 protected function index() {
   $this->load->language('common/menu');

   $this->data['text_admin'] = $this->language->get('text_admin');
   $this->data['text_backup'] = $this->language->get('text_backup');
   $this->data['text_export'] = $this->language->get('text_export');
   $this->data['text_catalog'] = $this->language->get('text_catalog');
   $this->data['text_category'] = $this->language->get('text_category');
   $this->data['text_configuration'] = $this->language->get('text_configuration');
   $this->data['text_country'] = $this->language->get('text_country');
   $this->data['text_coupon'] = $this->language->get('text_coupon');
   $this->data['text_currency'] = $this->language->get('text_currency');   
   $this->data['text_customer'] = $this->language->get('text_customer');
   $this->data['text_customer_group'] = $this->language->get('text_customer_group');
   $this->data['text_customers'] = $this->language->get('text_customers');
   $this->data['text_download'] = $this->language->get('text_download');
   $this->data['text_error_log'] = $this->language->get('text_error_log');
   $this->data['text_extension'] = $this->language->get('text_extension');
   $this->data['text_feed'] = $this->language->get('text_feed');
   $this->data['text_geo_zone'] = $this->language->get('text_geo_zone');
   $this->data['text_home'] = $this->language->get('text_home');
   $this->data['text_help'] = $this->language->get('text_help');
   $this->data['text_information'] = $this->language->get('text_information');
   // (+) ALNAUA 091114 (START)
   $this->data['text_information_page'] = $this->language->get('text_information_page');
   $this->data['text_information_news'] = $this->language->get('text_information_news');
   $this->data['text_color'] = $this->language->get('text_color');
   $this->data['text_techparam'] = $this->language->get('text_techparam');
   $this->data['text_advcategory'] = $this->language->get('text_advcategory');
   $this->data['text_advice'] = $this->language->get('text_advice');
   $this->data['text_question'] = $this->language->get('text_question');
   $this->data['text_contactseditor'] = $this->language->get('text_contactseditor');
   // (+) ALNAUA 091114 (FINISH)
   // 130415 ET-130411 Begin
   $this->data['text_video'] = $this->language->get('text_video');
   $this->data['text_banner'] = $this->language->get('text_banner');
   // 130415 ET-130411 End
   // 140323 ET-140323 Begin
   $this->data['text_shipment'] = $this->language->get('text_shipment');
   // 140323 ET-140323 End
   // 100223 ALNAUA Site redesign Begin
   $this->data['text_colorcategory'] = $this->language->get('text_colorcategory');
   // 100223 ALNAUA Site redesign End
   // 20120204 ALNAUA ET-111227 Begin
   $this->data['text_credit'] = $this->language->get('text_credit');
   // 20120204 ALNAUA ET-111227 End
   $this->data['text_language'] = $this->language->get('text_language');
   $this->data['text_localisation'] = $this->language->get('text_localisation');
   $this->data['text_logout'] = $this->language->get('text_logout');   
   $this->data['text_contact'] = $this->language->get('text_contact');
   $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
   $this->data['text_module'] = $this->language->get('text_module');
   $this->data['text_order'] = $this->language->get('text_order');
   $this->data['text_order_status'] = $this->language->get('text_order_status');
   $this->data['text_payment'] = $this->language->get('text_payment');
   $this->data['text_product'] = $this->language->get('text_product');
   $this->data['text_reports'] = $this->language->get('text_reports');
   $this->data['text_report_purchased'] = $this->language->get('text_report_purchased');       
   $this->data['text_report_sale'] = $this->language->get('text_report_sale');
   $this->data['text_report_viewed'] = $this->language->get('text_report_viewed');
   $this->data['text_review'] = $this->language->get('text_review');
   $this->data['text_support'] = $this->language->get('text_support');
   $this->data['text_shipping'] = $this->language->get('text_shipping');
   $this->data['text_shop'] = $this->language->get('text_shop');   
   $this->data['text_setting'] = $this->language->get('text_setting');
   $this->data['text_stock_status'] = $this->language->get('text_stock_status');
   $this->data['text_tax_class'] = $this->language->get('text_tax_class');
   $this->data['text_total'] = $this->language->get('text_total');
   $this->data['text_user'] = $this->language->get('text_user');
   $this->data['text_user_group'] = $this->language->get('text_user_group');
   $this->data['text_users'] = $this->language->get('text_users');
   $this->data['text_documentation'] = $this->language->get('text_documentation');
   $this->data['text_weight_class'] = $this->language->get('text_weight_class');
   $this->data['text_measurement_class'] = $this->language->get('text_measurement_class');
   $this->data['text_opencart'] = $this->language->get('text_opencart');
   $this->data['text_zone'] = $this->language->get('text_zone');

   $this->data['backup'] = $this->url->https('tool/backup');
   $this->data['export'] = $this->url->https('tool/export');
   $this->data['category'] = $this->url->https('catalog/category');
   $this->data['country'] = $this->url->https('localisation/country');
   $this->data['currency'] = $this->url->https('localisation/currency');
   $this->data['coupon'] = $this->url->https('customer/coupon');
   $this->data['customer'] = $this->url->https('customer/customer');
   $this->data['customer_group'] = $this->url->https('customer/customer_group');
   $this->data['download'] = $this->url->https('catalog/download');
   $this->data['error_log'] = $this->url->https('tool/error_log');
   $this->data['feed'] = $this->url->https('extension/feed');   
   $this->data['geo_zone'] = $this->url->https('localisation/geo_zone');
   $this->data['home'] = $this->url->https('common/home'); 
   // (-/+) ALNAUA 091114 (START)
   //$this->data['information'] = $this->url->https('catalog/information');
   $this->data['information'] = $this->url->https('catalog/information');
   $this->data['information_page'] = $this->url->https('catalog/information&type=page');
   $this->data['information_news'] = $this->url->https('catalog/information&type=news');
   $this->data['color'] = $this->url->https('catalog/color');
   $this->data['techparam'] = $this->url->https('catalog/techparam');
   $this->data['advcategory'] = $this->url->https('catalog/advcategory');
   $this->data['advice'] = $this->url->https('catalog/advice');
   $this->data['question'] = $this->url->https('catalog/question');
   $this->data['contactseditor'] = $this->url->https('catalog/contactseditor');
   // (-/+) ALNAUA 091114 (FINISH)
   // 130415 ET-130411 Begin
   $this->data['video'] = $this->url->https('catalog/video');
   $this->data['banner'] = $this->url->https('design/banner');
   // 130415 ET-130411 End
   // 140323 ET-140323 Begin
   $this->data['shipment'] = $this->url->https('catalog/shipment');
   // 140323 ET-140323 End
   // 100223 ALNAUA Site redesign Begin
   $this->data['colorcategory'] = $this->url->https('catalog/colorcategory');
   // 100223 ALNAUA Site redesign End
   // 20120204 ALNAUA ET-111227 Begin
   $this->data['credit'] = $this->url->https('catalog/credit');
   // 20120204 ALNAUA ET-111227 End
   $this->data['language'] = $this->url->https('localisation/language');
   $this->data['logout'] = $this->url->https('common/logout');
   $this->data['contact'] = $this->url->https('customer/contact');
   $this->data['manufacturer'] = $this->url->https('catalog/manufacturer');
   $this->data['module'] = $this->url->https('extension/module');
   $this->data['order'] = $this->url->https('customer/order');
   $this->data['order_status'] = $this->url->https('localisation/order_status');
   $this->data['payment'] = $this->url->https('extension/payment');
   $this->data['product'] = $this->url->https('catalog/product');
   $this->data['report_purchased'] = $this->url->https('report/purchased');
   $this->data['report_sale'] = $this->url->https('report/sale');
   $this->data['report_viewed'] = $this->url->https('report/viewed');
   $this->data['review'] = $this->url->https('catalog/review');
   $this->data['shipping'] = $this->url->https('extension/shipping');
   $this->data['shop'] = HTTP_CATALOG;
   $this->data['setting'] = $this->url->https('setting/setting');
   $this->data['stock_status'] = $this->url->https('localisation/stock_status');
   $this->data['tax_class'] = $this->url->https('localisation/tax_class');
   $this->data['total'] = $this->url->https('extension/total');
   $this->data['user'] = $this->url->https('user/user');
   $this->data['user_group'] = $this->url->https('user/user_permission');
   $this->data['weight_class'] = $this->url->https('localisation/weight_class');
   $this->data['measurement_class'] = $this->url->https('localisation/measurement_class');
   $this->data['zone'] = $this->url->https('localisation/zone');

   $this->data['logged'] = $this->user->isLogged();

   $this->id       = 'menu';
   $this->template = 'common/menu.tpl';

   $this->render();
  }
}
?>