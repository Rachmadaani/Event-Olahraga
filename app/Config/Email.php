<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'no_reply@gmail.com';
    public string $fromName   = 'Admin Event';
    public string $protocol   = 'smtp';
    public string $SMTPHost   = 'smtp.mailtrap.io';
    public string $SMTPUser   = 'a99b8aad34b774';
    public string $SMTPPass   = 'b912fa5b30011f';
    public int    $SMTPPort   = 2525;
    public ?string $SMTPCrypto = null;
    public string $mailType  = 'html';
    public string $charset   = 'utf-8';
    public string $newline   = "\r\n";
    public bool   $validate  = true;
}
