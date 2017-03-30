# EpicEditorBundle

Use [EpicEditor](http://epiceditor.com/) into your [Symfony 2](http://symfony.com/) Forms

## Installation

Require the library in your [composer.json](https://getcomposer.org/) file:

``` json
{
    "require": {
        "cl4u/epic-editor-bundle" : "~1.0"
    }
}
```

Register the Bundle in your app/AppKernel.php

``` php
new Cl4u\Bundle\EpicEditorBundle\Cl4uEpicEditorBundle(),
```

## Usage

### Include the JavaScript library

Include the JS in your head block

``` twig
{{ epic_editor_javascript() }}
```

### Use the Epic Editor form type

Simply call on your FormBuilder:

``` php
$builder->add('field', 'epic_editor', array('options' = array()))
```

### Use a different version of EpicEditor

This bundle comes with EpicEditor v0.2.2. You can replace this with your own version by setting the parameter:

``` yaml
cl4u_epic_editor:
    js_path: 'bundles/cl4uepiceditor/js/epiceditor.min.js'
```

## Configuration options

The complete list of [options](http://epiceditor.com/#options) can be configured by the following parameter values:

``` yaml
cl4u_epic_editor:
    js_path: 'bundles/cl4uepiceditor/js/epiceditor.min.js'
    options:
        base_path: 'bundles/cl4uepiceditor/css'
        client_side_storage: false
        local_storage_name: epic_editor
        use_native_fullscreen: false
        parser: marked
        focus_on_load: false
        file:
            name: ~
            default_content: ~
            auto_save: 100
        theme:
            base: '/themes/base/epiceditor.css'
            editor: '/themes/editor/epic-dark.css'
            preview: '/themes/preview/github.css'
        button:
            preview: true
            fullscreen: true
            bar: true
        shortcut:
            modifier: 18
            fullscreen: 80
            preview: 70
        string:
            toggle_preview: 'Toggle Preview Mode'
            toggle_edit: 'Toggle Edit Mode'
            toggle_fullscreen: 'Enter Fullscreen'
        autogrow:
            min_height: 200
            max_height: 200
            scroll: true
```
