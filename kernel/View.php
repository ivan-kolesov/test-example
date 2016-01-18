<?php

namespace Kernel;

class View
{
    protected $filename;
    protected $params = [];
    protected static $sharedParams = [];

    /**
     * @param $name
     * @param array $params
     * @return View
     * @throws \Exception
     */
    public static function make($name, array $params = [])
    {
        $instance = new self;

        $filename = self::getTemplateFilename($name);
        if (file_exists($filename)) {
            $instance->filename = $filename;
            $instance->params = $params;

            return $instance;
        } else {
            throw new \Exception("Template {$name} not exists");
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public static function share($name, $value)
    {
        self::$sharedParams[$name] = $value;
    }

    /**
     * @param $name
     * @param $value
     * @return null
     */
    public static function shared($name, $value)
    {
        return Arr::get(self::$sharedParams, $name, $value);
    }

    public function with($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function withErrors(array $errors)
    {
        return $this->with('errors', $errors);
    }

    public function render()
    {
        $content = file_get_contents($this->filename);
        list($content, $parentContent, $sections) = $this->lookupExtends($content);

        $content = $this->compileTemplate($content, $parentContent, $sections);

        $params = array_merge_recursive(self::$sharedParams, $this->params);
        return eval("extract(\$params); ?>" . $content);
    }

    private static function getTemplateFilename($name)
    {
        return APP_DIR . "/views/" . $name . ".tpl";
    }

    private function lookupExtends($content)
    {
        if (preg_match('/@extends\([\'\"]([^\'\"]+)[\'\"]/', $content, $match)) {
            $parentName = trim($match[1]);

            $parentContent = file_exists(self::getTemplateFilename($parentName))
                ? file_get_contents(self::getTemplateFilename($parentName))
                : "";
            $sections = $this->splitSections($content);
            return [$content, $parentContent, $sections];
        }

        return [$content, '', $this->splitSections($content)];
    }

    private function splitSections($content)
    {
        $sections = [];
        preg_match_all('/@section\([\'\"]([^\'\"]+)[\'\"]\)((?:(?!@stop).)*)/ms', $content, $match);
        if (!empty($match[1])) {
            foreach ($match[1] as $key => $section) {
                $sections[$section] = trim($match[2][$key]);
            }
        }

        return $sections;
    }

    /**
     * @param $content
     * @param string $parentContent
     * @param array $sections
     * @return string
     */
    private function compileTemplate($content, $parentContent = "", array $sections = [])
    {
        if (!empty($sections)) {
            $yeldMatch = [];
            $yeldReplace = array_values($sections);
            foreach (array_keys($sections) as $section) {
                $yeldMatch[] = "/@yeld\([\'\\\"]{$section}[\'\\\"]\).*/";
            }

            $content = preg_replace($yeldMatch, $yeldReplace, $parentContent);

        } elseif (!empty($parentContent)) {
            $content = $parentContent;
        }

        $content = $this->suspendUnusedTemplateCommands($content);

        return str_replace(["{{", "}}"], ["<?php echo htmlentities(", ", ENT_QUOTES, 'UTF-8', false); ?>"], $content);
    }

    /**
     * @param $content
     * @return string
     */
    private function suspendUnusedTemplateCommands($content)
    {
        $matchList = [
            "/@yeld\([\'\\\"][^\'\\\"]+[\'\\\"]\).*/",
            "/@extends\([\'\\\"][^\'\\\"]+[\'\\\"]\).*/",
        ];
        return preg_replace($matchList, "", $content);
    }
}