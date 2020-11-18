<div id="wrapper">
<?= $this->element('modal/noticeModal'); ?>
    <div class="container">
        <span id="dummy" style="display: hidden;"></span>
        <?= $this->Flash->render() ?>
        <h5><?=h('店舗お知らせ') ?></h5>
            <!-- 編集中の店舗 START-->
            <?= $this->element('now_edit_shop'); ?>
            <!-- 編集中の店舗 END-->
            <div id="notice" class="row">
                <input type="hidden" name="file_max" value=<?=PROPERTY['FILE_MAX']?>>
                <input type="hidden" name="notice_dir" value=<?=$shopInfo['notice_path'] ?>>
                <div class="col s12 m12 l12 xl8">
                    <div class="card-panel grey lighten-5">
                        <form id="edit-notice" name="edit_notice" method="post" action="/owner/shops/save_notice/">
                            <div style="display:none;">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="shop_id" value=<?= $shopInfo['id'] ?>>
                            </div>
                            <div class="row scrollspy">
                                <div class="input-field col s12 m12 l12">
                                    <input type="text" id="title" class="validate" name="title" value="" data-length="50">
                                    <label for="title">タイトル</label>
                                </div>
                                <div class="input-field col s12 m12 l12">
                                    <textarea id="content" class="validate materialize-textarea" name="content" data-length="600"></textarea>
                                    <label for="content">内容</label>
                                </div>
                            </div>
                            <div class="file-field input-field col s12 m12 l12">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" id="image-file" class="image-file" name="image[]" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input id="file-path" class="file-path validate" name="file_path" type="text">
                                </div>
                                <canvas id="image-canvas" style="display:none;"></canvas>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <a class="waves-effect waves-light btn-large createBtn disabled"><i class="material-icons right">search</i>登録</a>
                                    <a class="waves-effect waves-light btn-large cancelBtn disabled"><i class="material-icons right">search</i>やめる</a>
                                </div>
                            </div>
                        </form>
                        <form id="view-archive-notice" name="view_archive_notice" method="get" style="display:none;" action="/owner/shops/view_notice/">
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" value="">
                        </form>
                    </div>
                </div>
                <div class="col s12 m12 l12 xl4">
                    <?php if(count($top_notice) > 0) { ?>
                        <ul class="collection z-depth-3">
                            <?php foreach ($top_notice as $key => $row): ?>
                                <li class="linkbox collection-item avatar">
                                    <div class="archiveLink">
                                        <input type="hidden" name="id" value=<?=$row->id?>>
                                        <?php !empty($row['gallery'][0]['file_path'])? $imgPath = $row['gallery'][0]['file_path'] : $imgPath = PATH_ROOT['NO_IMAGE01']; ?>
                                        <img src="<?= $imgPath ?>" alt="" class="circle">
                                        <h6 class="li-linkbox__a__h6"><?=$row->created->nice()?>
                                            <a class="li-linkbox__a-image btn-floating btn red darken-3 lighten-1"><i class="material-icons">camera_alt</i></a>
                                            <span class="li-linkbox__a-image__count"><?=$row->gallery_count?></span>
                                        </h6>
                                        <span class="truncate"><?= $row['title'] ?><br><?= $row['content'] ?></span>
                                        <?=$this->User->get_favo_html('new_info_favo_disable', $row)?>
                                        <a class="waves-effect hoverable" href="#"></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                    <?php if(count($arcive_notice) > 0) { ?>
                        <ul class="collapsible popout" data-collapsible="accordion">
                            <?php foreach ($arcive_notice as $rows): ?>
                            <li class="collection-item">
                                <div class="collapsible-header waves-effect"><?= $rows[0]["ym_created"] ?><span class="badge">投稿：<?= count($rows) ?></span></div>
                                <?php foreach ($rows as $row): ?>
                                <?php !empty($row['gallery'][0]['file_path'])? $imgPath = $row['gallery'][0]['file_path'] : $imgPath = PATH_ROOT['NO_IMAGE01']; ?>
                                <div class="linkbox collapsible-body">
                                    <div class="archiveLink">
                                        <input type="hidden" name="notice_id" value=<?=$row->id?>>
                                        <h6 class="li-linkbox__a__h6"><?=$row->created->nice()?>
                                            <a class="li-linkbox__a-image btn-floating btn red darken-3 lighten-1"><i class="material-icons">camera_alt</i></a>
                                            <span class="li-linkbox__a-image__count"><?=$row->gallery_count?></span>
                                        </h6>
                                        <span class="truncate"><?= $row['title'] ?><br><?= $row['content'] ?></span>
                                        <?=$this->User->get_favo_html('new_info_favo_disable', $row)?>
                                        <a class="waves-effect hoverable" href="#"></a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php } else { ?>
                        <p>過去の投稿はありません。</p>
                    <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('photoSwipe'); ?>
