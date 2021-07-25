<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
?>
<?php $this->assign('title', 'お知らせ情報 登録'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>
<?php $this->Html->script('datepicker', ['block' => true]); ?>

<div class="column-responsive column-80">
  <?= $this->Flash->render() ?>
    <div class="shops form content">
        <?= $this->Form->create($news) ?>
        <fieldset>
            <h3>お知らせ情報 登録</h3>
            <table>
              <?php if ($login_user['role'] === 'admin'): ?>
              <tr>
                <th>店舗</th>
                <td>
                  <?php
                  echo $this->Form->select('shop_id',$shops,['empty'=>'選択してください', 'style'=>'width: 180px;']);
                  if ($this->Form->isFieldError('shop_id')) {
                      echo $this->Form->error('shop_id');
                  }?>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <th>有効 / 無効</th>
                <td>
                  <?php
                  echo $this->Form->radio('is_valid', ['無効','有効']);
                  if ($this->Form->isFieldError('is_valid')) {
                      echo $this->Form->error('is_valid');
                  }?>
                </td>
              </tr>
              <tr>
                <th>公開日</th>
                <td>
                  <?php
                  echo $this->Form->text('release_date', ['class'=>'datepicker', 'style'=>'width: 130px;']).' ～ ';
                  echo $this->Form->text('release_end_date', ['class'=>'datepicker', 'style'=>'width: 130px;']);
                  if ($this->Form->isFieldError('release_date')) {
                      echo $this->Form->error('release_date');
                  }
                  if ($this->Form->isFieldError('release_end_date')) {
                      echo $this->Form->error('release_end_date');
                  }?>
                </td>
              </tr>
              <tr>
                <th>タイトル</th>
                <td>
                  <?php
                  echo $this->Form->text('title');
                  if ($this->Form->isFieldError('title')) {
                      echo $this->Form->error('title');
                  }?>
                </td>
              </tr>
              <tr>
                <th>本文</th>
                <td>
                  <?php
                  echo $this->Form->textarea('text');
                  if ($this->Form->isFieldError('text')) {
                      echo $this->Form->error('text');
                  }?>
                </td>
              </tr>
            </table>
        </fieldset>
        <?= $this->Form->button(__('送信')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
