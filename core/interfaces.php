<?php

interface IExpressionGenerator {
        function get_expression_evaluator($type);
}

interface IExpressionEvaluator {
   /*
    *  $args is the shortcode attribute 'expected_value'
    *  returns boolean true/false
    *  note: usually this will work by evaluating some expression and returning true if it equals 'expected_value', false otherwise
   */
    function evaluate($args);
}

interface IShortcodeGenerator {
        function get($result, $true, $false, $content);
}
