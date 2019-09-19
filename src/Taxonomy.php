<?php

namespace AndreKeher\WPDP;

class Taxonomy
{
    private $args;
    private $taxonomy;
    private $slug;
    private $name;
    private $postTypes;
    private $singularName;
    private $pluralName;
    private $hierarchical;

    public function __construct($taxonomy, $slug, $name, $postTypes, $singularName, $pluralName, $hierarchical)
    {
        $this->taxonomy = $taxonomy;
        $this->slug = $slug;
        $this->name = $name;
        $this->postTypes = $postTypes;
        $this->singularName = $singularName;
        $this->pluralName = $pluralName;
        $this->hierarchical = $hierarchical;

        $this->config();
    }

    private function config()
    {
        $labels = [
            'name' => $this->name,
            'singular_name' => $this->singularName,
            'menu_name' => $this->pluralName,
            'all_items' => $this->pluralName,
            'parent_item' => 'Ascendente',
            'parent_item_colon' => 'Ascendente',
            'new_item_name' => 'Novo',
            'add_new_item' => 'Adicionar',
            'edit_item' => 'Editar',
            'update_item' => 'Alterar',
            'view_item' => 'Visualizar',
            'separate_items_with_commas' => 'Separe com vírgulas',
            'add_or_remove_items' => 'Adicionar ou remover',
            'choose_from_most_used' => 'Escolha entre os mais usados',
            'popular_items' => 'Populares',
            'search_items' => 'Buscar',
            'not_found' => 'Nada encontrado',
            'no_terms' => 'Nenhum item',
            'items_list' => 'Lista',
            'items_list_navigation' => 'Navegação da lista',
        ];
        $rewrite = [
            'slug' => $this->slug,
            'with_front' => true,
            'hierarchical' => false,
        ];

        $this->args = [
            'labels' => $labels,
            'hierarchical' => $this->hierarchical,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'rewrite' => $rewrite,
        ];
    }

    public function setArg($key, $value)
    {
        $this->args[$key] = $value;
    }

    public function getArgs()
    {
        if (!empty($key) && isset($this->args[$key])) {
            return $this->args[$key];
        }
        return $this->args;
    }

    public function init()
    {
        add_action('init', function () {
            register_taxonomy($this->taxonomy, $this->postTypes, $this->args);
        }, 0);
        return $this->taxonomy;
    }
}
