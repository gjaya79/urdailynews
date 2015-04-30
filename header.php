<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php Bw::page_title(); ?><?php
            if (!is_front_page()) {
                echo " - ";
                echo bloginfo('name');
            }
            ?></title>
        <?php wp_head(); ?>
    </head>

    <?php $extra_classes = ( get_field('enable_parallax_header') and is_single() ) ? 'h-parallax' : ''; ?>
    <?php $extra_classes .= ( Bw::get_option('boxed_layout') and ! get_field('enable_parallax_header') ) ? ' boxed' : ''; ?>

    <body <?php body_class(Bw::body_class($extra_classes)); ?>>

        <div id="bw-bg"></div>

        <?php get_template_part('templates/mobile-menu'); ?>

        <div id="wrapper">

            <?php get_template_part('templates/header/header'); ?>

            <?php get_template_part('templates/header-parallax'); ?>

            <div id="container">

                <div class="row">