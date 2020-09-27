            <div class="row">
              <div class="col-lg-12">
                <h2 class="title-1 m-b-10">My Transactions</h2>
                <h5 class="lead m-b-25">Sorted by the order they were submitted, from the first to very the last</h2>
                <?php if (isset($fdata['alerts'])) { ?>
                  <div class="card" style="border-radius: .5rem">
                    <div class="card-body card-block" style="padding: .5rem">
                      <?php $total_alerts = count($fdata['alerts']); ?>
                      <?php foreach($fdata['alerts'] as $index => $alert) { ?>
                        <div class="alert alert-<?= $alert['type'] ?>" style="margin-bottom: <?= $index == ($total_alerts - 1) ? '0' : '.5rem' ?>">
                          <?= $alert['title'] ?>
                          <?php if (isset($alert['bullets'])) { ?>
                            <ul class="m-l-25">
                              <?php foreach($alert['bullets'] as $point) { ?>
                                <li><?= $point ?></li>
                              <?php } ?>
                            </ul>
                          <?php } ?>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
                <div class="table-responsive table--no-card m-b-40">
                  <table class="table table-borderless table-striped table-earning">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Notes</th>
                        <th>Attachment</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($records) && count($records) > 0) { ?>
                        <?php foreach($records as $index => $item) { ?>
                          <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['amount'] ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($item['date'])) ?></td>
                            <td><?= $item['notes'] ?></td>
                            <td>
                              <?php if ($item['attachment'] !== '') { ?>
                                <a href="<?= $item['attachment'] ?>" target="_blank"><?= $item['attachment'] ?></a>
                              <?php } ?>
                            </td>
                            <td><a href="<?= base_url().'record/edit/'.$item['id']?>"><i class="fa fa-edit"></i></a></td>
                            <td><a href="<?= base_url().'record/delete/'.$item['id'] ?>"><i class="fa fa-trash"></i></a></td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="8" style="text-align: center;">EMPTY</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
