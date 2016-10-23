<?php
/*
Plugin Name: Mif BP Student Teams
Plugin URI: https://github.com/alexey-sergeev/mif-bp-student-teams
Description: BuddiPress плагин для организации работы и дистанционной поддержки студенческих групп 
Author: Алексей Н. Сергеев
Version: 1.0
Author URI: https://vk.com/alexey_sergeev
*/



// Подключаем свою таблицу стилей

add_action( 'wp_enqueue_scripts', 'mif_bp_stt_add_styles' );

function mif_bp_stt_add_styles() {
	wp_register_style( 'mif-bp-stt-styles', plugins_url( 'styles.css', __FILE__ ) );
	wp_enqueue_style( 'mif-bp-stt-styles' );
}



// Регистрируем новый тип групп - studentteam


add_action( 'bp_groups_register_group_types', 'mif_bp_stt_custom_group_types' );

function mif_bp_stt_custom_group_types() {

    bp_groups_register_group_type( 'studentteam', array(
        'labels' => array(
            'name' => 'Student Team',
            'singular_name' => 'studentteam'
        ),
        'has_directory' => 'studentteams',
        'show_in_create_screen' => true,
        'show_in_list' => true,
        'description' => 'Student teams are good',
        'create_screen_checked' => true
    ) );

}



// Если группа studentteam, то выводим что-то после заголовка

add_action( 'bp_after_group_header', 'mif_bp_stt_after_group_header' );

function mif_bp_stt_after_group_header() {

   if ( ! bp_groups_has_group_type( groups_get_current_group()->group_id, 'studentteam' ) ) return;

   echo '<div class="after-header"><div class="note">Привет, это важное сообщение для всех! Я плагин студенческих групп 
            и у меня добрые намерения. В этом блоке можно размещать что-то полезное для всех &mdash; сообщения, файлы, 
            напоминания и др. Используйте этот пример, чтобы сделать что-то новое и интересное.'.$q.'</div></div>';

}


// bp_before_group_header_meta
// bp_group_header_meta
// bp_get_group_description
// bp_after_group_header


?>
