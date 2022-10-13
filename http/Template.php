<?php

namespace Globe\Http;

class Template
{
    public function __construct(
        protected string $path = 'template/'
        ) {}

    public function render(string $view, array $variables): string
    {

        if (!file_exists($file = __DIR__ .'/../'.$this->path.$view)) {
            throw new \Exception('Cannot find template:'. $view);
        }
        extract(array_merge($variables, ['template' => $this]));
//        ob_start();
//        include ($file);
//        return ob_get_clean();
        $code = file_get_contents($file);
        $code = $this->compile($code, $variables);
        return $code;
    }

    private function compile($code, $variables) {
        $code = $this->compileForeach($code, $variables);
        $code = $this->compilePrint($code, $variables);
        return $code;
    }

    private function compilePrint($code, $variables) {
        foreach($variables as $variable => $value) {
            if(!is_array($value)) {
                $code = preg_replace('/{g-p ' . $variable . ' g-p}/', $value, $code);
            }
        }
        return $code;
    }

    private function compileForeach($code, $variables) {
        foreach($variables as $variable => $value) {
            if(is_array($value)) {
                preg_match_all('/{g-f [A-Za-z\/]+ in ' . $variable . ' g-f}/', $code, $foreachMatches);
                foreach ($foreachMatches[0] as $match) {
                    $variableName = 'data';
                    $codeBetween =  explode(' g-f}', $code)[1];
                    $codeBetween = explode('{e-g-f', $codeBetween)[0];
                    $codeChanged = '';
                    foreach ($value as $key => $v) {
                        $codeChanged .= $this->compilePrint($codeBetween, [$variableName => $v]);
                    }
                    $code = preg_replace('{' .$codeBetween .'}', $codeChanged, $code, 1);
                    $code = preg_replace('{' .$match .'}', ' ', $code, 1);
                    $code = preg_replace('/{e-g-f}/', ' ', $code, 1);
                }
            }
        }

        return $code;
    }
}