<div class="box">
  <?php /*<div class="top"><img src="catalog/view/theme/default/image/icon_search.png" alt="" /><?php echo $heading_title; ?></div>*/ ?>
  <div class="middle">
    <div id="module_search">
      <?php if ($keyword) { ?>
      <input type="text" name="keyword" value="<?php echo $keyword; ?>" id="filter_keyword" />
      <?php } else { ?>
      <input type="text" name="keyword" value="<?php echo $text_keywords; ?>" id="filter_keyword" onclick="this.value = ''" />
      <?php } ?>
      <a onclick="moduleSearch();" class="button"><span><?php echo $button_search; ?></span></a></div>
    <script type="text/javascript"><!--
    $(function () {
      $('#module_search input').keydown(function(e) {
          if (e.keyCode == 13) {
              moduleSearch();
          }
      });
    });
    function moduleSearch() {
      location = 'index.php?route=product/search&keyword=' + encodeURIComponent($('#filter_keyword').attr('value'));
    }
    //--></script>
  </div>
  <div class="bottom">&nbsp;</div>
</div>
