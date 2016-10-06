<?php
class ControllerProductManufacturer extends Controller {
	public function index() {
		$this->language->load('product/manufacturer');

		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('tool/seo_url');
		$this->load->helper('image');

		$this->document->breadcrumbs = array();

      	$this->document->breadcrumbs[] = array(
        	'href'      => $this->url->http('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => FALSE
      	);

		if (isset($this->request->get['manufacturer_id'])) {
			$manufacturer_id = $this->request->get['manufacturer_id'];
		} else {
			$manufacturer_id = 0;
		}

		$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

		if ($manufacturer_info) {
      		$this->document->breadcrumbs[] = array(
        		'href'      => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'])),
        		'text'      => $manufacturer_info['name'],
        		'separator' => $this->language->get('text_separator')
      		);

			$this->document->title = $manufacturer_info['name'];

			$this->data['heading_title'] = $manufacturer_info['name'];

			$this->data['text_sort'] = $this->language->get('text_sort');

			$product_total = $this->model_catalog_product->getTotalProductsByManufacturerId($this->request->get['manufacturer_id']);

			if ($product_total) {
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}

				if (isset($this->request->get['sort'])) {
					$sort = $this->request->get['sort'];
				} else {
					$sort = 'pd.name';
				}

				if (isset($this->request->get['order'])) {
					$order = $this->request->get['order'];
				} else {
					$order = 'ASC';
				}

				$this->load->model('catalog/review');

				$this->data['products'] = array();

				$results = $this->model_catalog_product->getProductsByManufacturerId($this->request->get['manufacturer_id'], $sort, $order, ($page - 1) * 20, 20);

        		foreach ($results as $result) {
					if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = 'no_image.jpg';
					}

					//$rating = $this->model_catalog_review->getAverageRating($result['product_id']);

//					$special = FALSE;
//
//					$discount = $this->model_catalog_product->getProductDiscount($result['product_id']);
//
//					if ($discount) {
//						$price = $this->currency->format($this->tax->calculate($discount, $result['tax_class_id'], $this->config->get('config_tax')));
//					} else {
//						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
//
//						$special = $this->model_catalog_product->getProductSpecial($result['product_id']);
//
//						if ($special) {
//							$special = $this->currency->format($this->tax->calculate($special, $result['tax_class_id'], $this->config->get('config_tax')));
//						}
//					}

					if ($result["power"] == 1) {
						$akcia = TRUE;
						$this->data['akcia'] = TRUE;
					} else if ($result["power"] == 0) {
						$akcia = FALSE;
						$this->data['akcia'] = FALSE;
					}

					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));

          			$this->data['products'][] = array(
            			'name'    => $result['name'],
						      'model'   => $result['model'],
						      'akcia'   => $akcia,
						      'thumb'   => image_resize($image, $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height')),
            			'price'   => $price,
						      'special' => $special,
					        'href'    => $this->model_tool_seo_url->rewrite($this->url->http('product/product&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&product_id=' . $result['product_id']))
          			);
        		}

				if (!$this->config->get('config_customer_price')) {
					$this->data['display_price'] = TRUE;
				} elseif ($this->customer->isLogged()) {
					$this->data['display_price'] = TRUE;
				} else {
					$this->data['display_price'] = FALSE;
				}

				$url = '';

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				$this->data['sorts'] = array();

				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_name_asc'),
					'value' => 'pd.name-ASC',
					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=ASC'))
				);

				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_name_desc'),
					'value' => 'pd.name-DESC',
					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=pd.name&order=DESC'))
				);

				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_price_asc'),
					'value' => 'p.price-ASC',
					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=ASC'))
				);

				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_price_desc'),
					'value' => 'p.price-DESC',
					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=p.price&order=DESC'))
				);

//				$this->data['sorts'][] = array(
//					'text'  => $this->language->get('text_rating_desc'),
//					'value' => 'rating-DESC',
//					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=DESC'))
//				);
//
//				$this->data['sorts'][] = array(
//					'text'  => $this->language->get('text_rating_asc'),
//					'value' => 'rating-ASC',
//					'href'  => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . '&sort=rating&order=ASC'))
//				);

				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				$pagination = new Pagination();
				$pagination->total = $product_total;
				$pagination->page = $page;
				$pagination->limit = 20;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&page=%s'));

				$this->data['pagination'] = $pagination->render();

				$this->data['sort'] = $sort;
				$this->data['order'] = $order;

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/manufacturer.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/product/manufacturer.tpl';
				} else {
					$this->template = 'default/template/product/manufacturer.tpl';
				}

				$this->children = array(
					'common/header',
					'common/footer',
					'common/column_left',
					'common/column_right'
				);

				$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
      		} else {
        		$this->document->title = $manufacturer_info['name'];

        		$this->data['heading_title'] = $manufacturer_info['name'];

        		$this->data['text_error'] = $this->language->get('text_empty');

        		$this->data['button_continue'] = $this->language->get('button_continue');

        		$this->data['continue'] = $this->url->http('common/home');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
				} else {
					$this->template = 'default/template/error/not_found.tpl';
				}

				$this->children = array(
					'common/header',
					'common/footer',
					'common/column_left',
					'common/column_right'
				);

				$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
      		}
    	} else {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

      		$this->document->breadcrumbs[] = array(
        		'href'      => $this->model_tool_seo_url->rewrite($this->url->http('product/manufacturer&manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)),
        		'text'      => $this->language->get('text_error'),
        		'separator' => $this->language->get('text_separator')
      		);

			$this->document->title = $this->language->get('text_error');

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->http('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}

			$this->children = array(
				'common/header',
				'common/footer',
				'common/column_left',
				'common/column_right'
			);

			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		}
  	}
}
?>
