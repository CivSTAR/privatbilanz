<?php require_once APPROOT . '/views/inc/header.php'; ?>

<section class="content">
  <?php flash('message_add'); ?>
        <div class="bilanz clearfix">
            <div class="aktiva">

                <div class="bilanzbox">
                    <div class="bilanzbox-aktiva">
                        <h3>Kurzfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                          <?php foreach($data['shortActiva'] as $row) : ?>
                            <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>                                            
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bilanzbox">
                    <div class="bilanzbox-aktiva">
                        <h3>Mittelfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                        <?php foreach($data['midActiva'] as $row) : ?>
                          <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bilanzbox">
                    <div class="bilanzbox-aktiva">
                        <h3>Langfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                        <?php foreach($data['longActiva'] as $row) : ?>
                          <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

              <?php if($data['equity'] < 0) : ?>
                <div class="bilanzbox">
                  <div class="bilanzbox-equity clearfix">                    
                    <div class="bilanz-final-desc">
                      <p>Fehlbetrag</p>
                    </div>
                    <div class="bilanz-final-value">
                      <p><?php echo number_format($data['equity'] * -1, 2, ',', '.'); ?></p>
                    </div>                    
                  </div>
                </div>
              <?php endif; ?>

            </div>
            <div class="passiva">
                <div class="bilanzbox">
                    <div class="bilanzbox-passiva">
                        <h3>Kurzfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                        <?php foreach($data['shortPassiva'] as $row) : ?>
                          <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bilanzbox">
                    <div class="bilanzbox-passiva">
                        <h3>Mittelfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                        <?php foreach($data['midPassiva'] as $row) : ?>
                          <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="bilanzbox">
                    <div class="bilanzbox-passiva">
                        <h3>Langfristig</h3>
                    </div>
                    <div class="bilanzbox-content">
                        <ul class="bilanzbox-liste">
                        <?php foreach($data['longPassiva'] as $row) : ?>
                            <li class="bilanzbox-element">
                                <div class="activabox-element-content clearfix">
                                    <div class="bilanzbox-element-desc">
                                        <p>
                                          <a href="<?php echo URLROOT; ?>/balances/edit/<?php echo $row->id; ?>" class="item-edit--btn">
                                            <ion-icon name="create-outline"></ion-icon>
                                          </a>
                                          <?php echo $row->title; ?>
                                        </p>
                                    </div>
                                    <div class="bilanzbox-element-value">
                                        <p>
                                          <?php echo number_format($row->value, 2, ',', '.'); ?>
                                          <a href="<?php echo URLROOT; ?>/balances/delete/<?php echo $row->id; ?>" class="item-delete--btn">
                                            <ion-icon name="trash-sharp"></ion-icon>
                                          </a>
                                        </p>
                                    </div>                                    
                                </div>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

              <?php if($data['equity'] >= 0) : ?>
                <div class="bilanzbox">
                  <div class="bilanzbox-equity clearfix">                    
                    <div class="bilanz-final-desc">
                      <p>Eigenkapital</p>
                    </div>
                    <div class="bilanz-final-value">
                      <p><?php echo number_format($data['equity'], 2, ',', '.'); ?></p>
                    </div>                    
                  </div>
                </div>
              <?php endif; ?>

            </div>
        </div>
        
        <div class="bilanz-final clearfix">
            <div class="aktiva-final">
                <div class="bilanz-final-content clearfix">
                    <div class="bilanz-final-desc">
                        <p>Aktiva</p>
                    </div>
                    <div class="bilanz-final-value">
                        <p><?php echo number_format($data['sumActiva']->value, 2, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
            <div class="passiva-final">
                <div class="bilanz-final-content clearfix">
                    <div class="bilanz-final-desc">
                        <p>Passiva</p>
                    </div>
                    <div class="bilanz-final-value">
                        <p><?php echo number_format($data['sumPassiva']->value, 2, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="loginbox">
            <div class="loginbox-top">
            <h2>Neuer Eintrag</h2>
            </div>
            <div class="loginbox-content">
            <form action="<?php echo URLROOT; ?>/balances/add" method="post">
                <ul class="formlist">
                <li class="formlist-line">
                    <select class="formlist-select" name="side">
                        <option value="1" selected>Aktiva</option>
                        <option value="2">Passiva</option>
                    </select>
                </li>
                <li class="formlist-line">
                    <select class="formlist-select" name="type">
                        <option value="1" selected>Kurzfristig</option>
                        <option value="2">Mittelfristig</option>
                        <option value="3">Langfristig</option>
                    </select>
                </li>
                <li class="formlist-line">
                    <input class="formlist-input" type="text" name="title" value="<?php echo (!empty($data['title']) ? $data['title'] : ''); ?>" placeholder="Information" required>
              <?php if(!empty($data['title_err'])) : ?>
                </li>
                <li class="formlist-invalid">
                  <span><?php echo $data['title_err']; ?></span>
              <?php endif; ?>
                </li>
                <li class="formlist-line">
                    <input class="formlist-input" type="text" name="value" value="<?php echo (!empty($data['value']) ? $data['value'] : ''); ?>" placeholder="Betrag" required>
                </li>
              <?php if(!empty($data['value_err'])) : ?>
                </li>
                <li class="formlist-invalid">
                  <span><?php echo $data['value_err']; ?></span>
              <?php endif; ?>
                <li class="formlist-line">
                    <input class="formlist-button" type="submit" value="Hinzufügen" required>
                </li>
                </ul>
            </form>
            </div>
        </div>
        </section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>