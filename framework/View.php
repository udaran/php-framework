<?php


namespace m2i\framework;


class View
{

    /**
     * @var string
     */
    private $layout;

    /**
     * @var array
     */
    private $data = [];

    /**
     * View constructor.
     * @param string $layout
     */
    public function __construct($layout = "")
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
    private function getTemplateContent($template, $data = []){
        ob_start();
        extract($data);
        require_once ROOT_PATH. "/src/views/$template.php";
        return ob_get_clean();
    }
    public function render($template, $data = []){
        $pageContent = $this->getTemplateContent($template, $data);
        $data["content"] = $pageContent;

        if(empty($this->layout)){
            return $pageContent;
        }else{
            return $this->getTemplateContent($this->layout, $data);
        }
    }
}