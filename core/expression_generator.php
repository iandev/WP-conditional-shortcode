<?php



class ExpressionGenerator implements IExpressionGenerator {

        public function __construct() {

        }

        public function get_expression_evaluator($type) {
                $class = "EE_".$type;
                if (file_exists(CONDSHORT_CORE_ABSPATH . "/evaluators/" . $class . "/" . $class . ".php")) {
                        require_once(CONDSHORT_CORE_ABSPATH . "/evaluators/" . $class . "/" . $class . ".php");
                        if (class_exists($class))
                                return new $class();
                }
        }
}
