<?php

class CondShortCore {

        private $expression_generator;
        private $shortcode_generator;

        public function __construct($eg=null, $sg=null) {
                $this->expression_generator = $eg;
                $this->shortcode_generator = $sg;

                add_shortcode( 'conditional_shortcode', array( $this, 'conditional_shortcode_func' ) );
        }

        public function conditional_shortcode_func($atts, $content=null, $tag) {
                $output_html = "";

                if (is_null($this->expression_generator) || is_null($this->shortcode_generator)) return null;

                extract( shortcode_atts( array(
                        'expression_type' => null,
                        'expected_value' => null,
                        'true' => null,
                        'false' => null
                ), $atts ) );

                if (is_null($expression_type) || is_null($expected_value) || is_null($true) || is_null($false))
                        return null;

                $expression_evaluator = $this->expression_generator->get_expression_evaluator($expression_type);
                $result = $expression_evaluator->evaluate($expected_value);

                $output = $this->shortcode_generator->get($result, $true, $false, $content);
                $output = str_replace("{{", "[", $output);
                $output = str_replace("}}", "]", $output);

                if (!empty($output)) {
                        try {
                                $output_html = do_shortcode($output);
                        } catch(Exception $e) {
                                return print_r($e, true);
                        }
                }

                return $output_html;
        }

        public function __destruct() {

        }
}
