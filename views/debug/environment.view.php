<style type="text/css">
#environment_div { background: #ddd; font-size: 1em; font-family:sans-serif; text-align: left; color: #111; }
#environment_div h1,
#environment_div h2 { margin: 0; padding:10px; font-size: 1em; font-weight: normal; background: #911; color: #fff; }
#environment_div h1 a,
#environment_div h2 a { color: #fff; }
#environment_div h2 { background: #222; }
#environment_div h3 { margin: 0; padding: 0.4em 1em 0.4em 1em; font-size: 1em; font-weight: normal;display:block;border-top:solid #eee 1px; border-bottom:solid #ccc 1px; }
#environment_div a { color: #1b323b; }
#environment_div table {border: solid 1px #ddd;margin-top:-1px; width: 100%; padding: 0; empty-cells:show; border-spacing:0; border-collapse: collapse; background: #fff; }
#environment_div table td { border: solid 1px #ddd; text-align: left; vertical-align: top; padding: 0.4em; }
#environment_div table tr:hover td {background:#f5f5f5;}
#environment_div div.content { overflow: hidden; }
#environment_div .lefttd{padding-left:1em;}
</style>
<script type="text/javascript">
document.write('<style type="text/css"> .collapsed { display: none; } </style>');

function environment_hw(elem)
{
elem = document.getElementById(elem);

if (elem.style && elem.style['display'])
// Only works with the "style" attr
var disp = elem.style['display'];
else if (elem.currentStyle)
// For MSIE, naturally
var disp = elem.currentStyle['display'];
else if (window.getComputedStyle)
// For most other browsers
var disp = document.defaultView.getComputedStyle(elem, null).getPropertyValue('display');

// Toggle the state of the "display" style
elem.style.display = disp == 'block' ? 'none' : 'block';
return false;
}
</script>
<?php
$envi_id = uniqid('envi');
?>

<div id="environment_div">
<h2><a href="#<?php echo $env_id = $envi_id.'environment' ?>" onclick="return environment_hw('<?php echo $env_id ?>')">Environment</a></h2>
<div id="<?php echo $env_id ?>" class="collapsed">
	<?php $included = Bootstrap::$include_path;?>
	<h3><a href="#<?php echo $env_id = $envi_id.'environment_included_path' ?>" onclick="return environment_hw('<?php echo $env_id ?>')">Included path</a> (<?php echo count($included) ?>)</h3>
	<div id="<?php echo $env_id ?>" class="collapsed">
		<table>
			<?php foreach ($included as $file): ?>
			<tr>
				<td class="lefttd"><code><?php echo Core::debug_path($file) ?></code></td>
			</tr>
				<?php endforeach ?>
		</table>
	</div>
	<?php $included = get_included_files() ?>
	<h3><a href="#<?php echo $env_id = $envi_id.'environment_included' ?>" onclick="return environment_hw('<?php echo $env_id ?>')">Included files</a> (<?php echo count($included) ?>)</h3>
	<div id="<?php echo $env_id ?>" class="collapsed">
		<table cellspacing="0">
			<?php $i=0;foreach ($included as $file): ?>
			<tr>
			    <td width="50" class="lefttd"><?php echo ++$i;?></td>
				<td><code><?php echo Core::debug_path($file) ?></code></td>
			</tr>
				<?php endforeach ?>
		</table>
	</div>
	<?php $included = get_loaded_extensions() ?>
	<h3><a href="#<?php echo $env_id = $envi_id.'environment_loaded' ?>" onclick="return environment_hw('<?php echo $env_id ?>')">Loaded extensions</a> (<?php echo count($included) ?>)</h3>
	<div id="<?php echo $env_id ?>" class="collapsed">
		<table>
			<?php
			$i=0;
			foreach ($included as $file): ?>
			<tr>
			    <td width="50" class="lefttd"><?php echo ++$i;?></td>
				<td><code><?php echo Core::debug_path($file) ?></code></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
	<?php foreach (array('_SESSION', '_GET', '_POST', '_FILES', '_COOKIE', '_SERVER') as $var): ?>
	<?php if (empty($GLOBALS[$var]) || !is_array($GLOBALS[$var])) continue ?>
	<h3><a href="#<?php echo $env_id = $envi_id.'environment'.strtolower($var) ?>" onclick="return environment_hw('<?php echo $env_id ?>')">$<?php echo $var ?></a></h3>
	<div id="<?php echo $env_id ?>" class="collapsed">
		<table>
			<?php foreach ($GLOBALS[$var] as $key => $value): ?>
			<tr>
				<td class="lefttd" width="220"><code><?php echo $key ?></code></td>
				<td><pre style="padding:0;margin:0;"><?php echo Dev_Exception::dump($value) ?></pre></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
	<?php endforeach ?>
</div>
</div>
