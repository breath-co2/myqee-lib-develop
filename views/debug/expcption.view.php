<?php
$error_id = uniqid('error');
?>
<style type="text/css">
#expction_div { background: #ddd; font-size: 1em; font-family:sans-serif; text-align: left; color: #111; }
#expction_div h1,
#expction_div h2 { margin: 0; padding: 1em; font-size: 1em; font-weight: normal; background: #911; color: #fff; }
#expction_div h1 a,
#expction_div h2 a { color: #fff; }
#expction_div h2 { background: #222; }
#expction_div p { margin: 0; padding: 0.2em 0; }
#expction_div a { color: #1b323b; }
#expction_div pre { overflow: auto; white-space: pre-wrap; }
#expction_div table {border: solid 1px #ddd;margin-top:-1px; width: 100%; padding: 0; empty-cells:show; border-spacing:0; border-collapse: collapse; background: #fff; }
#expction_div table td { border: solid 1px #ddd; text-align: left; vertical-align: top; padding: 0.4em; }
#expction_div div.content { padding: 0.4em 1em 1em; overflow: hidden; }
#expction_div pre.source { margin: 0 0 1em; padding: 0.4em; background: #fff; border: dotted 1px #b7c680; line-height: 1.2em; }
#expction_div pre.source span.line { display: block; }
#expction_div pre.source span.highlight { background: #f0eb96; }
#expction_div pre.source span.line span.number { color: #666; }
#expction_div ol.trace { display: block; margin: 0 0 0 2em; padding: 0; list-style: decimal; }
#expction_div ol.trace li { margin: 0; padding: 0; }
</style>
<script type="text/javascript">
document.write('<style type="text/css"> .collapsed { display: none; } </style>');

function expc_hw(elem)
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
<div style="padding:0 10px;">
<div id="expction_div">
<h1><span class="type"><?php echo $type ?> [ <?php echo $code ?> ]:</span> <span class="message"><?php echo $message ?></span></h1>
<div id="<?php echo $error_id ?>" class="content">
<p><span class="file"><?php echo Core::debug_path($file) ?> [ <?php echo $line ?> ]</span></p>
<?php echo Dev_Exception::debug_source($file, $line) ?>
<ol class="trace">
<?php foreach (Dev_Exception::trace($trace) as $i => $step): ?>
<li>
<p>
	<span class="file">
		<?php if ($step['file']): $source_id = $error_id.'source'.$i; ?>
			<a href="#<?php echo $source_id ?>" onclick="return expc_hw('<?php echo $source_id ?>')"><?php echo Core::debug_path($step['file']) ?> [ <?php echo $step['line'] ?> ]</a>
		<?php else: ?>
			{PHP internal call}
		<?php endif ?>
	</span>
	&raquo;
	<?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = $error_id.'args'.$i; ?><a href="#<?php echo $args_id ?>" onclick="return expc_hw('<?php echo $args_id ?>')">arguments</a><?php endif ?>)
</p>
<?php if (isset($args_id)): ?>
<div id="<?php echo $args_id ?>" class="collapsed">
	<table cellspacing="0">
	<?php foreach ($step['args'] as $name => $arg): ?>
		<tr>
			<td><code><?php echo $name ?></code></td>
			<td><pre style="padding:0;margin:0;"><?php echo Dev_Exception::dump($arg) ?></pre></td>
		</tr>
	<?php endforeach ?>
	</table>
</div>
<?php endif ?>
<?php if (isset($source_id)): ?>
	<pre id="<?php echo $source_id ?>" class="source collapsed"><code><?php echo $step['source'] ?></code></pre>
<?php endif ?>
</li>
<?php unset($args_id, $source_id); ?>
<?php endforeach ?>
</ol>
</div>
</div>
<?php include(Core::find_file('views', 'debug/environment','.view.php'));?>
</div>
