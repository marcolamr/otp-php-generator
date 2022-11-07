<?php

namespace Source;

use Source\Interfaces\OtpInterface;

class Otp implements OtpInterface {
    private string $otp;

    public function __construct(
        private array $blacklist = []
    ) {}

    public function __toString()
    {
        return $this->otp;
    }

    public function generate(int $digits = 4): OtpInterface 
    {
        $possiblesNumbers = '1234567890';
        $otp = ''; 
    
        for ($i = 1; $i <= $digits; $i++) { 
            $otp .= substr($possiblesNumbers, (rand()%(strlen($possiblesNumbers))), 1);
        }

        $this->otp = $otp;
    
        return $this;
    }

    public function alphabetic(int $length = 4): Otp 
    {
        $possiblesCharacteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $otp = ''; 
    
        for ($i = 1; $i <= $length; $i++) { 
            $otp .= substr($possiblesCharacteres, (rand()%(strlen($possiblesCharacteres))), 1);
        }
    
        return $this->filter($otp, $length);
    }

    public function alphanumeric(int $length = 4): Otp 
    {
        $possiblesCharacteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $otp = ''; 
    
        for ($i = 1; $i <= $length; $i++) { 
            $otp .= substr($possiblesCharacteres, (rand()%(strlen($possiblesCharacteres))), 1);
        }
    
        return $this->filter($otp, $length);
    }

    public function toUpper(): string
    {
        if (!empty($this->otp)) {
            return mb_strtoupper($this->otp);
        }
    }

    public function toLower(): string
    {
        if (!empty($this->otp)) {
            return mb_strtolower($this->otp);
        }
    }

    private function filter(string $otp, int $length)
    {
        foreach ($this->blacklist as $badstring) {
            if (str_contains(mb_strtolower($otp), mb_strtolower($badstring))) {
                return $this->alphanumeric($length);
            }
        }

        $this->otp = $otp;
    
        return $this;
    }
}