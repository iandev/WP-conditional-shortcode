<?

class EE_device_type implements IExpressionEvaluator {
        public function evaluate($args) {
                include 'Mobile_Detect.php';
                $detect = new Mobile_Detect();
                if ($args == 1 && $detect->isMobile()) {
                        return true;
                }

                return false;
        }
}