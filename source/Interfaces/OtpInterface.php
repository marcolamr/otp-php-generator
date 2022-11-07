<?php

namespace Source\Interfaces;

interface OtpInterface {
    public function generate(int $digits): OtpInterface;
    public function alphabetic(int $length): OtpInterface;
    public function alphanumeric(int $length): OtpInterface;
}