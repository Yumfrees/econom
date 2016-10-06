<?php  
class ControllerCustomerOrder extends Controller {
 private $error = array();
   
   public function index() {
  $this->load->language('customer/order');
  
  $this->document->title = $this->language->get('heading_title');
  
  $this->load->model('customer/order');
  
     $this->getList(); 
   }
              
   public function update() { 
  $this->load->language('customer/order');
 
  $this->document->title = $this->language->get('heading_title');
  
  $this->load->model('customer/order');
       
     if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {  
   $this->model_customer_order->editOrder($this->request->get['order_id'], $this->request->post);
   
   $this->session->data['success'] = $this->language->get('text_success');
     
   $url = '';
    
   if (isset($this->request->get['filter_order_id'])) {
    $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
   }
  
   if (isset($this->request->get['filter_name'])) {
    $url .= '&filter_name=' . $this->request->get['filter_name'];
   }

   if (isset($this->request->get['filter_order_status_id'])) {
    $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
   }

   if (isset($this->request->get['filter_date_added'])) {
    $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
   }

   if (isset($this->request->get['filter_total'])) {
    $url .= '&filter_total=' . $this->request->get['filter_total'];
   }
              
   if (isset($this->request->get['page'])) {
    $url .= '&page=' . $this->request->get['page'];
   }

   if (isset($this->request->get['sort'])) {
    $url .= '&sort=' . $this->request->get['sort'];
   }

   if (isset($this->request->get['order'])) {
    $url .= '&order=' . $this->request->get['order'];
   }
   
   $this->redirect($this->url->https('customer/order' . $url));
     }
    
     $this->getForm();
   }
   
   public function delete() {
  $this->load->language('customer/order');
 
  $this->document->title = $this->language->get('heading_title');
  
  $this->load->model('customer/order');
   
     if (isset($this->request->post['selected']) && ($this->validate())) {
   foreach ($this->request->post['selected'] as $order_id) {
    $this->model_customer_order->deleteOrder($order_id);
   } 
      
   $this->session->data['success'] = $this->language->get('text_success');
     
   $url = '';
    
   if (isset($this->request->get['filter_order_id'])) {
    $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
   }
  
   if (isset($this->request->get['filter_name'])) {
    $url .= '&filter_name=' . $this->request->get['filter_name'];
   }

   if (isset($this->request->get['filter_order_status_id'])) {
    $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
   }

   if (isset($this->request->get['filter_date_added'])) {
    $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
   }

   if (isset($this->request->get['filter_total'])) {
    $url .= '&filter_total=' . $this->request->get['filter_total'];
   }
              
   if (isset($this->request->get['page'])) {
    $url .= '&page=' . $this->request->get['page'];
   }

   if (isset($this->request->get['sort'])) {
    $url .= '&sort=' . $this->request->get['sort'];
   }

   if (isset($this->request->get['order'])) {
    $url .= '&order=' . $this->request->get['order'];
   }
   
   $this->redirect($this->url->https('customer/order' . $url));
     }
    
     $this->getList();
   }
  
   private function getList() {
  if (isset($this->request->get['page'])) {
   $page = $this->request->get['page'];
  } else {
   $page = 1;
  }
  
  if (isset($this->request->get['sort'])) {
   $sort = $this->request->get['sort'];
  } else {
   $sort = 'o.order_id';
  }
  
  if (isset($this->request->get['order'])) {
   $order = $this->request->get['order'];
  } else {
   $order = 'DESC';
  }
  
  if (isset($this->request->get['filter_order_id'])) {
   $filter_order_id = $this->request->get['filter_order_id'];
  } else {
   $filter_order_id = NULL;
  }  
  
  if (isset($this->request->get['filter_name'])) {
   $filter_name = $this->request->get['filter_name'];
  } else {
   $filter_name = NULL;
  }

  if (isset($this->request->get['filter_order_status_id'])) {
   $filter_order_status_id = $this->request->get['filter_order_status_id'];
  } else {
   $filter_order_status_id = NULL;
  }

  if (isset($this->request->get['filter_date_added'])) {
   $filter_date_added = $this->request->get['filter_date_added'];
  } else {
   $filter_date_added = NULL;
  }

  if (isset($this->request->get['filter_total'])) {
   $filter_total = $this->request->get['filter_total'];
  } else {
   $filter_total = NULL;
  }  
  
  $url = '';
    
  if (isset($this->request->get['filter_order_id'])) {
   $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
  }
  
  if (isset($this->request->get['filter_name'])) {
   $url .= '&filter_name=' . $this->request->get['filter_name'];
  }

  if (isset($this->request->get['filter_order_status_id'])) {
   $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
  }

  if (isset($this->request->get['filter_date_added'])) {
   $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
  }

  if (isset($this->request->get['filter_total'])) {
   $url .= '&filter_total=' . $this->request->get['filter_total'];
  }
        
  if (isset($this->request->get['page'])) {
   $url .= '&page=' . $this->request->get['page'];
  }

  if (isset($this->request->get['sort'])) {
   $url .= '&sort=' . $this->request->get['sort'];
  }

  if (isset($this->request->get['order'])) {
   $url .= '&order=' . $this->request->get['order'];
  }

    $this->document->breadcrumbs = array();

     $this->document->breadcrumbs[] = array(
         'href'      => $this->url->https('common/home'),
         'text'      => $this->language->get('text_home'),
        'separator' => FALSE
     );

     $this->document->breadcrumbs[] = array(
         'href'      => $this->url->https('customer/order' . $url),
         'text'      => $this->language->get('heading_title'),
        'separator' => ' :: '
     );
  
  $this->data['invoice'] = $this->url->https('customer/order/invoices'); 
  $this->data['delete'] = $this->url->https('customer/order/delete' . $url); 

  $this->data['orders'] = array();

  $data = array(
   'filter_order_id'        => $filter_order_id,
   'filter_name'          => $filter_name, 
   'filter_order_status_id' => $filter_order_status_id, 
   'filter_date_added'      => $filter_date_added,
   'filter_total'           => $filter_total,
   'sort'                   => $sort,
   'order'                  => $order,
   'start'                  => ($page - 1) * 10,
   'limit'                  => 10
  );
  
  $order_total = $this->model_customer_order->getTotalOrders($data);

  $results = $this->model_customer_order->getOrders($data);
 
     foreach ($results as $result) {
   $action = array();
   
   $action[] = array(
    'text' => $this->language->get('text_edit'),
    'href' => $this->url->https('customer/order/update&order_id=' . $result['order_id'] . $url)
   );
            
   $this->data['orders'][] = array(
    'order_id'   => $result['order_id'],
    'name'       => html_entity_decode(str_replace('&amp;amp;', '&amp;', $result['name']), ENT_QUOTES, 'UTF-8'),
    'status'     => $result['status'],
    'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
    'total'      => $this->currency->format($result['total'], $result['currency'], $result['value']),
    'selected'   => isset($this->request->post['selected']) && in_array($result['order_id'], $this->request->post['selected']),
    'action'     => $action
   );
  } 
     
  $this->data['heading_title'] = $this->language->get('heading_title');

  $this->data['text_no_results'] = $this->language->get('text_no_results');
  $this->data['text_missing_orders'] = $this->language->get('text_missing_orders');

  $this->data['column_order'] = $this->language->get('column_order');
     $this->data['column_name'] = $this->language->get('column_name');
  $this->data['column_status'] = $this->language->get('column_status');
  $this->data['column_date_added'] = $this->language->get('column_date_added');
  $this->data['column_total'] = $this->language->get('column_total');
  $this->data['column_action'] = $this->language->get('column_action');  
  
  $this->data['button_filter'] = $this->language->get('button_filter');
  $this->data['button_invoices'] = $this->language->get('button_invoices');
  $this->data['button_delete'] = $this->language->get('button_delete');

   if (isset($this->error['warning'])) {
   $this->data['error_warning'] = $this->error['warning'];
  } else {
   $this->data['error_warning'] = '';
  }
  
  if (isset($this->session->data['success'])) {
   $this->data['success'] = $this->session->data['success'];
  
   unset($this->session->data['success']);
  } else {
   $this->data['success'] = '';
  }

  $url = '';

  if (isset($this->request->get['filter_order_id'])) {
   $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
  }
  
  if (isset($this->request->get['filter_name'])) {
   $url .= '&filter_name=' . $this->request->get['filter_name'];
  }

  if (isset($this->request->get['filter_order_status_id'])) {
   $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
  }

  if (isset($this->request->get['filter_date_added'])) {
   $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
  }

  if (isset($this->request->get['filter_total'])) {
   $url .= '&filter_total=' . $this->request->get['filter_total'];
  }
  
  if ($order == 'ASC') {
   $url .= '&order=' .  'DESC';
  } else {
   $url .= '&order=' .  'ASC';
  }

  if (isset($this->request->get['page'])) {
   $url .= '&page=' . $this->request->get['page'];
  }
  
  $this->data['sort_order'] = $this->url->https('customer/order&sort=o.order_id' . $url);
  $this->data['sort_name'] = $this->url->https('customer/order&sort=name' . $url);
  $this->data['sort_status'] = $this->url->https('customer/order&sort=status' . $url);
  $this->data['sort_date_added'] = $this->url->https('customer/order&sort=o.date_added' . $url);
  $this->data['sort_total'] = $this->url->https('customer/order&sort=o.total' . $url);
  
  $url = '';

  if (isset($this->request->get['filter_order_id'])) {
   $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
  }
  
  if (isset($this->request->get['filter_name'])) {
   $url .= '&filter_name=' . $this->request->get['filter_name'];
  }

  if (isset($this->request->get['filter_order_status_id'])) {
   $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
  }

  if (isset($this->request->get['filter_date_added'])) {
   $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
  }

  if (isset($this->request->get['filter_total'])) {
   $url .= '&filter_total=' . $this->request->get['filter_total'];
  }
  
  if (isset($this->request->get['sort'])) {
   $url .= '&sort=' . $this->request->get['sort'];
  }
            
  if (isset($this->request->get['order'])) {
   $url .= '&order=' . $this->request->get['order'];
  }

  $pagination = new Pagination();
  $pagination->total = $order_total;
  $pagination->page = $page;
  $pagination->limit = 10; 
  $pagination->text = $this->language->get('text_pagination');
  $pagination->url = $this->url->https('customer/order' . $url . '&page=%s');
   
  $this->data['pagination'] = $pagination->render();
  
  $this->data['filter_order_id'] = $filter_order_id;
  $this->data['filter_name'] = $filter_name;
  $this->data['filter_order_status_id'] = $filter_order_status_id;
  $this->data['filter_date_added'] = $filter_date_added;
  $this->data['filter_total'] = $filter_total;
  
  $this->load->model('localisation/order_status');
  
     $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
    
  $this->data['sort'] = $sort;
  $this->data['order'] = $order;
  
  $this->template = 'customer/order_list.tpl';
  $this->children = array(
   'common/header', 
   'common/footer' 
  );
  
  $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
   }
  
 private function getForm() {
  $this->data['heading_title'] = $this->language->get('heading_title');
  
  $this->data['text_order_details'] = $this->language->get('text_order_details');
  $this->data['text_contact_details'] = $this->language->get('text_contact_details');
  $this->data['text_address_details'] = $this->language->get('text_address_details');
  $this->data['text_products'] = $this->language->get('text_products');
  $this->data['text_downloads'] = $this->language->get('text_downloads');
  $this->data['text_order_history'] = $this->language->get('text_order_history');
  $this->data['text_update'] = $this->language->get('text_update');
  $this->data['text_order'] = $this->language->get('text_order');
  $this->data['text_date_added'] = $this->language->get('text_date_added');
  $this->data['text_email'] = $this->language->get('text_email');
  $this->data['text_telephone'] = $this->language->get('text_telephone');
  $this->data['text_fax'] = $this->language->get('text_fax');
  $this->data['text_shipping_address'] = $this->language->get('text_shipping_address');
  $this->data['text_shipping_method'] = $this->language->get('text_shipping_method');
  $this->data['text_payment_address'] = $this->language->get('text_payment_address');
  $this->data['text_payment_method'] = $this->language->get('text_payment_method');
  $this->data['text_order_comment'] = $this->language->get('text_order_comment');
  $this->data['text_comment'] = $this->language->get('text_comment');
  $this->data['text_status'] = $this->language->get('text_status');
  $this->data['text_notify'] = $this->language->get('text_notify');
  $this->data['text_close'] = $this->language->get('text_close');
  // 100218 ALNAUA New building mechanism in order, mail and invoice Begin
  $this->data['text_sborka'] = $this->language->get('text_sborka');
  // 100218 ALNAUA New building mechanism in order, mail and invoice End
  // 20120204 ALNAUA ET-111227 Begin
  $this->data['text_credit'] = $this->language->get('text_credit');
  // 20120204 ALNAUA ET-111227 End
        
  $this->data['column_product'] = $this->language->get('column_product');
  $this->data['column_model'] = $this->language->get('column_model');
  $this->data['column_quantity'] = $this->language->get('column_quantity');
  $this->data['column_price'] = $this->language->get('column_price');
  $this->data['column_total'] = $this->language->get('column_total');
  $this->data['column_download'] = $this->language->get('column_download');
  $this->data['column_filename'] = $this->language->get('column_filename');
  $this->data['column_remaining'] = $this->language->get('column_remaining');

  $this->data['entry_status'] = $this->language->get('entry_status');
  $this->data['entry_comment'] = $this->language->get('entry_comment');
  $this->data['entry_notify'] = $this->language->get('entry_notify');

  $this->data['button_save'] = $this->language->get('button_save');
  $this->data['button_cancel'] = $this->language->get('button_cancel');
  $this->data['button_back'] = $this->language->get('button_back');
  $this->data['button_invoice'] = $this->language->get('button_invoice');
  // 100426 Prepayment Invoice Begin
  $this->data['button_prepayment_invoice'] = $this->language->get('button_prepayment_invoice');
  // 100426 Prepayment Invoice End

   if (isset($this->error['warning'])) {
   $this->data['error_warning'] = $this->error['warning'];
  } else {
   $this->data['error_warning'] = '';
  }

  $url = '';

  if (isset($this->request->get['filter_order_id'])) {
   $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
  }
  
  if (isset($this->request->get['filter_name'])) {
   $url .= '&filter_name=' . $this->request->get['filter_name'];
  }

  if (isset($this->request->get['filter_order_status_id'])) {
   $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
  }

  if (isset($this->request->get['filter_date_added'])) {
   $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
  }

  if (isset($this->request->get['filter_total'])) {
   $url .= '&filter_total=' . $this->request->get['filter_total'];
  }
     
  if (isset($this->request->get['page'])) {
   $url .= '&page=' . $this->request->get['page'];
  }

  if (isset($this->request->get['sort'])) {
   $url .= '&sort=' . $this->request->get['sort'];
  }

  if (isset($this->request->get['order'])) {
   $url .= '&order=' . $this->request->get['order'];
  }
  
    $this->document->breadcrumbs = array();

     $this->document->breadcrumbs[] = array(
         'href'      => $this->url->https('common/home'),
         'text'      => $this->language->get('text_home'),
        'separator' => FALSE
     );

     $this->document->breadcrumbs[] = array(
         'href'      => $this->url->https('customer/order'),
         'text'      => $this->language->get('heading_title'),
        'separator' => ' :: '
     );
  
  if (isset($this->request->get['order_id'])) {
   $order_id = $this->request->get['order_id'];
  } else {
   $order_id = 0;
  }
  
  $order_info = $this->model_customer_order->getOrder($order_id);
  
  if ($order_info) {
   $this->data['action'] = $this->url->https('customer/order/update&order_id=' . (int)$this->request->get['order_id'] . $url);
   $this->data['cancel'] = $this->url->https('customer/order' . $url);
   $this->data['invoice'] = $this->url->https('customer/order/newinvoice&order_id=' . (int)$this->request->get['order_id']);
   $this->data['invoices'] = $this->url->https('customer/orders/index&order_id=' . (int)$this->request->get['order_id']);
   // 100426 Prepayment Invoice Begin
   $this->data['prepayment_invoice'] = $this->url->https('customer/order/newprepaymentinvoice&order_id=' . (int)$this->request->get['order_id']);
   $this->data['prepayment_nds_invoice'] = $this->url->https('customer/orders/newprepaymentinvoices&order_id='. (int)$this->request->get['order_id']);
   // 100426 Prepayment Invoice End
   
   $this->data['order_id'] = $order_info['order_id'];
   $this->data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added'])); 
   $this->data['email'] = $order_info['email'];
   $this->data['telephone'] = $order_info['telephone'];
   $this->data['fax'] = $order_info['fax'];
   $this->data['order_comment'] = nl2br($order_info['comment']);
   // 20120204 ALNAUA ET-111227 Begin
   if ($order_info['credit_id'] > 0) {
    $this->load->model('catalog/credit');
    $credit_info = $this->model_catalog_credit->getCreditWithDesc($order_info['credit_id']);
    $this->data['credit_name'] = $credit_info['name'];
   } else {
    $this->data['credit_name'] = '';
   }
   $this->data['credit_id'] = $order_info['credit_id'];
   // 20120204 ALNAUA ET-111227 End
 
   if ($order_info['shipping_address_format']) {
    $format = $order_info['shipping_address_format'];
   } else {
    $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
   }
   
   $find = array(
    '{firstname}',
    '{lastname}',
    '{company}',
    '{address_1}',
    '{address_2}',
    '{city}',
    '{postcode}',
    '{zone}',
    '{country}'
   );
  
   $replace = array(
    'firstname' => $order_info['shipping_firstname'],
    'lastname'  => $order_info['shipping_lastname'],
    'company'   => $order_info['shipping_company'],
    'address_1' => $order_info['shipping_address_1'],
    'address_2' => $order_info['shipping_address_2'],
    'city'      => $order_info['shipping_city'],
    'postcode'  => $order_info['shipping_postcode'],
    'zone'      => $order_info['shipping_zone'],
    'country'   => $order_info['shipping_country']  
   );
  
   $this->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
   
   $this->data['shipping_method'] = $order_info['shipping_method'];
 
   if ($order_info['payment_address_format']) {
    $format = $order_info['payment_address_format'];
   } else {
    $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
   }
   
   $find = array(
    '{firstname}',
    '{lastname}',
    '{company}',
    '{address_1}',
    '{address_2}',
    '{city}',
    '{postcode}',
    '{zone}',
    '{country}'
   );
  
   $replace = array(
    'firstname' => $order_info['payment_firstname'],
    'lastname'  => $order_info['payment_lastname'],
    'company'   => $order_info['payment_company'],
    'address_1' => $order_info['payment_address_1'],
    'address_2' => $order_info['payment_address_2'],
    'city'      => $order_info['payment_city'],
    'postcode'  => $order_info['payment_postcode'],
    'zone'      => $order_info['payment_zone'],
    'country'   => $order_info['payment_country']  
   );
  
   $this->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
 
   $this->data['payment_method'] = $order_info['payment_method'];
   
   $this->data['products'] = array();

            // (+) ALNAUA 091114 (START)
            $this->load->model('catalog/color');
            // (+) ALNAUA 091114 (FINISH)
   
   $products = $this->model_customer_order->getOrderProducts($this->request->get['order_id']);
 
   foreach ($products as $product) {
    $option_data = array();
    
    $options = $this->model_customer_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);
 
    foreach ($options as $option) {
     $option_data[] = array(
      'name'  => $option['name'],
      'value' => $option['value']
     );
    }

                // (+) ALNAUA 091114 (START)
                // 100223 ALNAUA Site redesign Begin
                // for capability older orders
                if ($this->request->get['order_id'] < 207) {
                // 100223 ALNAUA Site redesign End
                  $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
                  $option_data[] = array(
                          'name'  => $this->language->get('text_color'),
                          'value' => $color['name'],
                      );
                // 100223 ALNAUA Site redesign Begin
                }
                // 100223 ALNAUA Site redesign End
                // (+) ALNAUA 091114 (FINISH)
     
    $this->data['products'][] = array(
     'name'     => $product['name'],
     'model'    => $product['model'],
     'nds'      => $product['nds'],
     'option'   => $option_data,
     'quantity' => $product['quantity'],
     'price'    => $this->currency->format($product['price'], $order_info['currency'], $order_info['value']),
     'total'    => $this->currency->format($product['total'], $order_info['currency'], $order_info['value']),
    // 100218 ALNAUA New building mechanism in order, mail and invoice Begin
     'sborka' => $product['sborka'],
     'sborka_qty' => round($product['quantity'], 4),
     'sborka_cost' => $this->currency->format($product['sborka_cost'], $order_info['currency'], $order_info['value']),
     'sborka_cost_total' => $this->currency->format($product['quantity']*$product['sborka_cost'], $order_info['currency'], $order_info['value'])
    // 100218 ALNAUA New building mechanism in order, mail and invoice End
    );
   }
 
   $this->data['totals'] = $this->model_customer_order->getOrderTotals($this->request->get['order_id']);
 
   $this->data['historys'] = array();
 
   $results = $this->model_customer_order->getOrderHistory($this->request->get['order_id']);
 
   foreach ($results as $result) {
    $this->data['historys'][] = array(
     'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
     'status'     => $result['status'],
     'comment'    => nl2br($result['comment']),
     'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no')
    );
   }
   
   $this->data['downloads'] = array();
   
   $results = $this->model_customer_order->getOrderDownloads($this->request->get['order_id']);
 
   foreach ($results as $result) {
    $this->data['downloads'][] = array(
     'name'      => $result['name'],
     'filename'  => $result['mask'],
     'remaining' => $result['remaining']
    );
   }
 
   $this->load->model('localisation/order_status');
   
   $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
   
   if (isset($this->request->post['order_status_id'])) {
    $this->data['order_status_id'] = $this->request->post['order_status_id'];
   } elseif (isset($order_info['order_status_id'])) {
    $this->data['order_status_id'] = $order_info['order_status_id'];
   } else {
    $this->data['order_status_id'] = 0;
   }
   
   if (isset($this->request->post['comment'])) {
    $this->data['comment'] = $this->request->post['comment'];
   } else {
    $this->data['comment'] = '';
   }
   
   if (isset($this->request->post['notify'])) {
    $this->data['notify'] = $this->request->post['notify'];
   } else {
    $this->data['notify'] = '';
   }
  
   $this->template = 'customer/order_form.tpl';
   $this->children = array(
    'common/header', 
    'common/footer'
   );
   
   $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression')); 
  } 
   }
 
 public function invoice() {
  $this->load->language('customer/order');

  $this->data['title'] = $this->language->get('heading_title_invoice') . ' #' . $this->request->get['order_id'];
  
  if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
   $this->data['base'] = HTTPS_SERVER;
  } else {
   $this->data['base'] = HTTP_SERVER;
  }
  
  $this->data['direction'] = $this->language->get('direction');
  $this->data['language'] = $this->language->get('code'); 
  
  $this->data['text_invoice'] = $this->language->get('text_invoice');
     $this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
  $this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
  $this->data['text_telephone'] = $this->language->get('text_telephone');
  $this->data['text_fax'] = $this->language->get('text_fax');  
  $this->data['text_to'] = $this->language->get('text_to');
  $this->data['text_ship_to'] = $this->language->get('text_ship_to');
      
  $this->data['column_product'] = $this->language->get('column_product');
     $this->data['column_model'] = $this->language->get('column_model');
     $this->data['column_quantity'] = $this->language->get('column_quantity');
     $this->data['column_price'] = $this->language->get('column_price');
     $this->data['column_total'] = $this->language->get('column_total');
    
  $this->load->model('customer/order');
  
     $order_info = $this->model_customer_order->getOrder($this->request->get['order_id']);
  
  $this->data['order_id'] = $order_info['order_id'];
  $this->data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));     

  $this->data['store'] = $this->config->get('config_store');
  $this->data['address'] = nl2br($this->config->get('config_address'));
  $this->data['telephone'] = $this->config->get('config_telephone');
  $this->data['fax'] = $this->config->get('config_fax');
  $this->data['email'] = $this->config->get('config_email');
  $this->data['website'] = trim(HTTP_CATALOG, '/');

  if ($order_info['shipping_address_format']) {
        $format = $order_info['shipping_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }
  
     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );
 
  $replace = array(
     'firstname' => $order_info['shipping_firstname'],
     'lastname'  => $order_info['shipping_lastname'],
     'company'   => $order_info['shipping_company'],
        'address_1' => $order_info['shipping_address_1'],
        'address_2' => $order_info['shipping_address_2'],
        'city'      => $order_info['shipping_city'],
        'postcode'  => $order_info['shipping_postcode'],
        'zone'      => $order_info['shipping_zone'],
        'country'   => $order_info['shipping_country']  
  );
 
  $this->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
  
  if ($order_info['payment_address_format']) {
        $format = $order_info['payment_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }
  
     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );
 
  $replace = array(
     'firstname' => $order_info['payment_firstname'],
     'lastname'  => $order_info['payment_lastname'],
     'company'   => $order_info['payment_company'],
        'address_1' => $order_info['payment_address_1'],
        'address_2' => $order_info['payment_address_2'],
        'city'      => $order_info['payment_city'],
        'postcode'  => $order_info['payment_postcode'],
        'zone'      => $order_info['payment_zone'],
        'country'   => $order_info['payment_country']  
  );
 
  $this->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
  
  $this->data['products'] = array();

        // (+) ALNAUA 091114 (START)
        $this->load->model('catalog/color');
        // (+) ALNAUA 091114 (FINISH)
     
  $products = $this->model_customer_order->getOrderProducts($this->request->get['order_id']);

     foreach ($products as $product) {
   $option_data = array();
   
   $options = $this->model_customer_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

        foreach ($options as $option) {
          $option_data[] = array(
             'name'  => $option['name'],
             'value' => $option['value']
          );
        }

            // (+) ALNAUA 091114 (START)
            $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
            $option_data[] = array(
                    'name'  => $this->language->get('text_color'),
                    'value' => $color['name'],
                );
            // (+) ALNAUA 091114 (FINISH)
         
         $this->data['products'][] = array(
            'name'     => $product['name'],
            'model'    => $product['model'],
            'option'   => $option_data,
            'quantity' => $product['quantity'],
            'price'    => $this->currency->format($product['price'], $order_info['currency'], $order_info['value']),
            'total'    => $this->currency->format($product['total'], $order_info['currency'], $order_info['value'])
         );
     }

     $this->data['totals'] = $this->model_customer_order->getOrderTotals($this->request->get['order_id']);
  
  $this->template = 'customer/order_invoice.tpl';
  
   $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));   
 }
 
   public function invoices() {
  $this->load->language('customer/order');
  
  $this->data['title'] = $this->language->get('heading_title_invoices');
   
  if (isset($this->request->server['HTTPS']) && ($this->request->server['HTTPS'] == 'on')) {
   $this->data['base'] = HTTPS_SERVER;
  } else {
   $this->data['base'] = HTTP_SERVER;
  }
  
  $this->data['direction'] = $this->language->get('direction');
  $this->data['language'] = $this->language->get('code'); 
  
  $this->load->language('customer/order');
  
  $this->data['text_invoice'] = $this->language->get('text_invoice');
  $this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
  $this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
  $this->data['text_telephone'] = $this->language->get('text_telephone');
  $this->data['text_fax'] = $this->language->get('text_fax');  
  $this->data['text_to'] = $this->language->get('text_to');
  $this->data['text_ship_to'] = $this->language->get('text_ship_to');
  
  $this->data['column_product'] = $this->language->get('column_product');
  $this->data['column_model'] = $this->language->get('column_model');
  $this->data['column_quantity'] = $this->language->get('column_quantity');
  $this->data['column_price'] = $this->language->get('column_price');
  $this->data['column_total'] = $this->language->get('column_total'); 

  $this->load->model('customer/order');
 
  $this->data['orders'] = array();
  
  if (isset($this->request->post['selected'])) {
   $orders = $this->request->post['selected'];
  } else {
   $orders = array();
  }
  
  foreach ($orders as $order_id) {
   $order_info = $this->model_customer_order->getOrder($order_id);
   
   if ($order_info) {
    if ($order_info['shipping_address_format']) {
     $format = $order_info['shipping_address_format'];
    } else {
     $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
    }
    
    $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
     '{address_1}',
     '{address_2}',
     '{city}',
     '{postcode}',
     '{zone}',
     '{country}'
    );
   
    $replace = array(
     'firstname' => $order_info['shipping_firstname'],
     'lastname'  => $order_info['shipping_lastname'],
     'company'   => $order_info['shipping_company'],
     'address_1' => $order_info['shipping_address_1'],
     'address_2' => $order_info['shipping_address_2'],
     'city'      => $order_info['shipping_city'],
     'postcode'  => $order_info['shipping_postcode'],
     'zone'      => $order_info['shipping_zone'],
     'country'   => $order_info['shipping_country']  
    );
   
    $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
    
    if ($order_info['payment_address_format']) {
     $format = $order_info['payment_address_format'];
    } else {
     $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
    }
    
    $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
     '{address_1}',
     '{address_2}',
     '{city}',
     '{postcode}',
     '{zone}',
     '{country}'
    );
   
    $replace = array(
     'firstname' => $order_info['payment_firstname'],
     'lastname'  => $order_info['payment_lastname'],
     'company'   => $order_info['payment_company'],
     'address_1' => $order_info['payment_address_1'],
     'address_2' => $order_info['payment_address_2'],
     'city'      => $order_info['payment_city'],
     'postcode'  => $order_info['payment_postcode'],
     'zone'      => $order_info['payment_zone'],
     'country'   => $order_info['payment_country']  
    );
   
    $payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
    
    $product_data = array();

                // (+) ALNAUA 091114 (START)
                $this->load->model('catalog/color');
                // (+) ALNAUA 091114 (FINISH)
    
    $products = $this->model_customer_order->getOrderProducts($order_id);
  
    foreach ($products as $product) {
     $option_data = array();
     
     $options = $this->model_customer_order->getOrderOptions($order_id, $product['order_product_id']);
  
     foreach ($options as $option) {
      $option_data[] = array(
       'name'  => $option['name'],
       'value' => $option['value']
      );
     }

                    // (+) ALNAUA 091114 (START)
                    $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
                    $option_data[] = array(
                            'name'  => $this->language->get('text_color'),
                            'value' => $color['name'],
                        );
                    // (+) ALNAUA 091114 (FINISH)
      
     $product_data[] = array(
      'name'     => $product['name'],
      'model'    => $product['model'],
      'option'   => $option_data,
      'quantity' => $product['quantity'],
      'price'    => $this->currency->format($product['price'], $order_info['currency'], $order_info['value']),
      'total'    => $this->currency->format($product['total'], $order_info['currency'], $order_info['value'])
     );
    }      
    
    $total_data = $this->model_customer_order->getOrderTotals($order_id);
    
    $this->data['orders'][] = array(
     'order_id'        => $order_info['order_id'],
     'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
     'store'            => $this->config->get('config_store'),
     'address'          => nl2br($this->config->get('config_address')),
     'telephone'        => $this->config->get('config_telephone'),
     'fax'              => $this->config->get('config_fax'),
     'email'            => $this->config->get('config_email'),
     'website'          => trim(HTTP_CATALOG, '/'),
     'shipping_address' => $shipping_address,
     'payment_address'  => $payment_address,
     'product'          => $product_data,
     'total'            => $total_data
    );
   }
  }
  
  $this->template = 'customer/order_invoices.tpl';
   
  $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
 }

    // (+) ALNAUA 091114 (START)
    public function newinvoice() {
  $this->load->language('customer/order');

  $this->data['title'] = $this->language->get('heading_title_invoice') . ' #' . sprintf("Т%06s", $this->request->get['order_id']);

  if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
   $this->data['base'] = HTTPS_SERVER;
  } else {
   $this->data['base'] = HTTP_SERVER;
  }

  $this->data['direction'] = $this->language->get('direction');
  $this->data['language'] = $this->language->get('code');

  $this->data['text_invoice'] = $this->language->get('text_invoice');
//     $this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
//  $this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
//  $this->data['text_telephone'] = $this->language->get('text_telephone');
//  $this->data['text_fax'] = $this->language->get('text_fax');
//  $this->data['text_to'] = $this->language->get('text_to');
//  $this->data['text_ship_to'] = $this->language->get('text_ship_to');

  $this->data['column_product'] = $this->language->get('column_product');
     $this->data['column_model'] = $this->language->get('column_model');
     $this->data['column_quantity'] = $this->language->get('column_quantity');
     $this->data['column_price'] = $this->language->get('column_price');
        
     $this->data['column_total'] = $this->language->get('column_total');

        $this->data['text_supplier'] = $this->language->get('text_supplier');
        $this->data['text_customer'] = $this->language->get('text_customer');
        $this->data['text_invoice_new'] = $this->language->get('text_invoice_new');
        $this->data['text_from_date'] = $this->language->get('text_from_date');
        $this->data['text_adv'] = $this->language->get('text_adv');
        $this->data['column_unit_meas'] = $this->language->get('column_unit_meas');
        $this->data['text_unit_meas'] = $this->language->get('text_unit_meas');

        $this->data['text_total_without_tax'] = $this->language->get('text_total_without_tax');
        $this->data['text_total_tax'] = $this->language->get('text_total_tax');
        $this->data['text_total_with_tax'] = $this->language->get('text_total_with_tax');
        // 100218 ALNAUA New building mechanism in order, mail and invoice Begin
        $this->data['text_sborka'] = $this->language->get('text_sborka');
        $this->data['text_sborka_unit_meas'] = $this->language->get('text_sborka_unit_meas');
        // 100218 ALNAUA New building mechanism in order, mail and invoice End

        // ET-20150113 Begin
        $this->data['text_warning_reserve'] = $this->language->get('text_warning_reserve');
        // ET-20150113 End

        //$this->data['supplier_address'] = $this->config->get('config_invoice_data');
        $this->data['supplier_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim($this->config->get('config_invoice_data'))));

  $this->load->model('customer/order');

     $order_info = $this->model_customer_order->getOrder($this->request->get['order_id']);

//  $this->data['order_id'] = $order_info['order_id'];
        $this->data['order_id'] = sprintf("Т%06s",$order_info['order_id']); // zero-padding works on strings too

  $this->data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
        $this->data['column_currency'] = $order_info['currency'];

//  $this->data['store'] = $this->config->get('config_store');
//  $this->data['address'] = nl2br($this->config->get('config_address'));
//  $this->data['telephone'] = $this->config->get('config_telephone');
//  $this->data['fax'] = $this->config->get('config_fax');
//  $this->data['email'] = $this->config->get('config_email');
//  $this->data['website'] = trim(HTTP_CATALOG, '/');

  if ($order_info['shipping_address_format']) {
        $format = $order_info['shipping_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }

     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );

  $replace = array(
     'firstname' => $order_info['shipping_firstname'],
     'lastname'  => $order_info['shipping_lastname'],
     'company'   => $order_info['shipping_company'],
        'address_1' => $order_info['shipping_address_1'],
        'address_2' => $order_info['shipping_address_2'],
        'city'      => $order_info['shipping_city'],
        'postcode'  => $order_info['shipping_postcode'],
        'zone'      => $order_info['shipping_zone'],
        'country'   => $order_info['shipping_country']
  );

  $this->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

  if ($order_info['payment_address_format']) {
        $format = $order_info['payment_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }

     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );

  $replace = array(
     'firstname' => $order_info['payment_firstname'],
     'lastname'  => $order_info['payment_lastname'],
     'company'   => $order_info['payment_company'],
        'address_1' => $order_info['payment_address_1'],
        'address_2' => $order_info['payment_address_2'],
        'city'      => $order_info['payment_city'],
        'postcode'  => $order_info['payment_postcode'],
        'zone'      => $order_info['payment_zone'],
        'country'   => $order_info['payment_country']
  );

  $this->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

  $this->data['products'] = array();

        // (+) ALNAUA 091114 (START)
        $this->load->model('catalog/color');
        // (+) ALNAUA 091114 (FINISH)

  $products = $this->model_customer_order->getOrderProducts($this->request->get['order_id']);

     foreach ($products as $product) {
   $option_data = array();

   $options = $this->model_customer_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

        foreach ($options as $option) {
          $option_data[] = array(
             'name'  => $option['name'],
             'value' => $option['value']
          );
        }
        $this->load->model('catalog/product');
        $paras = $this->model_catalog_product->getProduct($product['product_id']);
        $nine = $paras['nds'];

            // (+) ALNAUA 091114 (START)
            // 100223 ALNAUA Site redesign Begin
            // for capability older orders
            if ($this->request->get['order_id'] < 207) {
            // 100223 ALNAUA Site redesign End
              $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
              $option_data[] = array(
                      'name'  => $this->language->get('text_color'),
                      'value' => $color['name'],
                  );
            // 100223 ALNAUA Site redesign Begin
            }
            // 100223 ALNAUA Site redesign End
            // (+) ALNAUA 091114 (FINISH)
        if ($nine['nds']  == 0) {
         $this->data['products'][] = array(
            'name'     => $product['name'],
            'model'    => $product['model'],
            'option'   => $option_data,
            'quantity' => number_format(round($product['quantity'], 4), 4, '.', ''),
            'price'    => $this->currency->format($product['price'], $order_info['currency'], $order_info['value'], false),
            'total'    => $this->currency->format($product['total'], $order_info['currency'], $order_info['value'], false),
                // 100218 ALNAUA New building mechanism in order, mail and invoice Begin
            'sborka' => $product['sborka'],
            'sborka_qty' => number_format(round($product['quantity']*$product['sborka_cost']/$this->config->get('config_sborka_cost_per_hour'), 4), 4, '.', ''),
            'sborka_cost' => $this->currency->format($this->config->get('config_sborka_cost_per_hour')/1.2, $order_info['currency'], $order_info['value'], false),
            'sborka_cost_total' => $this->currency->format($product['quantity']*$product['sborka_cost']/1.2, $order_info['currency'], $order_info['value'], false)
                // 100218 ALNAUA New building mechanism in order, mail and invoice End
         );
        }
     }

     $this->data['totals'] = $this->model_customer_order->getOrderTotals($this->request->get['order_id']);

  $this->template = 'customer/new_order_invoice.tpl';

   $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
 }

//   public function newinvoices() {
//  $this->load->language('customer/order');
//
//  $this->data['title'] = $this->language->get('heading_title_invoices');
//
//  if (isset($this->request->server['HTTPS']) && ($this->request->server['HTTPS'] == 'on')) {
//   $this->data['base'] = HTTPS_SERVER;
//  } else {
//   $this->data['base'] = HTTP_SERVER;
//  }
//
//  $this->data['direction'] = $this->language->get('direction');
//  $this->data['language'] = $this->language->get('code');
//
//  $this->load->language('customer/order');
//
//  $this->data['text_invoice'] = $this->language->get('text_invoice');
//  $this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
//  $this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
//  $this->data['text_telephone'] = $this->language->get('text_telephone');
//  $this->data['text_fax'] = $this->language->get('text_fax');
//  $this->data['text_to'] = $this->language->get('text_to');
//  $this->data['text_ship_to'] = $this->language->get('text_ship_to');
//
//  $this->data['column_product'] = $this->language->get('column_product');
//  $this->data['column_model'] = $this->language->get('column_model');
//  $this->data['column_quantity'] = $this->language->get('column_quantity');
//  $this->data['column_price'] = $this->language->get('column_price');
//  $this->data['column_total'] = $this->language->get('column_total');
//
//  $this->load->model('customer/order');
//
//  $this->data['orders'] = array();
//
//  if (isset($this->request->post['selected'])) {
//   $orders = $this->request->post['selected'];
//  } else {
//   $orders = array();
//  }
//
//  foreach ($orders as $order_id) {
//   $order_info = $this->model_customer_order->getOrder($order_id);
//
//   if ($order_info) {
//    if ($order_info['shipping_address_format']) {
//     $format = $order_info['shipping_address_format'];
//    } else {
//     $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
//    }
//
//    $find = array(
//     '{firstname}',
//     '{lastname}',
//     '{company}',
//     '{address_1}',
//     '{address_2}',
//     '{city}',
//     '{postcode}',
//     '{zone}',
//     '{country}'
//    );
//
//    $replace = array(
//     'firstname' => $order_info['shipping_firstname'],
//     'lastname'  => $order_info['shipping_lastname'],
//     'company'   => $order_info['shipping_company'],
//     'address_1' => $order_info['shipping_address_1'],
//     'address_2' => $order_info['shipping_address_2'],
//     'city'      => $order_info['shipping_city'],
//     'postcode'  => $order_info['shipping_postcode'],
//     'zone'      => $order_info['shipping_zone'],
//     'country'   => $order_info['shipping_country']
//    );
//
//    $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
//
//    if ($order_info['payment_address_format']) {
//     $format = $order_info['payment_address_format'];
//    } else {
//     $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
//    }
//
//    $find = array(
//     '{firstname}',
//     '{lastname}',
//     '{company}',
//     '{address_1}',
//     '{address_2}',
//     '{city}',
//     '{postcode}',
//     '{zone}',
//     '{country}'
//    );
//
//    $replace = array(
//     'firstname' => $order_info['payment_firstname'],
//     'lastname'  => $order_info['payment_lastname'],
//     'company'   => $order_info['payment_company'],
//     'address_1' => $order_info['payment_address_1'],
//     'address_2' => $order_info['payment_address_2'],
//     'city'      => $order_info['payment_city'],
//     'postcode'  => $order_info['payment_postcode'],
//     'zone'      => $order_info['payment_zone'],
//     'country'   => $order_info['payment_country']
//    );
//
//    $payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
//
//    $product_data = array();
//
//                // (+) ALNAUA 091114 (START)
//                $this->load->model('catalog/color');
//                // (+) ALNAUA 091114 (FINISH)
//
//    $products = $this->model_customer_order->getOrderProducts($order_id);
//
//    foreach ($products as $product) {
//     $option_data = array();
//
//     $options = $this->model_customer_order->getOrderOptions($order_id, $product['order_product_id']);
//
//     foreach ($options as $option) {
//      $option_data[] = array(
//       'name'  => $option['name'],
//       'value' => $option['value']
//      );
//     }
//
//                    // (+) ALNAUA 091114 (START)
//                    $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
//                    $option_data[] = array(
//                            'name'  => $this->language->get('text_color'),
//                            'value' => $color['name'],
//                        );
//                    // (+) ALNAUA 091114 (FINISH)
//
//     $product_data[] = array(
//      'name'     => $product['name'],
//      'model'    => $product['model'],
//      'option'   => $option_data,
//      'quantity' => $product['quantity'],
//      'price'    => $this->currency->format($product['price'], $order_info['currency'], $order_info['value']),
//      'total'    => $this->currency->format($product['total'], $order_info['currency'], $order_info['value'])
//     );
//    }
//
//    $total_data = $this->model_customer_order->getOrderTotals($order_id);
//
//    $this->data['orders'][] = array(
//     'order_id'        => $order_info['order_id'],
//     'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
//     'store'            => $this->config->get('config_store'),
//     'address'          => nl2br($this->config->get('config_address')),
//     'telephone'        => $this->config->get('config_telephone'),
//     'fax'              => $this->config->get('config_fax'),
//     'email'            => $this->config->get('config_email'),
//     'website'          => trim(HTTP_CATALOG, '/'),
//     'shipping_address' => $shipping_address,
//     'payment_address'  => $payment_address,
//     'product'          => $product_data,
//     'total'            => $total_data
//    );
//   }
//  }
//
//  $this->template = 'customer/order_invoices.tpl';
//
//  $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
// }
    // (+) ALNAUA 091114 (FINISH)

    // 100426 Prepayment Invoice Begin
    public function newprepaymentinvoice() {
  $this->load->language('customer/order');

  $this->data['title'] = $this->language->get('heading_title_invoice') . ' #' . sprintf("Т%06s", $this->request->get['order_id']);

  if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
   $this->data['base'] = HTTPS_SERVER;
  } else {
   $this->data['base'] = HTTP_SERVER;
  }

  $this->data['direction'] = $this->language->get('direction');
  $this->data['language'] = $this->language->get('code');

  $this->data['text_invoice'] = $this->language->get('text_invoice');

  $this->data['column_product'] = $this->language->get('column_product');
     $this->data['column_model'] = $this->language->get('column_model');
     $this->data['column_quantity'] = $this->language->get('column_quantity');
     $this->data['column_price'] = $this->language->get('column_price');

     $this->data['column_total'] = $this->language->get('column_total');

        $this->data['text_supplier'] = $this->language->get('text_supplier');
        $this->data['text_customer'] = $this->language->get('text_customer');
        $this->data['text_invoice_new'] = $this->language->get('text_invoice_new');
        $this->data['text_from_date'] = $this->language->get('text_from_date');
        $this->data['text_adv'] = $this->language->get('text_adv');
        $this->data['column_unit_meas'] = $this->language->get('column_unit_meas');
        $this->data['text_unit_meas'] = $this->language->get('text_unit_meas');

        $this->data['text_total_without_tax'] = $this->language->get('text_total_without_tax');
        $this->data['text_total_tax'] = $this->language->get('text_total_tax');
        $this->data['text_total_with_tax'] = $this->language->get('text_total_with_tax');
        $this->data['text_sborka'] = $this->language->get('text_sborka');
        $this->data['text_sborka_unit_meas'] = $this->language->get('text_sborka_unit_meas');
        $this->data['text_prepayment_50'] = $this->language->get('text_prepayment_50');

        // 100611 ALNAUA Add Discount System Begin
        $this->data['text_total_discount'] = $this->language->get('text_total_discount');
        $this->data['text_total_to_pay'] = $this->language->get('text_total_to_pay');
        // 100611 ALNAUA ALNAUA Add Discount System End

        // ET-20150113 Begin
        $this->data['text_warning_reserve'] = $this->language->get('text_warning_reserve');
        // ET-20150113 End

        $this->data['supplier_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim($this->config->get('config_invoice_data'))));

  $this->load->model('customer/order');

     $order_info = $this->model_customer_order->getOrder($this->request->get['order_id']);

        $this->data['order_id'] = sprintf("Т%06sP",$order_info['order_id']); // zero-padding works on strings too

  $this->data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
        $this->data['column_currency'] = $order_info['currency'];

  if ($order_info['shipping_address_format']) {
        $format = $order_info['shipping_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }

     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );

  $replace = array(
     'firstname' => $order_info['shipping_firstname'],
     'lastname'  => $order_info['shipping_lastname'],
     'company'   => $order_info['shipping_company'],
        'address_1' => $order_info['shipping_address_1'],
        'address_2' => $order_info['shipping_address_2'],
        'city'      => $order_info['shipping_city'],
        'postcode'  => $order_info['shipping_postcode'],
        'zone'      => $order_info['shipping_zone'],
        'country'   => $order_info['shipping_country']
  );

  $this->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

  if ($order_info['payment_address_format']) {
        $format = $order_info['payment_address_format'];
     } else {
   $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
  }

     $find = array(
     '{firstname}',
     '{lastname}',
     '{company}',
        '{address_1}',
        '{address_2}',
       '{city}',
        '{postcode}',
        '{zone}',
        '{country}'
  );

  $replace = array(
     'firstname' => $order_info['payment_firstname'],
     'lastname'  => $order_info['payment_lastname'],
     'company'   => $order_info['payment_company'],
        'address_1' => $order_info['payment_address_1'],
        'address_2' => $order_info['payment_address_2'],
        'city'      => $order_info['payment_city'],
        'postcode'  => $order_info['payment_postcode'],
        'zone'      => $order_info['payment_zone'],
        'country'   => $order_info['payment_country']
  );

  $this->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

  $this->data['products'] = array();

        $this->load->model('catalog/color');

  $products = $this->model_customer_order->getOrderProducts($this->request->get['order_id']);

        $this->load->model('catalog/product');
        $total_without_tax = 0;
        $total_product_prepayment = 0;
        $total_product = 0;

     foreach ($products as $product) {
   $option_data = array();

   $options = $this->model_customer_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

        foreach ($options as $option) {
          $option_data[] = array(
             'name'  => $option['name'],
             'value' => $option['value']
          );
        }

            // for capability older orders
            if ($this->request->get['order_id'] < 207) {
              $color = $this->model_catalog_color->getColorDescCurrLang($product['color_id']);
              $option_data[] = array(
                      'name'  => $this->language->get('text_color'),
                      'value' => $color['name'],
                  );
            }

            // 100708 ALNAUA Add prepayment and use in order discount to product and order product Begin
            //$product_info = $this->model_catalog_product->getProduct($product['product_id']);
            //$product_prepayment = $product_info['prepayment']/100;
            $product_prepayment = $product['prepayment']/100;
            // 100708 ALNAUA Add prepayment and use in order discount to product and order product End
            $product_price = $product['price']*$product_prepayment;
            $product_total = $product['total']*$product_prepayment;

            $sborka_qty = round($product['quantity']*$product['sborka_cost']/$this->config->get('config_sborka_cost_per_hour')*$product_prepayment, 4);
            $sborka_cost = ($this->config->get('config_sborka_cost_per_hour')/1.2);
            $sborka_cost_total = ($product['sborka'] ? $product['quantity']*$product['sborka_cost']/1.2*$product_prepayment : 0.00);
            $search = $this->model_catalog_product->getProduct($product['product_id']);
            $nds = $search['nds'];
            
        if($nds['nds'] == 0) {  
         $this->data['products'][] = array(
            'name'     => $product['name'],
            'model'    => $product['model'],
            'option'   => $option_data,
            'prepayment' => $product_prepayment,
            'quantity' => number_format(round($product['quantity'], 4), 4, '.', ''),
            'price'    => $this->currency->format($product_price, $order_info['currency'], $order_info['value'], false),
            'total'    => $this->currency->format($product_total, $order_info['currency'], $order_info['value'], false),
            'sborka' => $product['sborka'],
            'sborka_qty' => number_format($sborka_qty, 4, '.', ''),
            'sborka_cost' => $this->currency->format($sborka_cost, $order_info['currency'], $order_info['value'], false),
            'sborka_cost_total' => $this->currency->format($sborka_cost_total, $order_info['currency'], $order_info['value'], false)
         );
            
            $total_without_tax = $total_without_tax + $product_total + $sborka_cost_total;
            // 100708 ALNAUA Add prepayment and use in order discount to product and order product Begin
            if ($product['use_in_order_discount']) {
            // 100708 ALNAUA Add prepayment and use in order discount to product and order product End
                $total_product_prepayment = $total_product_prepayment + $product['total']*$product_prepayment;
                $total_product = $total_product + $product['total'];
            // 100708 ALNAUA Add prepayment and use in order discount to product and order product Begin
            }
            // 100708 ALNAUA Add prepayment and use in order discount to product and order product End
        }
     }

        $discount = 0;

        $order_discount = array( array($this->config->get('order_discount_sum1'), $this->config->get('order_discount_percent1')),
                                 array($this->config->get('order_discount_sum2'), $this->config->get('order_discount_percent2')),
                                 array($this->config->get('order_discount_sum3'), $this->config->get('order_discount_percent3')),
                                 array($this->config->get('order_discount_sum4'), $this->config->get('order_discount_percent4')),
                                 array($this->config->get('order_discount_sum5'), $this->config->get('order_discount_percent5'))
                                );

        array_multisort($order_discount, SORT_NUMERIC, $order_discount);

        for ($i = 0; $i < sizeof($order_discount); $i++) {
          if ($total_product > (float)$order_discount[$i][0]) {
            $discount = (float)$order_discount[$i][1];
          }
        }

     //$this->data['totals'] = $this->model_customer_order->getOrderTotals($this->request->get['order_id']);
        
        $this->data['total_without_tax'] = round($total_without_tax, 2);
        $this->data['total_tax'] = round($total_without_tax * 1.2 - $total_without_tax, 2);
        $this->data['total_with_tax'] = round($total_without_tax*1.2, 2);

        $this->data['total_discount'] = round($total_product_prepayment * ($discount/100), 2);
        $this->data['total_to_pay'] = $this->data['total_without_tax'] - $this->data['total_discount'];

  $this->template = 'customer/new_order_prepayment_invoice.tpl';

   $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
 }
    // 100426 Prepayment Invoice End
     
 private function validate() {
     if (!$this->user->hasPermission('modify', 'customer/order')) {
        $this->error['warning'] = $this->language->get('error_permission'); 
     }
 
  if (!$this->error) {
     return TRUE;
  } else {
     return FALSE;
  }
   }
}
?>