<?php

/*-----------------------------------------------------------------------------------*/
/*  Countdown VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/


vc_map(array(
    'name' => __('Countdown', 'ventcamp'),
    'base' => 'vsc-countdown',
    'description' => 'Countdown',
    'class' => 'vsc_countdown',
    'category' => __('Ventcamp', 'ventcamp'),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Style', 'ventcamp'),
            'param_name' => 'layout',
            'value' => array(
                __('Solid counters block', 'ventcamp') => 'counter-block-solid',
                __('Counters block with border', 'ventcamp') => 'counter-block-border',
                __('Counters block without border', 'ventcamp') => 'counter-block-no-border',
                __('White counters block', 'ventcamp') => 'counter-block-white',
                __('Inline style','ventcamp') => 'inline-layout'
            )
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Count Type ( down or up )', 'ventcamp'),
            'param_name' => 'direction',
            'value' => array(
                __('Down','ventcamp') => 'down',
                __('Up','ventcamp') => 'up'
            ),
            'std' => 'down'
        ),

        array(
            'type' => 'textfield',
            'heading' => __('Date', 'ventcamp'),
            'param_name' => 'date',
            'value' => date( 'M d Y' ),
            'description' => __('Currently value is today, change date, write your own upcoming date', 'ventcamp')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('Format', 'ventcamp'),
            'param_name' => 'format',
            'value' => 'YOWDHMS',
            'description' => __('The format for the countdown display. Use the following characters (in order) to indicate which periods you want to display: "Y" for years, "O" for months, "W" for weeks, "D" for days, "H" for hours, "M" for minutes, "S" for seconds.', 'ventcamp')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('Custom date font size', 'ventcamp'),
            'param_name' => 'value_size',
            'value' => '',
            'dependency' => array(
                'element' => 'layout',
                'value' => 'default-layout'
            )
        ),

        array(
            'type' => 'textfield',
            'heading' => __('Custom text font size', 'ventcamp'),
            'param_name' => 'text_size',
            'value' => ''
        )
    )
));





/*-----------------------------------------------------------------------------------*/
/*  Countdown Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_countdown($atts, $content = null) {
    extract( shortcode_atts( array(
        'layout'        => 'counter-block-solid',
        'direction'     => 'down',
        'date'          => '',
        'format'        => 'YOWDHMS',
        'value_size'    => '',
        'text_size'     => '',
    ), $atts ) );

    $translation_array = array(
        'years' => __( 'Years', 'ventcamp' ),
        'months' => __( 'Months', 'ventcamp' ),
        'weeks' => __( 'Weeks', 'ventcamp' ),
        'days' => __( 'Days', 'ventcamp' ),
        'hours' => __( 'Hours', 'ventcamp' ),
        'minutes' => __( 'Minutes', 'ventcamp' ),
        'seconds' => __( 'Seconds', 'ventcamp' ),
        'year' => __( 'Year', 'ventcamp' ),
        'month' => __( 'Month', 'ventcamp' ),
        'week' => __( 'Week', 'ventcamp' ),
        'day' => __( 'Day', 'ventcamp' ),
        'hour' => __( 'Hour', 'ventcamp' ),
        'minute' => __( 'Minute', 'ventcamp' ),
        'second' => __( 'Second', 'ventcamp' ),
    );

	wp_enqueue_script( 'vetncamp-countdown' , get_template_directory_uri().'/js/lib/jquery.countdown.min.js', array('jquery'), false, true);
    wp_localize_script( 'vetncamp-countdown', 'text_dates', $translation_array );

    if ( !empty($value_size) ) {
        $value_size = intval($value_size);
        $value_size_style = ' style="font-size: ' . $value_size . 'px;"';

    }else {
        $value_size_style = '';

    }

    if ( !empty($text_size) ) {
        $text_size = intval($text_size);
        $text_size_style = ' style="font-size: ' . $text_size . 'px;"';

    }else {
        $text_size_style = '';

    }

    $output = '';
    $classAttr = ' class="counters-wrapper countdown ' . $layout . '"';
    $formatAttr = ( $format ) ? ' data-format="'. $format .'"' : '';
    $directionAttr = ( $direction ) ? ' data-direction="'. $direction .'"' : '';
    $dateAttr = ( $date ) ? ' data-date="'. $date .'"' : '';
    $styleAttr = ( $layout == 'inline-layout' && !empty($text_size_style) ) ? $text_size_style : '';

    $output .= '<div' . $classAttr . $dateAttr . $formatAttr . $directionAttr . $styleAttr . '>';

    if ( $layout != 'inline-layout' || $layout == 'hero-countdown"' ) {
        $output .= '{y<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{yn}</span><p class="title"' . $text_size_style . '>{yl}</p></div></div></div>{y>}';
        $output .= '{o<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{on}</span><p class="title"' . $text_size_style . '>{ol}</p></div></div></div>{o>}';
        $output .= '{w<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{wn}</span><p class="title"' . $text_size_style . '>{wl}</p></div></div></div>{w>}';
        $output .= '{d<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{dn}</span><p class="title"' . $text_size_style . '>{dl}</p></div></div></div>{d>}';
        $output .= '{h<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{hn}</span><p class="title"' . $text_size_style . '>{hl}</p></div></div></div>{h>}';
        $output .= '{m<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{mn}</span><p class="title"' . $text_size_style . '>{ml}</p></div></div></div>{m>}';
        $output .= '{s<}<div class="counter-block ' . $layout . '"><div class="counter-box"><div class="counter-content"><span class="count"' . $value_size_style . '>{sn}</span><p class="title"' . $text_size_style . '>{sl}</p></div></div></div>{s>}';

    }

    $output .= '</div>';

    return $output;
}

add_shortcode("vsc-countdown", "vsc_countdown");
