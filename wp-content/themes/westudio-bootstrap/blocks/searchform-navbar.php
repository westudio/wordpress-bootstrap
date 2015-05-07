<form
  id="searchform"
  action="<?php echo home_url(); ?>"
  method="get"
  role="search"
  class="form-search navbar-search pull-right">
  <div class="input-append">
    <input
      type="text"
      id="s"
      name="s"
      value="<?php echo get_search_query(); ?>"
      placeholder="<?php _e('Search', 'wb'); ?>"
      class="input-small search-query" />
    <button
      id="searchsubmit"
      type="submit"
      class="btn btn-icon">
      <i class="icon-search"></i>
    </button>
  </div>
</form>
