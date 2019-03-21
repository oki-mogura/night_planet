<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> -->
  <title>
    <?= LT['004'] ?>:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->script('jquery-3.1.0.min.js') ?>
  <?= $this->Html->script('materialize.min.js') ?>
  <?= $this->Html->script('map.js') ?>
  <?= $this->Html->script('okiyoru.js') ?>
  <?= $this->Html->script('ja_JP.js') ?>
  <?= $this->Html->script('jquery.notifyBar.js') ?>
  <?= $this->Html->script('ajaxzip3.js') ?>
  <?= $this->Html->script("https://maps.googleapis.com/maps/api/js?key=AIzaSyDgd-t3Wa40gScJKC3ZH3ithzuUUapElu4") ?>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <?= $this->Html->css('fontello-3eba660b/css/fontello.css') ?>
  <?= $this->Html->css('materialize.css') ?>
  <?= $this->Html->css('okiyoru.css') ?>
  <?= $this->Html->css('jquery.notifyBar.css') ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
  <?php $id = $this->request->getSession()->read('Auth.Owner.id') ?>
<body>
  <ul id="slide-out" class="side-nav">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="/img/common/top/top1.jpg">
        </div>
        <a href="#!user"><img class="circle" src="/img/common/top/top1.jpg"></a>
        <a href="#!name"><span class="white-text name">John Doe</span></a>
        <a href="#!email"><span class="white-text email"><?=$this->request->getSession()->read('Auth.Owner.email')?></span></a>
      </div>
    </li>
    <li>
      <a href="/owner/shops/index/<?=$id?>?activeTab=topImage" class="waves-effect modal-trigger">
        <i class="material-icons" href="">info_outline</i><?= OWNER_LM['001'] ?>
      </a>
    </li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=catch" class="waves-effect modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['002'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=coupon" class="waves-effect modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['003'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=cast" class="waves-effect modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['004'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=tenpo" class="waves-effect modal-trigger"><i class="material-icons">trending_up</i><?= OWNER_LM['005'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=tennai" class="waves-effect modal-trigger"><i class="material-icons">trending_up</i><?= OWNER_LM['006'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=map" class="waves-effect modal-trigger"><i class="material-icons">vertical_align_top</i><?= OWNER_LM['007'] ?></a></li>
    <li><a href="/owner/shops/index/<?=$id?>?activeTab=job" class="waves-effect modal-trigger"><i class="material-icons">cloud</i><?= OWNER_LM['008'] ?></a></li>
    <li><a class="waves-effect" href="/owner/owners"><i class="material-icons">help_outline</i><?= COMMON_LM['004'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">help_outline</i><?= COMMON_LM['001'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">contact_mail</i><?= COMMON_LM['002'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">note</i><?= COMMON_LM['003'] ?></a></li>
    <li><a class="waves-effect" href="#!"><i class="material-icons">note</i><?= COMMON_LM['005'] ?></a></li>
    <li><div class="divider"></div></li>
    <li><a href="/owner/owners/logout" class="waves-effect modal-trigger"><i class="material-icons" href="">info_outline</i><?= COMMON_LM['007'] ?></a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
  <nav>
    <div class="nav-wrapper">
      <a href="#" data-activates="slide-out" class="button-collapse oki-button-collapse"><i class="material-icons">menu</i></a>
      <a href="#!" class="brand-logo oki-brand-logo"><?= LT['001'] ?></a>
      <ul class="right">
        <li><a data-target="modal-help" class="modal-trigger"><i class="material-icons">help</i></a></li>
      </ul>
    </div>
  </nav>
  <!-- ヘルプモーダル -->
  <?= $this->element('modal/helpModal'); ?>
  <?= $this->element('modal/jobModal'); ?>
  <?= $this->fetch('content') ?>
  <footer class="page-footer">
    <div class="container row">
      <div class="col s12 l6">
        <h5 class="white-text">Links</h5>
        <ul class="collection">
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=top-image" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">info_outline</i><?= OWNER_LM['001'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=catch" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['002'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=coupon" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['003'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=cast" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">event_available</i><?= OWNER_LM['004'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=tenpo" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">vertical_align_top</i><?= OWNER_LM['005'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=tennai" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">trending_up</i><?= OWNER_LM['006'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=map" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">trending_up</i><?= OWNER_LM['007'] ?></a></li>
          <li><a href="/owner/shops/index/<?=$id?>?activeTab=job" class="grey-text link-box text-lighten-3 collection-item modal-trigger"><i class="material-icons">vertical_align_top</i><?= OWNER_LM['008'] ?></a></li>
        </ul>
      </div>
      <div class="col s12 l6">
        <h5 class="white-text">Links</h5>
        <ul class="collection">
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="/owner/owners"><i class="material-icons">cloud</i><?= COMMON_LM['004'] ?></a></li>
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="#!"><i class="material-icons">cloud</i>facebook</a></li>
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="#!"><i class="material-icons">help_outline</i><?= COMMON_LM['001'] ?></a></li>
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="/pages/contract"><i class="material-icons">contact_mail</i><?= COMMON_LM['002'] ?></a></li>
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="/pages/privacy_policy"><i class="material-icons">note</i><?= COMMON_LM['003'] ?></a></li>
          <li><a class="grey-text link-box text-lighten-3 collection-item" href="/pages/contract"><i class="material-icons">note</i><?= COMMON_LM['005'] ?></a></li>
        </ul>
      </div>
      <div class="col s12">
        <span class="grey-text text-lighten-3"><?= CATCHCOPY ?></span>
        <span><?= $this->Html->link(__('　　　　'), ['controller' => 'developer/Developers', 'action' => 'index']) ?></span>
      </div>
    </div>
    <div class="footer-copyright oki-footer-copyright">
      <?= LT['002']; ?>
      <?=(2018-date('Y'))?' - '.date('Y'):'';?> <?= LT['003'] ?>
    </div>
    <div id="return_top">
      <a href="#body" class="red"><i class="medium material-icons return_top">keyboard_arrow_up</i></a>
    </div><!-- END #return_top -->
  </footer>
  <?= $this->Html->scriptstart() ?>
$(document).ready(function(){
  googlemap_init('google_map', '沖縄県浦添市屋富祖３丁目１５');
});
<?= $this->Html->scriptend() ?>

</body>
</html>
