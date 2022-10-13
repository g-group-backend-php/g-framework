<?php

namespace Globe\Http;

interface Response
{
    public function getStatusCode();
    public function getContent();
    public function getHeaders();
    public function render();
}