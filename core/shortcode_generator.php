<?php

class ShortcodeGenerator implements IShortcodeGenerator {
        function get($result, $true, $false, $content) {
                $which = ($result) ? $true : $false;
                return $this->pull_shortcode($which, $content);
        }

        private function pull_shortcode($which, $content) {
                //regex to get all text between {{$which}} and {{/$which}}
                try {

                        $matches = array();
                        preg_match("/(?s)\{\{".$which."\}\}(.*)\{\{".$which."\}\}/", $content, $matches);

                        //return print_r($matches, true);
                        if (count($matches) > 0 && isset($matches[1])) {
                                return $matches[1];
                        }
                } catch(Exception $e) {
                        return false;
                }

                return false;
        }
}
