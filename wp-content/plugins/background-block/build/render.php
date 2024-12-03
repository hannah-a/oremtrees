<?php
$innerContent = $content;

if( !function_exists( 'evbbGetBoxValues' ) ){
	function evbbGetBoxValues( $val ) {
		return implode( ' ', array_values( $val ) );
	}
}

if( !function_exists( 'borderCSS' ) ){
	function borderCSS($value = ['0px solid #0000']) {
		if (count($value) === 0) {
			return '';
		}
	
		$top = $value[0];
	
		if (count($value) >= 4) {
			$right = $value[1];
			$bottom = $value[2];
			$left = $value[3];
			return "border-top: $top; border-right: $right; border-bottom: $bottom; border-left: $left;";
		}
	
		return "border: $top;";
	}
}

if( !function_exists( 'evbbStyle' ) ){
	function evbbStyle( $attributes, $id ) {
		extract( $attributes );
		extract( $background['desktop'] ?? [] );

		$plxSpeed = $wrapper['animation']['parallax']['speed'] ?? 1;

		// Selectors
		$mainSl = "#$id";
		$backgroundSl = "$mainSl .evbBackground";
		$contentWrapperSl = "$mainSl .backgroundContentWrapper";
		$contentSl = "$mainSl .backgroundContent";

		// Image Destructure
		$url = $image['url'] ?? '';
		$position = $image['position'] ?? '';
		$attachment = $image['attachment'] ?? '';
		$repeat = $image['repeat'] ?? '';
		$size = $image['size'] ?? '';

		// Wrapper CSS
		$wMHeight = $wrapper['minHeight'];
		$wDPadding = evbbGetBoxValues( $wrapper['padding']['desktop'] ?? [] );
		$wTPadding = evbbGetBoxValues( $wrapper['padding']['tablet'] ?? [] );
		$wMPadding = evbbGetBoxValues( $wrapper['padding']['mobile'] ?? [] );
		$wrapBorder = borderCSS( $wrapper['border'] ?? [] );
		$wrapRadius = $wrapper['radius'] ?? '0px';
		$wrapShadow = !empty( $wrapper['shadow'] ) ? 'box-shadow: '. $wrapper['shadow'] .';' : '';

		// Shape CSS
		$tShape = $shape['top'] ?? [];
		$bShape = $shape['bottom'] ?? [];

		$tWidth = $tShape['width'] ?? '100%';
		$tHeight = $tShape['height'] ?? '150px';
		$tColor = $tShape['color'] ?? '#fff';

		$bWidth = $bShape['width'] ?? '100%';
		$bHeight = $bShape['height'] ?? '150px';
		$bColor = $bShape['color'] ?? '#fff';

		// Content CSS
		$contentBG = $content['background'];
		$cVAlign = $content['align']['vertical'];
		$cHAlign = $content['align']['horizontal'] ?? 'center';
		$cTAlign = $content['align']['text'];
		$cDMaxW = $content['maxWidth']['desktop'] ?? '100%';
		$cTMaxW = $content['maxWidth']['tablet'] ?? '100%';
		$cMMaxW = $content['maxWidth']['mobile'] ?? '100%';
		$cDPadding = evbbGetBoxValues( $content['padding']['desktop'] ?? [] );
		$cTPadding = evbbGetBoxValues( $content['padding']['tablet'] ?? [] );
		$cMPadding = evbbGetBoxValues( $content['padding']['mobile'] ?? [] );
		$cBorder = borderCSS( $content['border'] ?? [] );
		$cRadius = $content['radius'] ?? '0px';
		$cShadow = !empty( $content['shadow'] ) ? 'box-shadow: '. $content['shadow'] .';' : '';

		$bgStyles = 'image' === $type ? "url($url)" :
			('gradient' === $type ? $gradient : $color);

		$bgImgStyles = 'image' === $type ? "
			background-position: $position;
			background-attachment: $attachment;
			background-repeat: $repeat;
			background-size: $size;
		" : '';

		$styles = "$mainSl {
			min-height: $wMHeight;
			padding: $wDPadding;
			$wrapBorder
			border-radius: $wrapRadius;
			$wrapShadow
		}
		$mainSl.scroll-parallax .evbBackground{
			height: calc( 100% + ( 100% * $plxSpeed ) );
		}
		$backgroundSl {
			background: $bgStyles;
			$bgImgStyles
		}
		$mainSl .evbShape.top{
			width: $tWidth;
			height: $tHeight;
			color: $tColor;
		}
		$mainSl .evbShape.bottom{
			width: $bWidth;
			height: $bHeight;
			color: $bColor;
		}

		$contentWrapperSl{
			align-items: $cVAlign;
			justify-content: $cHAlign;
		}
		$contentSl {
			max-width: $cDMaxW;
			text-align: $cTAlign;
			$contentBG
			padding: $cDPadding;
			$cBorder
			border-radius: $cRadius;
			$cShadow
		}
		@media (min-width: 481px) and (max-width: 960px) {
			$mainSl {
				padding: $wTPadding;
			}
			$contentSl {
				max-width: $cTMaxW;
				padding: $cTPadding;
			}
		}
		@media (max-width: 480px) {
			$mainSl {
				padding: $wMPadding;
			}
			$contentSl {
				max-width: $cMMaxW;
				padding: $cMPadding;
			}
		}";

		ob_start(); ?>
		<style><?php echo esc_html( wp_strip_all_tags( $styles ) ); ?></style>
		<?php return ob_get_clean();
	}
}

$id = wp_unique_id( 'evbBackground-' );
extract( $attributes );

$aniType = $wrapper['animation']['type'] ?? 'none';

global $allowedposttags;
$allowedHTML = wp_parse_args( [
	'style' => [],
	'svg' => [
		'xmlns' => [],
		'viewbox' => [],
		'width' => [],
		'height' => [],
		'fill' => [],
		'class' => [],
	],
	'path' => [
		'd' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'rect' => [
		'x' => [],
		'y' => [],
		'width' => [],
		'height' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'circle' => [
		'cx' => [],
		'cy' => [],
		'r' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'ellipse' => [
		'cx' => [],
		'cy' => [],
		'rx' => [],
		'ry' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'line' => [
		'x1' => [],
		'y1' => [],
		'x2' => [],
		'y2' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'polyline' => [
		'points' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'polygon' => [
		'points' => [],
		'fill' => [],
		'stroke' => [],
		'stroke-width' => [],
	],
	'g' => [
		'fill' => [],
		'transform' => [],
	],
	'title' => [],
	'desc' => [],
	'iframe' => [
		'src' => [],
		'width' => [],
		'height' => [],
		'frameborder' => [],
		'allowfullscreen' => [],
	],
], $allowedposttags );

// Shape
$tShape = $shape['top'] ?? [];
$bShape = $shape['bottom'] ?? [];

$tType = $tShape['type'] ?? null;
$tSVG = $tShape['svg'] ?? null;
$tFlip = $tShape['flip'] ?? false;
$tInvert = $tShape['invert'] ?? false;

$bType = $bShape['type'] ?? null;
$bSVG = $bShape['svg'] ?? null;
$bFlip = $bShape['flip'] ?? false;
$bInvert = $bShape['invert'] ?? false;
?>
<div <?php echo get_block_wrapper_attributes([ 'class' => "align$align scroll-$aniType" ]); ?> id='<?php echo esc_attr( $id ); ?>' data-attributes='<?php echo esc_attr( wp_json_encode( $attributes ) ); ?>'>
	<?php if ( $tType && $tSVG ): ?>
		<div class="evbShape top <?php echo $tFlip ? 'flip' : '' ?> <?php echo $tInvert ? 'invert' : '' ?>" data-svg='<?php echo esc_attr( wp_json_encode( $tSVG ) ); ?>'></div>
	<?php endif; ?>

	<?php echo wp_kses( evbbStyle( $attributes, $id ), [ 'style' => [] ] ); ?>

	<div class='evbBackground'></div>

	<div class='backgroundContentWrapper'>
		<div class='backgroundContent is-layout-constrained'>
			<?php echo wp_kses( $innerContent, $allowedHTML ); ?>
		</div>
	</div>

	<?php if ( $bType && $bSVG ): ?>
		<div class="evbShape bottom <?php echo $bFlip ? 'flip' : '' ?> <?php echo $bInvert ? 'invert' : '' ?>" data-svg='<?php echo esc_attr( wp_json_encode( $bSVG ) ); ?>'></div>
	<?php endif; ?>
</div>