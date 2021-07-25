<?php $this->assign('title', 'トップページ'); ?>
<?php $this->Html->css('shop_list', ['block' => true]); ?>

<div class="content">
    <div class="main-menu">
        <div class="main-item">
            <div class="main-container">
                <h2>店舗検索</h2>
                <div class="serch-container">
                    <table>
                        <tr>
                            <th>都道府県</th>
                            <td>
                                <div class="select-item">
                                  <?php foreach ( Cake\Core\Configure::read('pref') as $key => $value ): ?>
                                    <?php if( $key == 1 ): ?><p>北海道・東北</p><?php endif; ?>
                                    <?php if( $key == 8 ): ?><br><p>関東</p><?php endif; ?>
                                    <?php if( $key == 15 ): ?><br><p>甲信越・北陸</p><?php endif; ?>
                                    <?php if( $key == 21 ): ?><br><p>東海</p><?php endif; ?>
                                    <?php if( $key == 25 ): ?><br><p>近畿</p><?php endif; ?>
                                    <?php if( $key == 31 ): ?><br><p>中国</p><?php endif; ?>
                                    <?php if( $key == 36 ): ?><br><p>四国</p><?php endif; ?>
                                    <?php if( $key == 40 ): ?><br><p>九州・沖縄</p><?php endif; ?>
                                      <a href="/shop/perf/<?= $key ?>"><?= $value ?></a>
                                  <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>地名</th>
                            <td>
                                <?= $this->Form->create($shops, ['url' => '/shop/search', 'type' => 'post']) ?>
                                    <input type="text" name="address" value="">
                                    <button type="submit" name="button" class="btn-home">検索</button>
                                <?= $this->Form->end() ?>
                            </td>
                        </tr>
                        <tr>
                            <th>フリーワード</th>
                            <td>
                                <?= $this->Form->create($shops, ['url' => '/shop/search', 'type' => 'post']) ?>
                                    <input type="text" name="freeword" value="">
                                    <button type="submit" name="button" class="btn-home">検索</button>
                                <?= $this->Form->end() ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="main-item">
            <div class="main-container">
                <h2>新着店舗</h2>
                <?php if ( $shops->count() ): ?>
                    <div class="shop-item">
                      <?php foreach ($shops as $shop): ?>
                          <a class="shop-container" href="/shop/detail/<?= $shop->id ?>">
                              <?php if ($shop->shop_image): ?>
                                  <img class="shop-image" src="/upload/<?= $shop->shop_image ?>" alt="店舗画像">
                              <?php else: ?>
                                  <img class="shop-image" src="/img/no_image_w3h2.png" alt="NO IMAGE">
                              <?php endif; ?>
                              <p class="shopname"><?= h($shop->shopname) ?></p>
                              <div class="shop-address">
                                <p>〒<?= h($shop->postcode) ?></p>
                                <p><?= h(Cake\Core\Configure::read('pref')[$shop->pref_id]) ?><?= h($shop->address) ?></p>
                              </div>
                              <p class="shop-tel">Tel：<?= h($shop->tel) ?></p>
                              <!-- <button type="button" name="button">詳細へ</button> -->
                          </a>
                      <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <tr>
                      <td colspan="6" style="text-align: center;">表示できる情報がありません</td>
                    </tr>
                <?php endif; ?>
            </div>
        </div>
        <div class="main-item">
            <div class="main-container">
                <h2>店舗からの新着情報</h2>
                <div class="news-container">
                  <ul>
                    <?php foreach ($news as $news): ?>
                      <a href="/news/detail/<?= h($news->id) ?>"><li><span><?= h($news->release_date) ?></span><?= h($news->shop->shopname) ?> <?= h($news->title) ?></li></a>
                    <?php endforeach; ?>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
