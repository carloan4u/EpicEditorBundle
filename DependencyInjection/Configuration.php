<?php

namespace Cl4u\Bundle\EpicEditorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cl4u_epic_editor');

        $rootNode
            ->children()
                ->scalarNode('js_path')
                    ->defaultValue('bundles/cl4uepiceditor/js/epiceditor.min.js')
                    ->info('The path to the epic editor javascript library')
                ->end()
                ->arrayNode('options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('base_path')
                            ->defaultValue('/bundles/cl4uepiceditor/css')
                            ->info('The base path of the directory containing the /themes directory')
                        ->end()
                        ->booleanNode('client_side_storage')
                            ->defaultFalse()
                            ->info('Setting this to false will disable localStorage.')
                        ->end()
                        ->scalarNode('local_storage_name')
                            ->defaultValue('epiceditor')
                            ->info('The name to use for the localStorage object.')
                        ->end()
                        ->booleanNode('use_native_fullscreen')
                            ->defaultValue(false)
                            ->info('Set to false to always use faux fullscreen (the same as what is used for unsupported browsers).')
                        ->end()
                        ->scalarNode('parser')
                            ->defaultValue('marked')
                            ->info('Marked is the only parser built into EpicEditor, but you can customize or toggle this by passing a parsing function to this option')
                        ->end()
                        ->booleanNode('focus_on_load')
                            ->defaultValue(false)
                            ->info('If true, editor will focus on load.')
                        ->end()
                        ->arrayNode('file')
                            ->children()
                                ->scalarNode('name')
                                    ->info('If no file exists with this name a new one will be made, otherwise the existing will be opened.')
                                ->end()
                                ->scalarNode('default_content')
                                    ->info('The content to show if no content exists for a file. NOTE: if the textarea option is used, the textarea\'s value will take precedence over default_content')
                                ->end()
                                ->scalarNode('auto_save')
                                    ->defaultValue(100)
                                    ->info('How often to auto save the file in milliseconds. Set to false to turn it off')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('theme')
                            ->children()
                                ->scalarNode('base')
                                    ->info('The base styles such as the utility bar with the buttons')
                                    ->defaultValue('/themes/base/epiceditor.css')
                                ->end()
                                ->scalarNode('editor')
                                    ->info('The theme for the editor which is the area you type into')
                                    ->defaultValue('/themes/editor/epic-dark.css')
                                ->end()
                                ->scalarNode('preview')
                                    ->info('The theme for the previewer.')
                                    ->defaultValue('/themes/preview/github.css')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('button')
                            ->children()
                                ->booleanNode('preview')
                                    ->info('If set to false will remove the preview button.')
                                    ->defaultValue(true)
                                ->end()
                                ->booleanNode('fullscreen')
                                    ->info('If set to false will remove the fullscreen button.')
                                    ->defaultValue(true)
                                ->end()
                                ->enumNode('bar')
                                    ->values(array(true,'show', false, 'hide', 'auto'))
                                    ->info('If true or "show", any defined buttons will always be visible. If false or "hide", any defined buttons will never be visible. If "auto", buttons will usually be hidden, but shown if whenever the mouse is moved')
                                    ->defaultValue('auto')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('shortcut')
                            ->children()
                                ->integerNode('modifier')
                                    ->info('The key to hold while holding the other shortcut keys to trigger a key combo')
                                    ->defaultValue(18)
                                ->end()
                                ->integerNode('fullscreen')
                                    ->info('The shortcut to open fullscreen')
                                    ->defaultValue(70)
                                ->end()
                                ->integerNode('preview')
                                    ->info('The shortcut to toggle the previewer')
                                    ->defaultValue(80)
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('string')
                            ->children()
                                ->scalarNode('toggle_preview')
                                    ->info('The tooltip text that appears when hovering the preview icon')
                                    ->defaultValue('Toggle Preview Mode')
                                ->end()
                                ->scalarNode('toggle_edit')
                                    ->info('The tooltip text that appears when hovering the edit icon')
                                    ->defaultValue('Toggle Edit Mode')
                                ->end()
                                ->scalarNode('toggle_fullscreen')
                                    ->info('The tooltip text that appears when hovering the fullscreen icon.')
                                    ->defaultValue('Enter Fullscreen')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('autogrow')
                            ->children()
                                ->integerNode('min_height')
                                    ->info('The minimum height (in pixels) that the editor should ever shrink to. This may also take a function that returns the desired minHeight if this is not a constant, or a falsey value if no minimum is desired')
                                ->end()
                                ->integerNode('max_height')
                                    ->info('The maximum height (in pixels) that the editor should ever grow to. This may also take a function that returns the desired maxHeight if this is not a constant, or a falsey value if no maximum is desired')
                                ->end()
                                ->booleanNode('scroll')
                                    ->info('Whether the page should scroll to keep the caret in the same vertical place while autogrowing (recommended for mobile in particular)')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}