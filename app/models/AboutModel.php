<?php
class AboutModel{

    public function getDetails() : array{
        $data['title'] = 'About PHPBootstrap';
        $data['description'] = 'This is a MVC PHP Bootstrap';
        return $data;
    }
}