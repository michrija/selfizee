<?php
return [
        'inputContainer' => '<div class="form-group">{{content}} <span class="help-block"><small>{{help}}</small></span></div>',
        'label' => '<label{{attrs}} class="control-label">{{text}}</label>',
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>',
        'textarea' => '<textarea name="{{name}}"{{attrs}} class="form-control" >{{value}}</textarea>',
        'select' => '<select name="{{name}}"{{attrs}} class="custom-select">{{content}}</select>',
        'error' => '<div class="form-control-feedback">{{content}}</div>',
        'inputContainerError' => '<div class="form-group {{type}}{{required}} has-danger">{{content}}{{error}}</div>',
        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}" class="custom-control-input" {{attrs}}>',
        'nestingLabel' => '{{hidden}}<label class="custom-control custom-checkbox" {{attrs}} >{{input}}<span class="custom-control-label">{{text}}</span></label>',
        'radioWrapper' => '{{label}}',       
    
];
