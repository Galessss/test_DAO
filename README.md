Introdução

Este documento detalha o funcionamento de um sistema de acesso a banco de dados em PHP, utilizando a classe sql, que estende PDO para realizar consultas e executar comandos SQL de forma dinâmica e segura.

Estrutura do Sistema

O sistema é composto por três componentes principais:

Autoload de Classes

Classe sql para conexão e manipulação de dados

Script para consulta e exibição dos dados em JSON

1. Autoload de Classes

O código abaixo implementa um autoloader para carregar automaticamente as classes conforme necessário, eliminando a necessidade de require manual para cada arquivo de classe.

<?php
spl_autoload_register(function($class_name) {
    $filename = $class_name . ".php";

    if (file_exists($filename)) {
        require_once($filename);
    }
});
?>

2. Classe sql

A classe sql estende PDO e gerencia a conexão com o banco de dados MySQL. Além disso, ela permite executar consultas e recuperar dados de forma eficiente.

<?php 
class sql extends PDO {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }

    private function setParams($statement, $parameters = array()) {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()): array {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

Correções e Melhorias Aplicadas

Corrigido erro de referência em $this->setParams($stms, $params); para $this->setParams($stmt, $params);.

Substituído return $stmt->execute(); por return $stmt; para evitar execução dupla.

Corrigido erro de sintaxe em return $stmt->ftell(PDO::FETCH_ASSOC); para return $stmt->fetchAll(PDO::FETCH_ASSOC);.

3. Script de Consulta e Saída JSON

Este script executa uma consulta SQL e retorna os resultados no formato JSON para facilitar a comunicação com APIs ou sistemas frontend.

<?php
require_once("config.php");

$sql = new sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
?>

Benefícios do Sistema

Facilidade de Manutenção: Utiliza um sistema de autoload para carregar classes automaticamente.

Segurança: O uso de PDO permite consultas parametrizadas, prevenindo SQL Injection.

Organização e Eficiência: O código modular facilita a reutilização e melhora a escalabilidade do projeto.

Possíveis Melhorias

Uso de Namespaces: Para melhor organização do código.

Utilização de .env: Para proteger credenciais do banco de dados e permitir maior flexibilidade na configuração.

Tratamento de Erros Aprimorado: Implementação de try-catch para capturar e tratar exceções corretamente.

Conclusão

Este sistema fornece uma solução simples, modular e segura para a manipulação de bancos de dados MySQL em PHP. Com algumas melhorias, ele pode se tornar ainda mais robusto e adequado para aplicações maiores.

