<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getId();
    public function getUsername();
    public function getPassword();
    public function getAuthority();
}
