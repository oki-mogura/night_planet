<div id="search-result">
	<div class="col s12">
		<?php $key_word = empty($this->request->query('key_word'))? "キーワード指定なし": $this->request->query('key_word'); ?>
		<?php $area = empty($this->request->query('area'))? "エリア指定なし": AREA[$this->request->query('area')]['label']; ?>
		<?php $genre = empty($this->request->query('genre'))? "ジャンル指定なし": GENRE[$this->request->query('genre')]['label']; ?>
		<?php if(isset($unknow)): ?>
			<span class="header"><?=h($area.'の'.$genre.'　'.count($search).'人')?></span>
		<?php else: ?>
			<span class="header"><?=h("スタッフの検索結果 ".count($search)." 人")?></span><br>
			<span class="header"><?=h("キーワード「".$key_word."」")?></span><br>
			<span class="header"><?=h("エリア「".$area."」")?></span><br>
			<span class="header"><?=h("ジャンル「".$genre."」")?></span>
			<p class="message"><?= count($search) == 0 ? h("検索結果が０人でした。条件を変更し、もう一度検索してみてください。"):""?></p>
		<?php endif; ?>
	</div>
	<?php if(count($search) > 0) { ?>
		<ul>
			<?php foreach ($search as $key => $rows): ?>
				<li class="linkbox col card horizontal waves-effect hoverable search-result-card">
					<div class="card-image">
						<img src="<?= $rows->icon ?>" class="card-image-img" height="200">
					</div>
					<div class="card-stacked">
						<h1>
							<?php if (!empty($rows->snss[0]->instagram)): ?>
								<a style="margin-left: 80%;">
									<span class="Instagram_logo1"></span>
								</a>
							<?php endif; ?>
							<?php if (!empty($rows->snss[0]->facebook)): ?>
								<a style="margin-left: 90%;">
									<span class="facebook_logo1"></span>
								</a>
							<?php endif; ?>
							<?php if (!empty($rows->snss[0]->twitter)): ?>
								<a style="margin-left: 100%;">
									<span class="twitter_logo1"></span>
								</a>
							<?php endif; ?>
						</h1>
						<div class="card-content">
							<h5 class="blue-text text-darken-2"><?= $rows['name']?><span style="font-size: small;"class="blue-text text-darken-2">　所属：<?=$rows->shop['name']?></span></h5>
							<p class="blue-text text-darken-2"><?= $rows['message']
							.'<br>'.GENRE[$rows->shop['genre']]['label'].'|'.$rows->shop['addr21'].$rows->shop['strt21']?></p>
						</div>
					</div>
					<a href="<?=DS.$rows->shop['area'].DS.'cast'.DS.$rows['id']
						.'?genre='.$rows->shop['genre'].'&name='.$rows->shop['name']
						.'&shop='.$rows->shop['id'].'&nickname='.$rows['nickname']?>"></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php }  ?>
</div>