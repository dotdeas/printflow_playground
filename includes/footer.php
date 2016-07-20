<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<a href="changelog.php" id="unlabeledlink">
			<b>Version</b>
				<?php
					if($build<>"") {
						echo $version."-".$build;
					} else {
						echo $version;
					}
				?>
		</a>
	</div>
<strong>Utvecklat av</strong> <a href="mailto:andreas@dotdeas.se">Andreas Persson</a> @ <a href="http://www.dotdeas.se/" target="_blank">.DEAS Solutions</a>
</footer>