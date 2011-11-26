<?php
if(!defined('__GRBOARD__')) exit();
include $theme.'/lib/view_lib.php';

$maxImageWidth = 550; # ← 본문 내 이미지 최대크기 (px)
$content = autoImgResize($maxImageWidth, $content);
?>

<div class="viewTitle">

	<?php echo $subject; ?>
	
	<div class="btn">
		
		<?php if($isTrackback): ?>
			<input type="button" onclick="clickToCopy('<?php echo $trackbackUrl; ?>');" title="이 글의 엮인글(트랙백) 주소 입니다." value="트랙백" />
		<?php endif; ?>
		
		<?php if($view['link1']): ?>
			<input type="button" onclick="window.open('<?php echo htmlspecialchars($view['link1']); ?>', '_blank'); return false" title="링크 #1 이 있습니다." value="링크1" />
		<?php endif; ?>
		
		<?php if($view['link2']): ?>
			<input type="button" onclick="window.open('<?php echo htmlspecialchars($view['link2']); ?>', '_blank'); return false" title="링크 #2 이 있습니다." value="링크2" />
		<?php endif; ?>

		<?php if($isWriter): ?>
			<input type="button" onclick="window.open('<?php echo $grboard; ?>/sync.php?id=<?php echo $id; ?>&amp;articleNo=<?php echo $articleNo; ?>', 'sinkNET', 'width=10,height=10,menubar=no');" title="이 글을 시리니넷 SinkNET™ 에 싱크(Sync) 합니다." value="싱크" />
		<?php endif; ?> 
		
		<input type="button" onclick="location.href='<?php echo $grboard; ?>/board.php?id=<?php echo $id; ?>&amp;articleNo=<?php echo $articleNo; ?>&amp;good=1';" title="이 글이 좋습니다." value="좋아요 (<?php echo $view['good']; ?>)" /> 

		<input type="button" onclick="window.open('<?php echo $grboard; ?>/view_scrap.php?isAdd=1&amp;id=<?php echo $id; ?>&amp;article_num=<?php echo $articleNo; ?>', 'addScrap', 'width=600,height=650,menubar=no,scrollbars=yes'); return false" title="이 글을 내 스크랩북에 담습니다." value="담기" />
		
		<input type="button" onclick="window.open('<?php echo $grboard; ?>/report.php?id=<?php echo $id; ?>&amp;article_num=<?php echo $articleNo; ?>', 'addReport', 'width=600,height=650,menubar=no,scrollbars=yes'); return false" title="이 글을 관리자와 마스터에게 신고합니다." value="신고" />
	
	</div>

</div>

<?php if($isFiles): ?>

	<div class="viewLeft">받은횟수</div>
	<div class="viewRight"><?php echo $downloadHit; ?></div>
	<div class="clear"></div>

	<?php for($f=1; $f<11; $f++): if($files[$f]): ?>
		<div class="viewLeft">첨부파일 <?php echo $f; ?></div>
		<div class="viewRight">
			<a href="<?php echo $grboard; ?>/download.php?id=<?php echo $id; ?>&amp;articleNo=<?php echo $articleNo; ?>&amp;num=<?php echo $f; ?>"><?php echo showImg($files[$f]); ?></a>
		</div>
		<div class="clear"></div>
	<?php endif; endfor; ?>

<?php endif; ?>

<script src="<?php echo $grboard; ?>/tiny_mce/plugins/media/js/embed.js"></script>

<div class="viewContent">

	<div id="mainContent">
		
		<?php echo $content; ?>
		
		<div id="writeBy">
			작성자: <?php echo $view['name']; ?>, 작성시각: <?php echo date('Y.m.d H:i:s', $view['signdate']); ?>
		</div>
	
	</div>

	<div class="viewTag">
		
		<?php if(!$view['is_secret'] && $tmpFetchBoard['view_level'] < 2): ?>
		<!-- 페이스북 Like 연동 -->
		 <div id="fb-root"></div>
	     <script>
	       (function(d, s, id) {
	         var js, fjs = d.getElementsByTagName(s)[0];
	         if (d.getElementById(id)) {return;}
	         js = d.createElement(s); js.id = id;
	         js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1";
	         fjs.parentNode.insertBefore(js, fjs);
	       }(document, 'script', 'facebook-jssdk'));
	     </script>
	     <div class="fb-like"></div>
	     <!-- 페이스북 Like 연동 끝 -->
	     <?php endif; ?>
	     
		<p><img src="<?php echo $grboard.'/'.$theme; ?>/image/icon_tag.gif" alt="태그" /> <?php echo $tag; ?></p>
		<p><img src="<?php echo $grboard.'/'.$theme; ?>/image/disk.gif" alt="첨부파일" />
		<?php showAddedFileList(); ?></p>
	</div>

	<?php echo showMemberInfo($view['member_key']); ?>

</div>