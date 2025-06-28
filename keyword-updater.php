<?php
/**
 * Plugin Name: Keyword Updater Plugin
 * Description: Plugin para adicionar palavras-chave via requisição HTTP e disparar ação após a atualização.
 * Version: 1.1
 * Author: Hikelmy Henrich
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'keyword-updater/v1', '/update/', array(
        'methods'  => 'POST',
        'callback' => 'keyword_updater_callback',
        'permission_callback' => '__return_true', // Para produção, adicione autenticação aqui
    ) );
} );

function keyword_updater_callback( \WP_REST_Request $request ) {
    $post_id  = $request->get_param( 'post_id' );
    $keywords = $request->get_param( 'keywords' );

    if ( ! get_post( $post_id ) ) {
        return new WP_REST_Response( [ 'error' => 'Post não encontrado.' ], 404 );
    }

    if ( is_string( $keywords ) ) {
        $keywords = array_map( 'trim', explode( ',', $keywords ) );
    }

    if ( ! is_array( $keywords ) || empty( $keywords ) ) {
        return new WP_REST_Response( [ 'error' => 'Palavras-chave inválidas.' ], 400 );
    }

    $keyword_list   = new \ILJ\Type\KeywordList( $keywords );
    $update_status  = \ILJ\Backend\Editor::set_keywords( $post_id, $keyword_list );

    if ( $update_status ) {
        do_action( \ILJ\Backend\Editor::ILJ_ACTION_AFTER_KEYWORDS_UPDATE, $post_id, 'post', get_post_status( $post_id ) );
        return new WP_REST_Response( [ 'success' => 'Palavras-chave atualizadas com sucesso!' ], 200 );
    } else {
        return new WP_REST_Response( [ 'error' => 'Erro ao atualizar as palavras-chave.' ], 500 );
    }
}
