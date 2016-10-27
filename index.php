<?php
/*
Plugin Name: MIF BP Student Teams
Plugin URI: https://github.com/vudruch/mif-bp-student-teams
Description: BuddiPress плагин для организации работы и дистанционной поддержки студенческих групп 
Author: Евгения Выдрыч
Version: 0.1
Author URI: ...
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

   echo '<div class="after-header">';

   if ( groups_is_user_admin( get_current_user_id(), groups_get_current_group()->group_id )) {

       name_of_stt();

   }


    echo '<div class="note">Привет, это важное сообщение для всех! Я плагин студенческих групп 
            и у меня добрые намерения. В этом блоке можно размещать что-то полезное для всех &mdash; сообщения, файлы, 
            напоминания и др. Используйте этот пример, чтобы сделать что-то новое и интересное.</div>';


    echo '</div>';

}


function name_of_stt() {

    $out = '';

    if ( isset($_POST['submit']) ) {

        $out .= '<p>Сохранено!';
        groups_add_groupmeta( groups_get_current_group()->group_id, 'name_of_stt', $_POST['name_of_stt'] );

    }

    $out .= get_stt_list();

    $out .= '<p><form method="POST">
    <input type="text" name="name_of_stt">
    <input type="submit" name="submit" value="Добавить">
    </form>';

    echo $out;

}

function get_stt_list() {

    $out = '';

    $arr = groups_get_groupmeta( groups_get_current_group()->group_id, 'name_of_stt', false );

    foreach ( (array)$arr as $item ) {
        $out .= '<p>' . $item;
    }

    return $out;

}

// bp_before_group_header_meta
// bp_group_header_meta
// bp_get_group_description
// bp_after_group_header


?>
