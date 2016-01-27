<?php
/**
 * Custom form template for site
 */

return [
    'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/>',
];