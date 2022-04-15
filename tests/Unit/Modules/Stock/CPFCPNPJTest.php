<?php

use CyberTech\Modules\Stock\Domain\ValueObject\DocumentCPFCNPJ;

test("this should validate cpf correctly", function () {
    $cpf = new DocumentCPFCNPJ("666.392.030-81");
    $this->assertEquals($cpf->getValue(), "66639203081");
});

test('this should return error because cpf is invalid', function () {
    $this->expectException('Exception');
    $this->expectErrorMessage('Invalid CPF');
    $cpf = new DocumentCPFCNPJ("435.874.543-12");
});

test('this should return error because cpf is empty', function () {
    $this->expectException('Exception');
    $this->expectErrorMessage('value for document cpf/cnpj is empty');
    $cpf = new DocumentCPFCNPJ("");
});

test('this should return error because all digits of cpf are equals', function () {
    $this->expectException('Exception');
    $this->expectErrorMessage('all digits from cpf/cnpj are equals');
    $cpf = new DocumentCPFCNPJ("111.111.111-11");
});

test('this should validate CNPJ correctly', function () {
    $cnpj = new DocumentCPFCNPJ("48.911.800/0001-90");
    $this->assertEquals($cnpj->getValue(), "48911800000190");
});

test('this should return error because cnpj is invalid', function () {
    $this->expectException('Exception');
    $this->expectErrorMessage('Invalid CNPJ');
    $cnpj = new DocumentCPFCNPJ("34.222.765/0998-00");
});
