<?php
class View {
    public function render($template, $data = []) {
        extract($data); // Extract variables from the data array
        include '../app/views/' . $template . '.php';
    }
}
