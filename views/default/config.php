<?php
/**
 * @var DefaultController $this
 * @var array $app
 * @var array $components
 * @var array $modules
 * @var array $params
 */

$this->pageTitle = 'Configuration - Yii Debugger';
$highlight = $this->getComponent()->highlightCode;
?>
<div class="default-view">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<div class="yii2-debug-toolbar-block title">
					Yii Debugger
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<div id="navbar" data-spy="affix" data-offset-top="60">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="#app">Application</a></li>
						<li><a href="#components">Components</a>
							<ul class="sub-nav">
								<?php foreach (array_keys($components) as $id): ?>
									<li><a href="#components-<?= $id ?>"><?= $id ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li><a href="#modules">Modules</a>
							<ul class="sub-nav">
								<?php foreach (array_keys($modules) as $id): ?>
									<li><a href="#modules-<?= $id ?>"><?= $id ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li><a href="#params">Params</a></li>
					</ul>
				</div><!-- #navbar -->
			</div><!-- .span2 -->

			<div class="span10">
				<section id="app">
					<h2>Application</h2>
					<?php $this->renderPartial('_vardump', array(
						'data' => $app,
						'depth' => 10,
						'highlightCode' => $highlight,
					)); ?>
				</section><!-- #app -->
				<section id="components">
					<h2>Components</h2>
					<?php foreach ($components as $id => $component): ?>
						<section id="components-<?= $id ?>">
							<h3>
								<?= $id ?>
								<span class="class">(<?= $component['class'] ?>)</span>
							</h3>
							<?php $this->renderPartial('_vardump', array(
								'data' => $component,
								'depth' => 5,
								'highlightCode' => $highlight,
							)); ?>
						</section>
					<?php endforeach; ?>
				</section><!-- #components -->
				<section id="modules">
					<h2>Modules</h2>
					<?php foreach ($modules as $id => $module): ?>
						<section id="modules-<?= $id ?>">
							<h3><?= $id ?></h3>
							<?php $this->renderPartial('_vardump', array(
								'data' => $module,
								'depth' => 5,
								'highlightCode' => $highlight,
							)); ?>
						</section>
					<?php endforeach; ?>
				</section><!-- #modules -->
				<section id="params">
					<h2>Params</h2>
					<?php $this->renderPartial('_vardump', array(
						'data' => $params,
						'depth' => 10,
						'highlightCode' => $highlight,
					)); ?>
				</section><!-- #params -->
			</div><!-- .span12 -->
		</div>
	</div>
</div>
<?php
/* @var CClientScript $cs */
$cs = Yii::app()->getClientScript();
$cs->registerScript(__CLASS__ . '#config', <<<JS
	$('body').scrollspy({target: '#navbar'}).on('activate', function(e){
		$(e.target).parents().each(function(){
			if (this.tagName == 'LI')  $(this).addClass('active');
			if (this.id == 'navbar') return false;
		});
	})
JS
);
$cs->registerCss(__CLASS__ . '#config', <<<CSS
	#navbar.affix {
		width: 14.53%;
		top: 20px;
	}
	ul.sub-nav {
		display: none;
		margin: 0;
		padding: 0 6px;
		list-style: none;
		font-size: 11.5px;
		line-height: 25px;
	}
	.active ul.sub-nav {
		display: block;
	}
	ul.sub-nav li {
		display: inline;
	}
	ul.sub-nav li a {
		padding: 4px 6px;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
		text-decoration: none;
	}
	ul.sub-nav li a:hover, ul.sub-nav li a:focus {
		text-decoration: none;
		background-color: #eeeeee;
	}
	ul.sub-nav li.active a, ul.sub-nav li.active a:hover, ul.sub-nav li.active a:focus {
		background-color: #0088cc;
		color: #fff;
	}
	.well code {
		background-color: inherit;
		border-width: 0;
	}
	#components .class {
		color: gray;
	}
CSS
);
?>
