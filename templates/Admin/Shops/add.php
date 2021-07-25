<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 */
?>
<?php $this->assign('title', '店舗情報 登録'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>
<?php $this->Html->script('//ajaxzip3.github.io/ajaxzip3.js', array('block' => true)); ?>

<div class="column-responsive column-80">
  <?= $this->Flash->render() ?>
    <div class="shops form content">
        <?= $this->Form->create($shop, ['type' => 'file']) ?>
        <fieldset>
            <h3>店舗情報 登録</h3>
            <table>
              <tr>
                <th>店舗名</th>
                <td>
                  <?php
                  echo $this->Form->text('shopname');
                  if ($this->Form->isFieldError('shopname')) {
                      echo $this->Form->error('shopname');
                  }?>
                </td>
              </tr>
              <tr>
                <th>住所</th>
                <td>
                  <table>
                  <tr>
                    <td style="width: 150px;">郵便番号</td>
                    <td>
                      <?= $this->Form->text('postcode', ['placeholder'=>'000-0000', 'onKeyUp'=> "AjaxZip3.zip2addr(this,'','pref_id','address');", 'style'=>'width: 120px;'] ); ?>
                      <span style="margin-left: 10px; font-size: small;">ハイフンありの半角数字で入力してください</span>
                      <?php
                      if ($this->Form->isFieldError('postcode')) {
                          echo $this->Form->error('postcode');
                      }?>
                    </td>
                  </tr>
                  <tr>
                    <td>都道府県</td>
                    <td>
                      <?= $this->Form->select('pref_id',Cake\Core\Configure::read('pref'),['empty'=>'選択してください', 'style'=>'width: 180px;']) ?>
                      <?php
                      if ($this->Form->isFieldError('pref_id')) {
                          echo $this->Form->error('pref_id');
                      }?>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-bottom: none;">住所<br>（市区町村以下）</td>
                    <td style="border-bottom: none;">
                      <?php
                      echo $this->Form->text('address');
                      if ($this->Form->isFieldError('address')) {
                          echo $this->Form->error('address');
                      }?>
                    </td>
                  </tr>
                </table>
                </td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>
                  <?= $this->Form->tel('tel', ['placeholder'=>'00-0000-0000', 'style'=>'width: 160px;']); ?>
                  <span style="margin-left: 10px; font-size: small;">ハイフンありの半角数字で入力してください</span>
                  <?php
                  if ($this->Form->isFieldError('tel')) {
                      echo $this->Form->error('tel');
                  }?>
                </td>
              </tr>
              <tr>
                <th>営業時間</th>
                <td>
                  <?php
                  echo $this->Form->textarea('business_hours');
                  if ($this->Form->isFieldError('business_hours')) {
                      echo $this->Form->error('business_hours');
                  }?>
                </td>
              </tr>
              <tr>
                <th>定休日</th>
                <td>
                  <?php
                  echo $this->Form->textarea('regular_holiday');
                  if ($this->Form->isFieldError('regular_holiday')) {
                      echo $this->Form->error('regular_holiday');
                  }?>
                </td>
              </tr>
              <tr>
                <th>フリーテキスト</th>
                <td>
                  <?php
                  echo $this->Form->textarea('free_test');
                  if ($this->Form->isFieldError('free_test')) {
                      echo $this->Form->error('free_test');
                  }?>
                </td>
              </tr>
              <tr>
                <th>店舗画像</th>
                <td>
                  <?php
                  echo $this->Form->file('shop_image');
                  if ($this->Form->isFieldError('shop_image')) {
                      echo $this->Form->error('shop_image');
                  }?>
                </td>
              </tr>
            </table>
        </fieldset>
        <?= $this->Form->button(__('送信')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
