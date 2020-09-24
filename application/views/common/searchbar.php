        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="header-wrap">
              <?= form_open(base_url().'record/search', 'class="form-header"') ?>
                <input class="au-input au-input--xl" type="text" name="query" placeholder="Search" value="<?= isset($fdata['search_query']) ? $fdata['search_query'] : FALSE ?>" required />
                <button class="au-btn--submit" type="submit">
                  <i class="zmdi zmdi-search"></i>
                </button>
              </form>
              <?php if (isset($fdata['search_query_validation_errors'])) { ?>
                <div class="alert alert-danger m-b-0" style="padding-top: .5rem; padding-bottom: .5rem;">
                  <?= $fdata['search_query_validation_errors'] ?>
                </div>
              <?php } ?>
            <div>
          </div>
        </div>
