<?php


/*
 * Register The Custom Post Type.
 *
 * @param string $post_type The post type slug.
 * @param string $singular_name The post type singular name.
 * @param string $pluram_name The post stype plural name.
 * @param string $gender The post type word gender.
 * @param array<string, mixed> $custom_labels The array with $labels properties. See WordPress doc for array keys.
 * @param array<string, mixed> $custom_args The array with $args properties. See WordPress doc for array keys.
 */
function register_custom_post_type(
	string $post_type,
	string $singular_name,
	string $plural_name,
	string $gender = 'M',
	array $custom_labels = array(),
	array $custom_args = array()
): void {
	$labels   = array(
		'name'                  => _x( $plural_name,
			'Nome no Plural',
			'text_domain' ),
		'singular_name'         => _x( $singular_name,
			'Nome no Singular',
			'text_domain' ),
		'menu_name'             => __( $plural_name, 'text_domain' ),
		'name_admin_bar'        => __( $singular_name, 'text_domain' ),
		'archives'              => __( sprintf( 'Arquivos %s %s',
			'F' === $gender ? 'das' : 'dos',
			$plural_name ),
			'text_domain' ),
		'attributes'            => __( sprintf( 'Atributos %s %s',
			'F' === $gender ? 'da' : 'do',
			$singular_name ),
			'text_domain' ),
		'parent_item_colon'     => __( 'Item Pai:', 'text_domain' ),
		'all_items'             => __( sprintf( '%s %s',
			'F' === $gender ? 'Todas as' : 'Todos os',
			$plural_name ),
			'text_domain' ),
		'add_new_item'          => __( sprintf( 'Adicionar %s %s',
			'F' === $gender ? 'Nova' : 'Novo',
			$singular_name ),
			'text_domain' ),
		'add_new'               => __( sprintf( 'Adicionar %s',
			'F' === $gender ? 'Nova' : 'Novo' ),
			'text_domain' ),
		'new_item'              => __( sprintf( '%s %s',
			'F' === $gender ? 'Nova' : 'Novo',
			$singular_name ),
			'text_domain' ),
		'edit_item'             => __( 'Editar ' . $singular_name,
			'text_domain' ),
		'update_item'           => __( 'Atualizar ' . $singular_name,
			'text_domain' ),
		'view_item'             => __( 'Ver ' . $singular_name, 'text_domain' ),
		'view_items'            => __( 'Ver ' . $plural_name, 'text_domain' ),
		'search_items'          => __( 'Buscar ' . $singular_name,
			'text_domain' ),
		'not_found'             => __( sprintf( 'Não %s',
			'F' === $gender ? 'encontrada' : 'encontrado' ),
			'text_domain' ),
		'not_found_in_trash'    => __( sprintf( 'Não %s na lixeira',
			'F' === $gender ? 'encontrada' : 'encontrado' ),
			'text_domain' ),
		'featured_image'        => __( 'Imagem Destacada', 'text_domain' ),
		'set_featured_image'    => __( 'Definir imagem destacada',
			'text_domain' ),
		'remove_featured_image' => __( 'Remover imagem destacada',
			'text_domain' ),
		'use_featured_image'    => __( 'Usar como imagem destacada',
			'text_domain' ),
		'insert_into_item'      => __( 'Inserir no item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Enviado para este item',
			'text_domain' ),
		'items_list'            => __( 'Lista de Itens', 'text_domain' ),
		'items_list_navigation' => __( 'Navegação na Lista de Itens',
			'text_domain' ),
		'filter_items_list'     => __( 'Filtrar lista de itens',
			'text_domain' ),
	);
	$labels   = array_merge( $labels, $custom_labels );
	$taxonomy = $post_type . '_categories';
	if ( ! taxonomy_exists( $taxonomy ) ) {
		register_custom_taxonomy( $taxonomy,
			$post_type );
	}
	$args = array(
		'label'               => __( $plural_name, 'text_domain' ),
		'description'         => __( $plural_name, 'text_domain' ),
		'labels'              => $labels,
		'supports'            => false,
		'taxonomies'          => array( $taxonomy ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	$args = array_merge( $args, $custom_args );
	register_post_type( $post_type, $args );
}

function register_custom_taxonomy(
	string $taxonomy,
	string $post_type
): void {
	$labels = array(
		'name'              => _x( 'Categorias',
			'Nome da categoria',
			'textdomain' ),
		'singular_name'     => _x( 'Categoria',
			'Nome da categoria no singular',
			'textdomain' ),
		'search_items'      => __( 'Procurar categoria', 'textdomain' ),
		'all_items'         => __( 'Todas as categorias',
			'textdomain' ),
		'parent_item'       => __( 'Categoria ascendente:',
			'textdomain' ),
		'parent_item_colon' => __( 'Categoria ascendente:',
			'textdomain' ),
		'edit_item'         => __( 'Editar Categoria', 'textdomain' ),
		'update_item'       => __( 'Atualizar Categoria',
			'textdomain' ),
		'add_new_item'      => __( 'Adicionar Nova Categoria',
			'textdomain' ),
		'new_item_name'     => __( 'Nome da Nova Categoria' ),
		'menu_name'         => __( 'Categorias', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $post_type . '-categories' ),
	);

	register_taxonomy( $taxonomy, array( $post_type ), $args );
}
