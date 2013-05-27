<?
class Renderer {
    //TODO : Specify mime-type headers.
    private static $WRAP_RESPONSE = false;
    private static $DEFAULT_OUTPUT = "json";
    private static $ERROR_OUTPUT_NOT_SUPPORTED = "Output format is unsupported";
    private static $DEFAULT_JSONP_CALLBACK = "callback";
    public static $STATUS_VARS = array(0 => "success",
                                        9 => "failure");

    public static function render($f3, $data, $status=null){
        $status = (empty($status)) ? self::$STATUS_VARS[0] : $status;
        $output = self::parse_output($data,$status);
        echo $output;
    }

    private static function parse_output($data, $status, $force_output=""){
        $output = empty($force_output) ? (empty($_REQUEST["output"]) ? self::$DEFAULT_OUTPUT : $_REQUEST["output"]) : $force_output;
        if (self::$WRAP_RESPONSE)
            $obj = array("status" => $status, "data" => $data);
        else 
            $obj = $data;
        if (method_exists("Renderer", "print_" . $output )){
            return eval('return self::print_' . $output . '($obj);');
        } else {
            $data = array("message" => self::$ERROR_OUTPUT_NOT_SUPPORTED);
            return self::parse_output($data,"error",self::$DEFAULT_OUTPUT);
        }
    }


    private static function print_json($object){
        return json_encode($object);
    }
    private static function print_html($object){
        return '<pre>' . htmlentities(print_r($object, true)) . '</pre>';
    }
    private static function print_jsonp($object){
        $callback_method = empty($_REQUEST["callback"]) ? self::$DEFAULT_JSONP_CALLBACK : $_REQUEST["callback"];
        return $callback_method . '(' . json_encode($object) . ');';
    }
    
}