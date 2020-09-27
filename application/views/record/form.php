            <div class="row">
              <div class="col-lg-12">
                <h2 class="title-1 m-b-25">Money Tracker</h2>
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <strong><?= ucfirst($operation) ?> Record</strong>
                    </div>
                    <div class="card-body card-block">
                      <?php if (validation_errors()) { ?>
                        <div class="alert alert-danger">
                          <?= validation_errors() ?>
                        </div>
                      <?php } ?>
                      <?= form_open(base_url() . "record/{$operation}" . (isset($id) ? "/{$id}" : FALSE), 'enctype="multipart/form-data" class="form-horizontal"') ?>
                        <div class="form-group">
                          <label for="cc-payment" class="control-label mb-1">Amount*</label>
                          <input id="cc-pament" class="form-control" name="amount" type="number" aria-required="true" min="1" aria-invalid="false" placeholder="0" value="<?= set_value('amount') ? set_value('amount') : (isset($editable_record) ? ($editable_record['amount'] < 0 ? ($editable_record['amount'] * -1) : $editable_record['amount']) : FALSE) ?>">
                        </div>
                        <div class="form-group">
                          <label for="name" class="form-control-label">Name*</label>
                          <input id="name" class="form-control" name="name" type="text" placeholder="Name" value="<?= set_value('name') ? set_value('name') : (isset($editable_record) ? $editable_record['name'] : FALSE) ?>">
                        </div>
                        <div class="form-group">
                          <label for="date" class="form-control-label">Date*</label>
                          <input id="date" class="form-control" name="date" type="datetime-local" value="<?= set_value('date') ? set_value('date') : (isset($editable_record) ? date('Y-m-d\TH:i', strtotime($editable_record['date'])) : FALSE) ?>">
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-2">
                            <label class=" form-control-label">Type*</label>
                          </div>
                          <div class="col col-md-10">
                            <div class="form-check">
                              <div class="radio">
                                <label for="income" class="form-check-label">
                                  <input id="income" class="form-check-input" name="recordtype" type="radio" value="income" <?= set_checkbox('recordtype', 'income') ? set_checkbox('recordtype', 'income') : (isset($editable_record) ? ($editable_record['amount'] > 0 ? 'checked' : FALSE) : FALSE) ?>>Income
                                </label>
                              </div>
                              <div class="radio">
                                <label for="expense" class="form-check-label">
                                  <input id="expense" class="form-check-input" name="recordtype" type="radio" value="expense" <?= set_checkbox('recordtype', 'expense') ? set_checkbox('recordtype', 'expense') : (isset($editable_record) ? ($editable_record['amount'] < 0 ? 'checked' : FALSE) : FALSE) ?>>Expense
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="notes" class="form-control-label">Notes</label>
                          <textarea id="notes" class="form-control" name="notes" rows="9" placeholder="Notes"><?= set_value('notes') ? set_value('notes') : (isset($editable_record) ? $editable_record['notes'] : FALSE) ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="receipt" class=" form-control-label">Receipt</label>
                          <?php if ($operation == 'edit') { ?>
                            <?= form_hidden('uploaded_receipt', set_value('uploaded_receipt') ? set_value('uploaded_receipt') : (isset($editable_record) ? $editable_record['attachment'] : FALSE)) ?>
                          <?php } ?>
                          <?php $has_receipt = set_value('uploaded_receipt') !== '' || (isset($editable_record['attachment']) && $editable_record['attachment'] !== ''); ?>
                          <?php if ($has_receipt) { ?>
                            <a href="<?= set_value('uploaded_receipt') ? set_value('uploaded_receipt') : (isset($editable_record) ? $editable_record['attachment'] : FALSE) ?>" target="_blank" style="float: right;">Currently uploaded receipt <i class="fa fa-external-link-alt"></i></a>
                          <?php } ?>
                          <input id="receipt" class="form-control-file" name="receipt" type="file">
                        </div>
                        <?php if ($has_receipt) { ?>
                          <div class="alert alert-warning" style="">Just by not selecting a file to upload won't actually delete the currently uploaded receipt. You need to delete the corresponding record to do that.</div>
                        <?php } ?>
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
