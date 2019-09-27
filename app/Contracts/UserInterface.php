<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getId();
    public function getEmail();
    public function getPassword();
    public function getAuthority();
    public function getLocale();
}
