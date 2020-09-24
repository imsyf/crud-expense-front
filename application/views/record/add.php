            <div class="row">
              <div class="col-lg-12">
                <h2 class="title-1 m-b-25">Money Tracker</h2>
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <strong>Add Record</strong>
                    </div>
                    <div class="card-body card-block">
                      <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger">
                          <?= validation_errors() ?>
                        </div>
                      <?php } ?>
                      <?= form_open(base_url().'record/add', 'enctype="multipart/form-data" class="form-horizontal"') ?>
                        <div class="form-group">
                          <label for="cc-payment" class="control-label mb-1">Amount*</label>
                          <input id="cc-pament" class="form-control" name="amount" type="number" aria-required="true" aria-invalid="false" placeholder="0" value="<?= set_value('amount') ?>">
                        </div>
                        <div class="form-group">
                          <label for="name" class="form-control-label">Name*</label>
                          <input id="name" class="form-control" name="name" type="text" placeholder="Name" value="<?= set_value('name') ?>">
                        </div>
                        <div class="form-group">
                          <label for="date" class="form-control-label">Date*</label>
                          <input id="date" class="form-control" name="date" type="datetime-local" value="<?= set_value('date') ?>">
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Type*</label>
                          </div>
                          <div class="col col-md-10">
                            <div class="form-check">
                              <div class="radio">
                                <label for="income" class="form-check-label">
                                  <input id="income" class="form-check-input" name="recordtype" type="radio" value="income" <?= set_checkbox('recordtype', 'income') ?>>Income
                                </label>
                              </div>
                              <div class="radio">
                                <label for="expense" class="form-check-label">
                                  <input id="expense" class="form-check-input" name="recordtype" type="radio" value="expense" <?= set_checkbox('recordtype', 'expense') ?>>Expense
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="notes" class="form-control-label">Notes</label>
                          <textarea id="notes" class="form-control" name="notes" rows="9" placeholder="Notes"><?= set_value('notes') ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="receipt" class=" form-control-label">Receipt</label>
                          <input id="receipt" class="form-control-file" name="receipt" type="file">
                        </div>
                        <div class="card-footer">
                          <button class="btn btn-primary btn-sm" type="submit">
                            <i class="fa fa-dot-circle-o"></i> Submit
                          </button>
                          <button class="btn btn-danger btn-sm" type="reset">
                            <i class="fa fa-ban"></i> Reset
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
