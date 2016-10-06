<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<div class="heading">
  <h1><?php echo $heading_title; ?></h1>
  <div class="buttons"><a onclick="location='<?php echo $insert; ?>'" class="button"><span class="button_left button_insert"></span><span class="button_middle"><?php echo $button_insert; ?></span><span class="button_right"></span></a><a onclick="$('form').submit();" class="button"><span class="button_left button_delete"></span><span class="button_middle"><?php echo $button_delete; ?></span><span class="button_right"></span></a></div>
</div>
<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
  <table class="list">
    <thead>
      <tr>
        <td width="1" style="align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
        <td class="left"><?php if ($sort == 'pd.name') { ?>
          <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
          <?php } ?></td>
        <td class="left"><?php if ($sort == 'p.model') { ?>
          <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
          <?php } ?></td>
        <?php /*<td class="right"><?php if ($sort == 'p.quantity') { ?>
          <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
          <?php } ?></td>*/ ?>
        <td class="left"><?php echo $column_price; ?></td>
        <td class="left"><?php echo $column_sborka; ?></td>
        <td class="left"><?php if ($sort == 'p.status') { ?>
          <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
          <?php } ?></td>
        <td class="left"><?php if ($sort == 'p.sort_order') { ?>
          <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_order; ?>"><?php echo $column_sort_order; ?></a>
          <?php } ?></td>
        <td class="left"><?php echo $column_action; ?></td>
        <td class="left"><?php echo $column_nds; ?></td>
      </tr>
    </thead>
    <tbody>
      <tr class="filter">
        <td></td>
        <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
        <td><input type="text" name="filter_model" value="<?php echo $filter_model; ?>" /></td>
        <?php /*<td align="right"><input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /></td>*/ ?>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td><select name="filter_status">
            <option value="*"></option>
            <?php if ($filter_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <?php } ?>
            <?php if (!is_null($filter_status) && !$filter_status) { ?>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } ?>
          </select></td>
        <td align="right">&nbsp;</td>
        <td rowspan="2" align="right"><input type="button" value="<?php echo $button_filter; ?>" onclick="filter();" /></td>
        <td rowspan="2" align="right"></td>
      </tr>
      <tr class="filter">
         <td></td>
         <td colspan="6"><select name="filter_category" id="filter_category">
                          <option value="*"><?php echo $text_none; ?></option>
                          <?php foreach ($categories as $category) { ?>
                            <?php if (!is_null($filter_category) && $filter_category == $category['category_id']) { ?>
                            <option value="<?php echo $category['category_id']; ?>"selected="selected"><?php echo $category['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select></td>
      </tr>
      <?php if ($products) { ?>
      <?php $class = 'odd'; ?>
      <?php foreach ($products as $product) { ?>
      <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
      <tr class="<?php echo $class; ?>">
        <td style="align: center;"><?php if ($product['selected']) { ?>
          <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
          <?php } ?></td>
        <td class="left"><?php echo $product['name']; ?></td>
        <td class="left"><?php echo $product['model']; ?></td>
        <?php /*<td class="right"><?php echo $product['quantity']; ?></td>*/ ?>
        <td class="right"><?php echo $product['price']; ?></td>
        <td class="right"><?php echo $product['sborka']; ?></td>
        <td class="left"><?php echo $product['status']; ?></td>
        <td class="center"><?php echo $product['sort_order']; ?></td>
        <td class="center" style="white-space: nowrap;"><?php foreach ($product['action'] as $action) { ?>
          [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ] <br />
          <?php } ?></td>
                 <td class="center"><?php if($product['nds']){echo"+";}else{echo"-";} ?></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr class="even">
        <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</form>
<div class="pagination"><?php echo $pagination; ?></div>
<script type="text/javascript"><!--

function filter() {
	url = 'index.php?route=catalog/product';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
    // 101030 ALNAUA Add Category Filter To Product List Begin
    var filter_category = $('select[name=\'filter_category\']').attr('value');

	if (filter_category != '*') {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}
    // 101030 ALNAUA Add Category Filter To Product List End

	location = url;
}
//--></script>
<?php echo $footer; ?>