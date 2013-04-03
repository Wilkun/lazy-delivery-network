<?php

$domain = '//' . $_SERVER['HTTP_HOST'] . '/';

$dirs = array(
	'js',
	'css'
);

$list = array();

foreach ($dirs as $dir) {
	$list[$dir] = array();

	if ($handle = opendir(__DIR__.'/'.$dir)) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != "..") {
	            $list[$dir][] = $entry;
	        }
	    }
	    closedir($handle);
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Local Delivery Network</title>
	<style>
		tr td {
			border-bottom: 1px solid #ccc;
		}
		.dir-label {
			font-weight: bold;
		}
		.filename {
			width: 300px;
		}
		.link input {
			width: 600px;
			font-family: Courier;
			font-size: 12px;
		}
	</style>
</head>
<body>
	<table>
		<tbody>
			<?php foreach($list as $dir => $files): ?>
			<tr>
				<td class="dir-label" colspan="2"><?php echo strtoupper($dir)?></td>
			</tr>
			<?php sort($files); ?>
			<?php foreach($files as $file): ?>
			<tr>
				<td class="filename"><?php echo $file ?></td>
				<td class="link">
					<input type="text" value="<?php echo $domain . $dir . '/' . $file ?>"/>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
	<script type="text/javascript" src="//ldn.dev/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">


	(function(){
		$('.link input').on('click', function() {
			this.select();
		});
	})();
	</script>
</body>
</html>