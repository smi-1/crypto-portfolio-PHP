<?php

/*

    Templatesystem för att ladda templatefiler

    $template = new Templates();
    $template->php($db, '/templates/file.php', array)
    $template->form($db, '/templates/form.php', 'index.php', null)

*/

// Templates klassen
class Templates
{
    public $action;
    public $db;
    public $file;
    public $output;
    public $data;
    // Checkar så att filen existerar
    function render()
    {
        try {
            if (!file_exists($this->file)) {
                throw new Exception("Error loading template.");
            } else {
                if (is_array($this->data)) {
                    extract($this->data);
                }
                include $this->file;
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
    // För att lägga till PHP filer
    function php($db, $file, $data)
    {
        $this->data = $data;
        $this->db = $db;
        $this->file = $file;
        $this->render();
    }
    // För att lägga till formulär
    function form($db, $file, $action)
    {
        $this->db = $db;
        $this->action = $action;
        $this->file = $file;
        $this->render();
    }
}
$template = new Templates();


