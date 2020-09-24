            <?php if (isset($alerts)) { ?>
              <div class="card" style="border-radius: .5rem">
                <div class="card-body card-block" style="padding: .5rem">
                  <?php $total_alerts = count($alerts); ?>
                  <?php foreach($alerts as $index => $alert) { ?>
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
            <div class="row">
              <div class="col-md-12">
                <div class="overview-wrap">
                  <h2 class="title-1">Overview</h2>
                </div>
              </div>
            </div>
            <div class="row m-t-25">
              <div class="col-sm-6 col-lg-6">
                <div class="overview-item overview-item--c3">
                  <div class="overview__inner">
                    <div class="overview-box clearfix">
                      <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                      </div>
                      <div class="text">
                        <h2><?= isset($summary) ? $summary['number_of_records'] : 'NaN' ?> transactions</h2>
                        <span>this month</span>
                      </div>
                    </div>
                    <div class="overview-chart">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-6">
                <div class="overview-item overview-item--c4">
                  <div class="overview__inner">
                    <div class="overview-box clearfix">
                      <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                      </div>
                      <div class="text">
                        <h2><?= isset($summary) ? $summary['balance'] : 'NaN' ?> $</h2>
                        <span>your balance</span>
                      </div>
                    </div>
                    <div class="overview-chart">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-9">
                <h2 class="title-1 m-b-25">10 Most Recent Records</h2>
                <div class="table-responsive table--no-card m-b-40">
                  <table class="table table-borderless table-striped table-earning">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Notes</th>
                        <th>Attachment</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (isset($recent_records) && count($recent_records) > 0) { ?>
                        <?php foreach($recent_records as $item) { ?>
                          <tr>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['amount'] ?></td>
                            <td><?= $item['date'] ?></td>
                            <td><?= $item['notes'] ?></td>
                            <td><a href="<?= $item['attachment'] ?>" target="_blank"><?= $item['attachment'] ?></a></td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="5" style="text-align: center;">EMPTY</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-3">
                <h2 class="title-1 m-b-25">Top Expenses</h2>
                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                  <div class="au-card-inner">
                    <div class="table-responsive">
                      <table class="table table-top-countries">
                        <tbody>
                          <?php if (isset($top_expenses) && count($top_expenses) > 0) { ?>
                            <?php foreach($top_expenses as $item) { ?>
                              <tr>
                                <td><?= $item['name'] ?></td>
                                <td class="text-right"><?= $item['amount'] ?> $</td>
                              </tr>
                            <?php } ?>
                          <?php } else { ?>
                            <tr>
                              <td colspan="2" style="text-align: center;">EMPTY</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="copyright">
                  <p>Copyright © 2020. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
              </div>
            </div>
