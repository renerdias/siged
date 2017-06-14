<?php

namespace root\server\sys\lib\html;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author rener
 */
class Html {
    private $html;
    public function __construct($param = null) {
        if (!is_null($param)){
        $this->html = $param;}
        return new static();
    }
    public function writer () {
        echo $this->html;
    }
    public function get () {
        return $this->html;
    }    
    public static function div($content, $options = null) {
        $property = '';
        if (!is_null($options)){
            $property = self::transform($options);
        }
        if (is_array($content)){
            var_dump($content);
            $content2 = implode('', $content);
        }        else {$content2 = $content;}
        $div = "<div $property>$content2</div>";        
        return new static($div);
    }
    public static function img($options = null) {
        $property = '';
        if (!is_null($options)){
            $property = self::transform($options);
        }        
        $img = "<img $property>";        
        return $img;
    }    
    public static function br() {        
        return "<br>";
    }    
    public static function a($content, $options = null) {
        $property = '';
        if (!is_null($options)){
            $property = self::transform($options);
        }        
        $a = "<a $property>$content</a>";        
        return $a;
    }
    
    
    private static function transform ($options) {
        $property = '';
        foreach ($options as $key => $value) {
            $property .= $key . '="' . $value . '"';        
        }
        return $property;
    }
}
